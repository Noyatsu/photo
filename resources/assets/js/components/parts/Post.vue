<template>
  <div>
    <transition name="fadeup">
      <div class="modal" v-if="showModal">
        <div class="slidearea has-background-black-ter"></div>
        <div class="closeBtn" v-on:click="modalToggle()"><i class="far fa-times-circle fa-lg"></i></div>
        <div class="scrollarea">
          <detail-content v-bind:photo="photo" v-on:toggleLike="likeToggleData()"></detail-content>
        </div>
      </div>
    </transition>
    <div class="post">
      <div class="post-header">
        <div class="post-header-left is-size-7">
          <p><router-link v-bind:to="'/user/' + photo.screen_name"><img src="https://bulma.io/images/placeholders/128x128.png"></router-link></p>
          <p>
            <router-link v-bind:to="'/user/' + photo.screen_name"><strong>{{ photo.name }}</strong></router-link>(@{{photo.screen_name}})
            <br><span v-if="photo.p_location" class="has-text-grey is-size-8">{{ photo.location_name ? photo.location_name : photo.p_location }}</span>
          </p>
        </div>
      </div>
      <div class="post-contents" style="margin: 0 auto; cursor: pointer;" v-on:click="modalToggle()">
        <img v-bind:src="'/storage/' + photo.path" >
      </div>
      <div class="post-footer">
        <p class="post-title" v-on:click="showModal=true"><strong>{{ photo.title }}</strong></p>
        <div class="post-right">
          <a class="button is-light"><i class="fas fa-share-alt"></i></a>
          <a class="button is-light" @click="likeToggle" v-bind:class="{ 'is-danger': isLiked }">
            <i class="fas fa-heart"></i>
            <span class="likenum">{{ likeNum }}</span>
          </a>
        </div>
        <p class="is-size-7 has-text-grey">{{ photo.p_created_at }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import DetailContent from './DetailContent.vue';

export default{
  components: {
    'detail-content': DetailContent
  },
  name: 'post-component',
  props: [ 'photo' ],
  data: function () {
    return {
      showModal: false,
      isLiked: false,
      likeNum: 0
    }
  },
  async created() {
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
    likeToggle: function() {
      axios.post('/api/photos/like/toggle', {
        screen_name: user_screen_name,
        api_token: user_api_token,
        photo_id: this.photo.p_id,
        csrfToken: window.Laravel.csrfToken
      })
      .then(response => {
        this.likeToggleData();
      })
      .catch(error => {
        console.log(error.response)
      });
    },
    likeToggleData: function() {
      if(this.isLiked == true){
        this.isLiked = false;
        this.likeNum = this.likeNum - 1;
      }
      else {
        this.isLiked = true;
        this.likeNum = this.likeNum + 1;
      }
    },
    modalToggle: function() {
      if(this.showModal) {
        window.history.back();
      }
      else {
        history.pushState('', '', "/photo/" + this.photo.p_id);
      }
      this.showModal = !this.showModal;
    }
  }

}
</script>
<style scoped lang="scss">
.slidearea {
  margin-top: 2.5px;
  height: 35px;
  border-radius: 10px 10px 0px 0px;
}
.likenum {
  margin-left: 0.5rem;
}
.post {
  padding-top: 1rem;
  padding-bottom: 1rem;
  min-height: 100%;
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
        line-height: 1rem;
        overflow: hidden;
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
    background-color: #101010;
    text-align: center;
    img {
      display: inline-block;
      max-width: 800px;
      max-height: 80vh;
    }
    @media (max-width: 800px) {
      img {
        display: block;
        width: 100%;
        max-width: none;
      }
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

.modal {
  z-index: 1000;
  position: fixed;
  top: 57px;
  bottom: 0;
  left: 0;
  right: 0;
  display: block;
  overflow-y: scroll;
}
.closeBtn {
  position: fixed;
  top: 60px;
  right: 3px;
  color: white;
  padding: 1rem;
  z-index: 100000;
}
@media (max-width: 800px) {
  .modal {
    top: 0;
    bottom: 45px;
  }
  .closeBtn {
    top: 3px;
  }
}

a strong{
  color: #000000;
}

a {
  color: white;
}

.is-size-8 {
  font-size: 75%;
}
</style>
