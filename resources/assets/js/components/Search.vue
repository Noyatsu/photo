<template>
  <div>
    <div class="notification">
      <div class="control has-icons-left has-icons-right">
        <input class="input is-rounded" type="text" placeholder="検索">
        <span class="icon is-small is-left">
          <i class="fas fa-search"></i>
        </span>
      </div>
    </div>
    <div class="container">
      <h1 class="title">最近の投稿</h1>
      <div class="photoarea">
        <thumb-component v-for="photo in photo_list" :photo="photo" :key="photo.p_id"></thumb-component>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

import ThumbComponent from './parts/Thumbnail.vue';

export default {
  data() {
    return {
      photo_list: [],
      loading: false
    };
  },
  methods: {
  },
  components: {
    'thumb-component': ThumbComponent
  },
  async created() {
    try {
      let res = await axios.get('/api/photos/');
      this.photo_list = res.data;
    } catch (e) {
      console.error(e)
    }
  }
}


</script>

<style scoped>
/*tab*/
.is_selected {
  border-bottom: solid 3px hsl(217, 71%, 53%);
}

.tab-contents {
  margin-top: 1rem;
}

.photoarea {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.photo {
  height: 150px;
  width: 150px;
  background-color: hsl(217, 71%, 53%);
  background-image: url("/storage/photo/1.JPG");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  text-align: center;
  margin: 1rem;
  color: white;
  line-height: 150px;
}

.is_round img{
  border-radius: 100px;
}
</style>
