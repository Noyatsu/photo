<template>
  <div>
    <post-component v-for="photo in photos_list" :photo="photo" :key="photo.id"></post-component>
  </div>
</template>

<script>
import axios from 'axios';

//子コンポネート
import PostComponent from './parts/Post.vue';

export default {
  data() {
    return {
      photos_list: []
    };
  },
  components: {
    'post-component': PostComponent
  },
  async created() {
    try {
      let res = await axios.get('/api/photos/');
      this.photos_list = res.data;
    } catch (e) {
      console.error(e)
    }
  }
}

</script>
