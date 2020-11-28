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
                    'Obvestilo' : 'is-info',
                    'Intervencija' : 'is-danger',
                    'Tekmovanje' : 'is-primary',
                    'Vaja' : 'is-primary',
                    'Dogodek' : 'is-success',
                    'Ostalo' : 'is-info'
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
                var color = 'tag REPLACE is-light';
                var colorType = 'is-info';
                if (this.newstype in this.tags) {
                    colorType = this.tags[this.newstype] + ' ' + this.size;
                }
                return color.replace('REPLACE', colorType);
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
