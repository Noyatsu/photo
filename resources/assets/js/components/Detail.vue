<template>
  <div>
    <back-button></back-button>
    <detail-content v-bind:photo="photo"></detail-content>
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
      isLiked: false,
      likeNum: 0
    }
  },
  async created() {
    //写真を取得
    try {
      let res = await axios.get('/api/photos/get/'+this.$route.params.id);
      this.photo = res.data[0];
    } catch (e) {
      console.error(e)
    }
    console.log(this.photo);
    try {
      let res;
      res = await axios.get('/api/photos/like/check/' + user_screen_name + '/' + this.photo.p_id);
      if(res.data==true) {
        this.isLiked = true;
      }

    } catch (e) {
      console.error(e);
    }

    this.likeNum = this.photo.likes;
  },
  methods: {
  }
}
</script>
