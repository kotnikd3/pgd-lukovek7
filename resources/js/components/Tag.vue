<template>
    <div>
        <span :class="[color, { 'margin' : margin }]" v-text="newstype"></span>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tags: {
                    'Obvestilo' : 'is-light',
                    'Intervencija' : 'is-danger',
                    'Tekmovanje' : 'is-info',
                    'Vaja' : 'is-primary',
                    'Dogodek' : 'is-success',
                    'Ostalo' : 'is-warning'
                },
                size: this.initialsize,
                newstype: this.initialnewstype
            }
        },
        props: {
            initialsize: {
                type: String,
                default: 'is-normal'
            },
            initialnewstype: {
                type: String,
                default: 'Obvestilo'
            },
            margin: {
                type: Boolean,
                default: false
            }

        },
        computed: {
            color: function() {
                var color = 'tag is-light';
                if (this.newstype in this.tags) {
                    color = 'tag ' + this.tags[this.newstype] + ' ' + this.size;
                }
                return color;
            }
        },
        created() {
            Event.$on('changeTagColor', (newstype) => {
                this.newstype = newstype;
            });
        }
    }
</script>

<style>
.margin {
    margin-left: 30px;
}
</style>
