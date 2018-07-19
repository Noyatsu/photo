<template>
  <div class="container">
    <div class="card">
      <div class="m-profile">
        <div class="m-profile-img has-background-link" v-bind:style="{ 'background-image': 'url(/storage/photo/' + user_data.background + ')', 'background-position':'center center', 'background-size': 'cover' }">
          <figure class="image is-96x96">
            <img v-bind:src="'/storage/icon/' + user_data.icon">
          </figure>
        </div>
        <div class="content">
          <p class="is-large is-size-4 has-text-weight-light is-marginless">{{ user_data.name }}</p>
          <p class="is-size-7 has-text-grey-light">@<span>{{ user_data.screen_name }}</span></p>
          <p>{{ user_data.description }}</p>

          <p v-if="!isMine">
            <a class="button is-info is-outlined" @click="followToggle" v-if="!isFollow">
              <span class="icon">
                <i class="fas fa-user-plus"></i>
              </span>
              <span>ウォッチ</span>
            </a>
            <a class="button is-info" @click="followToggle" v-if="isFollow">
              <span class="icon">
                <i class="fas fa-check"></i>
              </span>
              <span>ウォッチ中</span>
            </a>
          </p>

          <p class="is-size-7 has-text-grey-light"><time>2018/4/1</time>に登録</p>
        </div>
      </div>
      <footer class="card-footer has-text-centered">
        <a href="#" class="card-footer-item has-text-grey">投稿<br>2</a>
        <a href="#" class="card-footer-item has-text-grey">ウォッチ<br>10</a>
        <a href="#" class="card-footer-item has-text-grey">いいね<br>202</a>
      </footer>
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
      user_data: [],
      isMine: false,
      isFollow: false
    };
  },
  components: {
    'post-component': PostComponent
  },
  async created() {
    this.created_method(this.$route.params.screen_name);
  },
  methods: {
    created_method: async function(screen_name) {
      try {
        let res;
        if (this.$route.params.screen_name == undefined) {
          res = await axios.get('/api/users/' + user_screen_name);
          this.isMine = true;
        }
        else {
          res = await axios.get('/api/users/' + screen_name);
        }
        this.user_data = res.data;
      } catch (e) {
        console.error(e)
      }

      try {
        let res;
        res = await axios.get('/api/users/follow/check/' + user_screen_name + '/' + this.user_data.screen_name);
        if(res.data==true) {
          this.isFollow = true;
        }
      } catch (e) {
        console.error(e)
      }
    },
    followToggle: function() {
      axios.post('/api/users/follow/toggle', {
        screen_name: user_screen_name,
        api_token: user_api_token,
        opponent_screen_name: this.user_data.screen_name,
        csrfToken: window.Laravel.csrfToken
      })
      .then(response => {
        if(this.isFollow == true){
          this.isFollow = false;
        }
        else {
          this.isFollow = true;
        }
      })
      .catch(error => {
        console.log(error.response)
      });;
    }
  },
  watch: {
    '$route' (to, from) {
      this.created_method(to.params.screen_name);
    }
  }
}

</script>

<style scoped>
/*profile*/
.m-profile {
  text-align: center;
  margin: 0 auto;
}

.m-profile-img {
  height: 256px;
  margin-bottom: 52px;
  position: relative;
}

.m-profile figure {
  position: absolute;
  bottom: -48px;
  left: 50%;
  margin-left: -48px;
}

.m-profile img {
  border: solid 2px white;
  border-radius:100px;
}

@media (max-width: 767px) {
  .m-profile-img {
    height: 128px;
    margin-bottom: 52px;
    position: relative;
  }

  .m-profile figure {
    position: absolute;
    bottom: -48px;
    left: 50%;
    margin-left: -48px;
  }

  .m-profile img {
    border: solid 2px white;
    border-radius:100px;
  }

}
</style>
