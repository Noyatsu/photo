<template>
  <div>
    <transition name="fadeup">
      <div class="modal" v-if="showModal">
        <div class="slidearea has-background-black-ter has-text-light" v-on:click="modalToggle()">
          <!--<div class="slidemark has-background-grey">
        </div>-->
        <i class="fas fa-chevron-down fa-lg"></i>
      </div>
      <!--<div class="closeBtn" v-on:click="modalToggle()"><i class="far fa-times-circle fa-lg"></i></div>-->
      <div class="scrollarea">
        <detail-content v-bind:photo="photo" v-on:toggleLike="likeToggleData()"></detail-content>
      </div>
    </div>
  </transition>

  <div v-on:mouseover="hovered = true" v-on:mouseleave="hovered = false">
    <!--<router-link v-bind:to="'/photo/' + photo.p_id">-->
      <div class="photo" v-bind:style="'background-image: url(/storage/thumb/' + photo.path+');'" v-on:click="modalToggle()">
        <transition name="fade">
          <div class="photo_title" v-if="hovered">{{ photo.title }}<br><span class="is-size-7">by @{{ photo.screen_name }}</span></div>
        </transition>
      </div>
    <!--</router-link>-->
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
  name: 'thumb-component',
  props: [ 'photo' ],
  data: function () {
    return {
      hovered: false,
      showModal: false,
      isLiked: false,
      likeNum: 0
    }
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
        try {
          let res;
          res = axios.get('/api/photos/like/check/' + user_screen_name + '/' + this.photo.p_id);
          if(res.data==true) {
            this.isLiked = true;
          }

        } catch (e) {
          console.error(e);
        }
        history.pushState('', '', "/photo/" + this.photo.p_id);
      }
      this.showModal = !this.showModal;
    }
  },
  created() {
    this.likeNum = this.photo.likes;
  }
}
</script>

<style scoped lang="scss">
.photo {
  position: relative;
  height: 180px;
  width: 320px;
  background-color: hsl(217, 71%, 53%);
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  text-align: center;
  margin: 0.2rem;
  color: white;
  line-height: 150px;
  cursor: pointer;
}
@media (max-width: 767px) {
  .photo {
    height: 32vw;
    width: 32vw;
    margin: 0.01rem;

  }
}
.photo_title {
  position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  height: 2.5rem;
  background: -moz-linear-gradient(bottom, #000, transparent);
  background: -webkit-linear-gradient(bottom, #000, transparent);
  background-color: linear-gradient(to top, #000, transparent);
  line-height: 1;
  color: #fff;
  overflow: hidden;
  white-space: nowrap;
}

.slidemark {
  height: 0.5rem;
  width:3rem;
  margin-top: 0.25rem;
  border-radius: 0.25rem;
  display: inline-block;
}
.scrollarea {
  overflow-y: scroll;
  position: absolute;
  top: 2rem;
  bottom: 0;
  left: 0;
  right: 0;

}
.slidearea {
  margin-top: 2.5px;
  height: 2rem;
  border-radius: 2rem 2rem 0px 0px;
  text-align: center;
  cursor: pointer;
}

.modal {
  z-index: 1000;
  position: fixed;
  top: 56px;
  bottom: 0;
  left: 0;
  right: 0;
  display: block;
}

@media (max-width: 800px) {
  .modal {
    top: 0;
    bottom: 45px;
  }
}
</style>
