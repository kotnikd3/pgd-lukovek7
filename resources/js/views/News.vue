<template>
    <div>
        <!-- Confirm modal for deleting the news. -->
        <div v-if="selectedCard" :class="['modal', { 'is-active': selectedCard }]">
            <div class="modal-background" @click="selectCard(null)"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Izbriši novico</p>
                </header>
                <section class="modal-card-body">
                    <h5 class="title is-4 is-spaced">Želite res izbrisati novico z naslovom <span class="has-text-danger" v-text="selectedCard.title"></span>?</h5>
                    <h5 class="subtitle is-5">Po izbrisu bodo vse informacije (besedilo in slike) v povezavi z objavo izbrisane, le iz spletne strani PGD-Lukovek.</h5>
                </section>
                <footer class="modal-card-foot">
                    <button type="submit" class="button is-danger" @click="delete_news(selectedCard)">Izbriši</button>
                    <button class="button" @click="selectCard(null)">Prekliči</button>
                </footer>
            </div>
        </div>

        <!-- Loading -->
        <div v-if="loading" class="columns is-centered">
            <div class="column is-half-desktop has-text-centered">
                <div class="notification">
                    <h1 class="title is-1">Nalaganje novic ...</h1>
                    <i class="fas fa-spinner fa-spin fa-3x"></i>
                </div>
            </div>
        </div>

        <!-- Errors -->
        <div v-if="error" class="columns is-centered">
            <div class="column is-half-desktop has-text-centered">
                <div class="notification is-danger is-light">
                    <h1 class="title">Napaka pri pridobivanju novic. Status: {{ error.status }}</h1>
                    <h2 class="subtitle" v-text="error.data.exception"></h2>
                </div>
            </div>
        </div>

        <!-- Deleted news -->
        <div v-if="lastDeletedTitle" class="columns is-centered">
            <div class="column is-half-desktop has-text-centered">
                <div class="notification is-warning is-light">
                    <button class="delete" @click="lastDeletedTitle = null"></button>
                    Novica z naslovom <strong>{{ lastDeletedTitle }}</strong> izbrisana.
                </div>
            </div>
        </div>

        <!-- Create new news -->
        <div v-if="user && !loading && !error" class="columns is-centered">
            <article class="message is-success column is-half-desktop">
                <div class="message-body">
                    <a href="/news/create" class="button is-success is-fullwidth"><p>Objavi novico kot <span class="is-italic">{{ user | fullName }}.</span></p></a>
                </div>
            </article>
        </div>

        <!-- Cards for news -->
        <div class="columns is-multiline">
            <div class="column is-half-tablet is-4-desktop" v-for="news_ins in news" :key="news_ins.id">
                <div :class="['card', { 'card-shadow' : isHovered(news_ins) }]" @mouseover="hoverCard(news_ins)" @mouseout="hoverCard(null)">
                    <a class="povezava" :href="'/news/' + news_ins.id"></a>
                    <!-- <figure v-if="news_ins.cover_image" :class="['image is-4by3', { 'image-blur' : isHovered(news_ins) }]"> -->
                    <figure :class="[{ 'image-blur' : isHovered(news_ins) }]">
                        <!-- <a class="povezava" :href="'/news/' + news_ins.id"></a> -->
                        <img v-if="news_ins.cover_image" :src="news_ins.cover_image" alt="Slika dogodka">
                        <img v-else src="images/lotus_logo.png" alt="logo">
                    </figure>
                    <div class="card-content">
                        <div class="content">
                            <div class="columns is-multiline is-desktop">
                                <div class="column is-full-desktop is-three-fifths-fullhd">
                                    <p class="title is-4 has-text-grey">{{ news_ins.title }}</p>
                                    <p class="subtitle is-6">{{ news_ins.created_at | ago }}</p>
                                </div>
                                <div class="column is-one-fifth-fullhd">
                                    <tag :initialnewstype="news_ins.type"></tag>
                                </div>
                            </div>
                            <p>{{ limitText(news_ins.body) }}</p>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a v-if="news_ins.can_update" class="card-footer-item button is-info is-light" :href="'/news/' + news_ins.id + '/edit'">Uredi</a>
                        <a v-if="news_ins.can_delete" class="card-footer-item button is-danger is-light" @click="selectCard(news_ins)">Izbriši</a>                        
                    </footer>
                </div>
            </div>
        </div>
        <!-- Pagination -->
        <div v-if="!loading && !error" class="columns is-mobile is-centered">
            <div class="column is-narrow">
                <nav class="level is-mobile">
                    <div class="level-item">
                        <a class="button is-outlined" @click="fetchData(prev_page_url)" :disabled="!prev_page_url">Nazaj</a>
                    </div>
                    <div class="level-item has-text-grey">
                        <p>Stran <span class="has-text-weight-bold">{{ current_page }}</span> od {{ last_page }}</p>
                    </div>                    
                    <div class="level-item">
                        <a class="button is-outlined" @click="fetchData(next_page_url)" :disabled="!next_page_url">Naprej</a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment/moment';

    export default {
        mounted() {
            moment.locale('sl'); // Nastavimo knjiznico moment na jezik Slovenscina.
        },
        data() {
            return {
                news: [],
                error: null,
                loading: true,
                hoveredCard: null,
                selectedCard: null,
                lastDeletedTitle: null,
                // Pagination
                prev_page_url: null,
                next_page_url: null,
                current_page: null,
                last_page: null
            }
        },
        computed: {
            user: function() {
                return window.User;
            }
        },
        methods: {
            delete_news(news_ins) {
                axios.delete('/news/' + news_ins.id)
                    .then(response => {
                        console.log("DELETED: response", response);

                        // Na front-end pobrisemo le, ce se je uspesno pobrisalo na back-end.
                        if (response.status === 200) {
                            // Iz backenda pridobimo pobrisano novico.
                            let index = this.news.findIndex(x => {
                                return x.id === response.data.id;
                            });
                            this.news.splice(index, 1);
                            this.lastDeletedTitle = response.data.title;
                            this.selectCard(null);
                        }
                    })
                    .catch(error => {
                        console.error("Napaka pri DELETE:", error);
                    });
            },
            isHovered(hoveredCard) {
                return this.hoveredCard === hoveredCard;
            },
            hoverCard(hoveredCard) {
                this.hoveredCard = hoveredCard;
            },
            selectCard(selectedCard) {
                this.selectedCard = selectedCard;
            },
            limitText(text) {
                return text.length > 100 ? text.substring(0, 100) + ' ...' : text;
            },
            fetchData(url) {
                if (!url) { // null
                    return;
                }
                this.loading = true;
                this.news = [];
                // fire an ajax request
                axios.get(url)
                .then(response => {
                    this.news = response.data.data; // data.data zaradi pagination
                    this.next_page_url = response.data.next_page_url;
                    this.prev_page_url = response.data.prev_page_url;
                    this.current_page = response.data.current_page;
                    this.last_page = response.data.last_page;

                    console.log("Novice uspesno pridobljene.");
                })
                .catch(error => {
                    this.error = error.response;
                    console.error("Napaka:", error);
                })
                .finally(() => {
                    this.loading = false;
                });
            // ISTO: 
            //axios.get('/statuses').then(({data}) => this.statuses = data);
            }
        },
        created() {
            this.fetchData('/news');
        },
        filters: {
            ago(date) {
                // var stillUtc = moment.utc(date).toDate();
                // return moment(stillUtc).local().fromNow(); // UTC -> local
                // 18. april 2019
                return moment(date).format('LL');
            },
            fullName(user) {
                return user.name + " " + user.surname;
            },
        }
    }
</script>

<style>
    .card {
        border-radius: 0.25rem;
        transition: box-shadow 0.3s, transform 0.3s;
    }

    .card-shadow {
        box-shadow: 10px 7px 20px -5px rgba(0,0,0,0.75);
        transform: scale(1.02);
        /* opacity: 0.5; */
    }

    .image-blur {
        filter: saturate(1.5);
        /* filter: sepia(100); */
    }

    .povezava {
        /* Da se element 'card' obnasa kot povezava. */
        position: absolute;
        top: 0; left: 0;
        height: 100%; width: 100%;
    }
    
</style>

