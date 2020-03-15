<template>
  <div>

    <VueEasyLightbox
      :visible="visible"
      :imgs="imgs"
      :index="index"
      @hide="hide"
    ></VueEasyLightbox>

  </div>
</template>

<script>
import VueEasyLightbox from 'vue-easy-lightbox'

export default {
  components: {
    VueEasyLightbox
  },
  data() {
    return {
        //   imgs: ['/storage/news/20/Debela_Pec.JPG', 'http://via.placeholder.com/350x150'],  // Img Url , string or Array
      visible: false,
      index: 0 // Default
    }
  },
  methods: {
    hide() {
      this.visible = false
    }
  },
  props: ['imgs'],
    created() {
        Event.$on('showLightbox', (index) => {
            this.index = index;
            this.visible = true;
        });
    }
}
</script>