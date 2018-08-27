<template>
  <div class="has-background-black-ter detailwindow">
    <back-button v-if="is_logined"></back-button>
    <detail-content v-if="isShow" v-bind:photo="photo" v-bind:photo_id="$route.params.id"></detail-content>
  </div>
</template>

<script>
import axios from 'axios';
import BackButton from './parts/BackButton.vue';
import DetailContent from './parts/DetailContent.vue';

export default{
  components: {
    'back-button': BackButton,
    'detail-content': DetailContent
  },
  data: function () {
    return {
      photo: [],
      isShow: false,
      isLiked: false,
      is_logined: false
    }
  },
  async created() {
    this.is_logined = (user_screen_name == "") ? false : true;
    //写真を取得
    try {
      let res = await axios.get('/api/photos/get/'+this.$route.params.id);
      this.photo = res.data[0];
      this.isShow = true
    } catch (e) {
      console.error(e)
    }
  },
  methods: {
  }
}
</script>

<style scoped>
.detailwindow{
  padding-top: 0.5rem;
  min-height: calc( 100vh - 100px );
}

</style>
