<template>
    <div class="">
        <div class="columns">
            <div class="column">
                <article class="message">
                    <div class="message-header">About said ...</div>

                    <div class="message-body">
                        I'm an example component Kotnik. daw
                        <img :src="image" alt="Base64 encoded image" />
                    </div>
                </article>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                image: ''
            }
        },
        mounted() {
            console.log('Component ABOUT mounted.');
        },
        methods: {
            test() {
                console.log("TEST");
            }
        }
    }
</script>
