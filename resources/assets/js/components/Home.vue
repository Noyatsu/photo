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
    try {
      let tl_res = await axios.get('/api/users/timeline/' + user_screen_name);
      let my_res = await axios.get('/api/users/photo/' + user_screen_name);
      this.photos_list = tl_res.data.concat(my_res.data);
      this.photos_list.sort(function(a,b){
        if(a.p_id > b.p_id) return -1;
        if(a.p_id < b.p_id) return 1;
        return 0;
      });
    } catch (e) {
      console.error(e)
    }
  }
}

</script>
