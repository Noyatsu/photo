<template>
  <div>
    <div class="s-area has-background-light">
      <div class="field has-addons">
        <div class="control is-expanded">
          <input class="input" type="text" placeholder="検索.." v-on:keyup.enter="fw_search" v-model="query_text">
        </div>
        <div class="control">
          <a class="button is-info" v-on:click="fw_search">
            <i class="fas fa-search"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="container has-text-centered">
      <h1 class="is-size-4"><i class="fas fa-clock"></i></i></h1>
      <p>最近の投稿</p>
      <br>
      <div class="photoarea">
        <thumb-component v-for="photo in photo_list" :photo="photo" :key="photo.p_id"></thumb-component>
      </div>
    </div>
    <br>
    <div class="container has-text-centered">
      <h1 class="is-size-4"><i class="fas fa-fire"></i></h1>
      <p>高スコアの投稿</p>
      <br>
      <div class="photoarea">
        <thumb-component v-for="photo in photo_list_score" :photo="photo" :key="photo.p_id"></thumb-component>
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
      photo_list_score: [],
      query_text: "",
      loading: false
    };
  },
  methods: {
    fw_search: function() {
      this.$router.push('/search/freeword/' + encodeURIComponent(this.query_text));
    }
  },
  components: {
    'thumb-component': ThumbComponent
  },
  async created() {
    try {
      const res = await axios.get('/api/photos/');
      const res_score = await axios.get('/api/photos/index/score');
      this.photo_list = res.data.data;
      this.photo_list_score = res_score.data.data;
    } catch (e) {
      console.error(e)
    }
  }
}


</script>

<style scoped>
.s-area {
  padding: 1.5rem;
  margin-bottom: 1.5rem;
}
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
