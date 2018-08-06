<template>
  <div>
    <div class="container">
      <post-component v-for="photo in photos_list" :photo="photo" :key="photo.p_id"></post-component>
      <div class="notification has-text-centered" v-if="!is_last"><i class="far fa-smile"></i>読み込み中</div>
      <div class="notification has-text-centered is-info" v-if="is_last"><i class="far fa-kiss-wink-heart"></i>コンテンツは以上です</div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

//子コンポネート
import PostComponent from './parts/Post.vue';

export default {
  name: 'timeline',
  data() {
    return {
      photos_list: [],
      page: 2,
      scrollTop: 0,
      scrollHeight: 0,
      scrollPosition: 0,
      is_fetching: false,
      is_last: false
    };
  },
  components: {
    'post-component': PostComponent
  },
  methods: {
    async fetch () {
      try {
        if(!this.is_fetching) {
          this.is_fetching = true;
          let tl_res = await axios.get('/api/users/timeline/' + user_screen_name + '?page=' + String(this.page));
          if(this.page-1 != tl_res.data.last_page) {
            for(var i = tl_res.data.from-1; i<tl_res.data.to; i++) {
              this.photos_list.push(tl_res.data.data[i]);
            }
            this.page++;
            setTimeout(() => {
              this.is_fetching = false;
            }, 500);
          }
          else {
            this.is_last = true;
          }
        }
      } catch (e) {
        console.error(e)
      }
    },
    startWatchingScroll: function () {
      var self = this;
      window.addEventListener('scroll', () => {
        //スクロール一番下で次読み込み
        this.scrollTop = document.body.scrollTop || document.documentElement.scrollTop;
        this.scrollHeight = document.body.scrollHeight || document.documentElement.scrollHeight;
        this.scrollPosition = window.innerHeight + this.scrollTop;
        if (this.scrollHeight - this.scrollPosition <= 1) {
          //スクロールの位置が下部に来た場合
          this.fetch();
        };
      })
    }
  },

  async created() {
    try {
      let tl_res = await axios.get('/api/users/timeline/' + user_screen_name);
      this.photos_list = tl_res.data.data;
    } catch (e) {
      console.error(e)
    }
    this.startWatchingScroll();
  }
}
</script>

<style scoped>
.ovf {
  overflow-y: scroll;
  height: calc(100vh - 60px);
}
</style>
