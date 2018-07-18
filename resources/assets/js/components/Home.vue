<template>
  <div class="container">
    <post-component v-for="photo in photos_list" :photo="photo" :key="photo.p_id"></post-component>
  </div>
</template>

<script>
import axios from 'axios';

//子コンポネート
import PostComponent from './parts/Post.vue';
import LoadingComponent from './parts/Loading.vue';

export default {
  data() {
    return {
      photos_list: [],
      loading: false
    };
  },
  components: {
    'post-component': PostComponent,
    'load-component': LoadingComponent
  },
  methods: {
  },
  async created() {
    app.is_global = true;
    try {
      let res = await axios.get('/api/photos/');
      this.photos_list = res.data;
    } catch (e) {
      console.error(e)
    }
  }
}

</script>
