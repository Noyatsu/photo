<template>
  <div class="post has-background-black-ter has-text-light">
    <div class="container">
      <div class="post-header">
        <div class="post-header-left is-size-7">
          <p><router-link v-bind:to="'/user/' + photo.screen_name"><img src="https://bulma.io/images/placeholders/128x128.png"></router-link></p>
          <p><router-link v-bind:to="'/user/' + photo.screen_name"><strong>{{ photo.name }}</strong></router-link>(@{{photo.screen_name}})</p>
        </div>
      </div>
      <div ref="imgbox" class="post-contents" style="margin: 0 auto;" @click="showModal = true">
        <img ref="img" v-bind:src="'/storage/' + photo.path" @click="showModal = true" @touchstart="touch_start()" @touchend="touch_end()">
      </div>
      <div class="post-footer">
        <p class="post-title"><strong class="has-text-light">{{ photo.title }}</strong></p>
        <div class="post-right">
          <a class="button is-light"><i class="fas fa-share-alt"></i></a>
          <a class="button is-light" @click="likeToggle" v-bind:class="{ 'is-danger': isLiked }">
            <i class="fas fa-heart"></i>
            <span class="likenum">{{ likeNum }}</span>
          </a>
        </div>
        <div class="info">
          <p class="is-size-7 has-text-grey-lighter">{{ photo.p_created_at }}</p>
          <br>
          <p><i class="fas fa-user fa-fw"></i> <router-link v-bind:to="'/user/' + photo.screen_name">{{ photo.name }}</router-link>(@{{photo.screen_name}})</p>
          <p><i class="fas fa-tag fa-fw"></i>
            <span class="tag is-light">{{ photo.c_name }}</span>
            <span class="tag is-dark" v-for="tag in tags">{{ tag }}</span>
          </p>
          <p v-if="photo.filming_date"><i class="fas fa-calendar-alt fa-fw"></i> {{ photo.filming_date }}</p>
          <p v-if="photo.p_location"><i class="fas fa-map-marker fa-fw"></i>{{ photo.location_name ? photo.location_name : photo.p_location }}<span v-if="photo.location_address">({{photo.location_address}})</span></p>
          <p v-if="photo.camera"><i class="fas fa-camera fa-fw"></i> {{ photo.camera }}</p>
          <p v-if="photo.lens"><i class="far fa-dot-circle fa-fw"></i> {{ photo.lens }}</p>
          <p v-if="photo.focal_length"><i class="fas fa-sliders-h fa-fw"></i> {{ photo.focal_length }}mm, {{ photo.speed }}, F{{ photo.iris }}, ISO{{ photo.iso }}</p>
          <p>{{ photo.p_description }}</p>
          <h3>コメント</h3>
          <div class="field">
            <p class="control has-icons-left has-icons-right">
              <input class="input has-background-dark has-text-light" placeholder="コメントを追加">
              <span class="icon is-small is-left">
                <i class="fas fa-comment"></i>
              </span>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios';

export default{
  props: [ 'photo' ],
  data: function () {
    return {
      showModal: false,
      isLiked: false,
      likeNum: 0,
      tags: [],
      scaled: false,
      imgWidth: 0,
      imgHeight: 0,
      is_logined: false
    }
  },
  async created() {
    this.is_logined = (user_screen_name == "") ? false : true;

    try {
      let res;
      res = await axios.get('/api/photos/like/check/' + user_screen_name + '/' + this.photo.p_id);
      if(res.data==true) {
        this.isLiked = true;
      }

    } catch (e) {
      console.error(e);
    }

    const tags_str = this.photo.tags || '';
    if(tags_str != '') {
      this.tags = tags_str.split(',');
    }
    this.likeNum = this.photo.likes;
  },
  methods: {
    touch_start: function() {
      let img = this.$refs.img;
      let imgbox = this.$refs.imgbox;
      img.style.width = "200%";
      imgbox.scrollLeft = event.changedTouches[0].pageX;
      //imgbox.scrollLeft = 50;

    },
    touch_end: function() {
      let img = this.$refs.img;
      let imgbox = this.$refs.imgbox;
      img.style.width="100%";
    },
    likeToggle: function() {
      if(this.is_logined){
        axios.post('/api/photos/like/toggle', {
          screen_name: user_screen_name,
          api_token: user_api_token,
          photo_id: this.photo.p_id,
          csrfToken: window.Laravel.csrfToken
        })
        .then(response => {
          if(this.isLiked == true){
            this.isLiked = false;
            this.likeNum = this.likeNum - 1;
          }
          else {
            this.isLiked = true;
            this.likeNum = this.likeNum + 1;
          }
          this.$emit('toggleLike');
        })
        .catch(error => {
          console.log(error.response)
        });
      }
    }
  }
}
</script>
<style scoped lang="scss">
.likenum {
  margin-left: 0.5rem;
}
.post {
  padding-bottom: 3rem;
  .post-header {

    height: 2rem;
    position: relative;
    margin-bottom: 0.2em;

    .post-header-left {
      display: inline-block;
      position: absolute;
      left: 0.5rem;
      top: 0;
      bottom: 0;
      p {
        display: inline-block;
        vertical-align: middle;
        height: 2rem;
        line-height: 2rem;
      }
      p img {
        width: 2rem;
        height: 2rem;
        margin-right: 0.2rem;
        border-radius: 100%;
      }
    }
    .post-header-right {
      display: inline-block;
      position: absolute;
      right: 0.5rem;
      top: 0;
      bottom: 0;
    }
  }
  .post-contents {
    margin-top: 0.25rem;
    text-align: center;
    overflow-x: inherit;
    @media (max-width: 800px) {
      overflow-x: scroll;
      max-height: 70vh;
    }

    img {
      display: block;
      width: 100%;
      max-width: none;
    }
  }
  .post-footer {
    position: relative;
    margin-left: 0.5rem;
    .post-right {
      display: inline-block;
      position: absolute;
      right: 0.5rem;
      top: 0.2rem;
      bottom: 0;
    }
    .post-title {
    }
    margin-top: 0rem;
  }
}

.info {
  line-height: 1.8;
}
.tag {
  margin-right: 2px;
}

a strong{
  color: white;
}

a {
  color: white;
}
</style>
