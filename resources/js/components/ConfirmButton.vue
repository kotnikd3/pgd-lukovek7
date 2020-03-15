<template>
    <div>
        <button @click.prevent="showModal = true" class="button is-danger is-small">Izbriši</button>

        <div :class="['modal', { 'is-active': showModal }]">
            <div class="modal-background" @click="showModal = false"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Izbriši račun</p>
                </header>
                <section class="modal-card-body">
                    <h5 class="title is-4 is-spaced">Želite res izbrisati svoj račun?</h5>
                    <h5 class="subtitle is-5">Po izbrisu prijava ne bo več možna, vse vaše objave pa bodo ostale objavljene v sistemu.</h5>
                </section>
                <footer class="modal-card-foot">
                    <button type="submit" class="button is-danger">Izbriši</button>
                    <button class="button" @click.prevent="showModal = false">Prekliči</button>
                </footer>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                showModal: false
            }
        }
    }
</script>

