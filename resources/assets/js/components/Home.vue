<template>
  <div>
    <div class="container">
      <post-component v-for="photo in photos_list" :photo="photo" :key="photo.p_id"></post-component>
      <div v-for="item in items" class="item-card">
        <div class="thumbnail"></div>
        <h3 class="title">{{ item.title }}</h3>
      </div>
      <div class="loading"><p>Now loading......</p></div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

//子コンポネート
import PostComponent from './parts/Post.vue';

export default {
  data() {
    return {
      photos_list: [],
      page: 0,
      limit: 10,
      items: [],
      scrollTop: 0,
      scrollHeight: 0,
      scrollPosition: 0
    };
  },
  components: {
    'post-component': PostComponent
  },
  methods: {
    async fetch () {
      const items = await api(this.page, this.limit);
      this.items.push(...items);
      this.page++;
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
      console.log(tl_res);
      this.photos_list = tl_res.data;
    } catch (e) {
      console.error(e)
    }
    this.startWatchingScroll();
    console.log("hey");
  }
}


// mock
function api (page, limit) {
  const items = [...Array(limit)].map((a, i) => {
    return {
      title: `page: ${page}, limit: ${limit}, ${i.toString().repeat(10)}`
    };
  });

  return new Promise((resolve, reject) => {
    setTimeout(() => {
      resolve(items);
    }, 2000);
  });
}
</script>

<style scoped>
.ovf {
  overflow-y: scroll;
  height: calc(100vh - 60px);
}
</style>
