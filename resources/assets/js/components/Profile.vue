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

          <p class="is-size-7 has-text-grey-light">2人にウォッチされています</p>
          <p class="is-size-7 has-text-grey-light"><time>2018/4/1</time>に登録</p>
        </div>
      </div>
      <footer class="card-footer has-text-centered">
        <a href="#" class="card-footer-item has-text-grey" v-bind:class="{is_selected: tab==1}" v-on:click="tab=1">投稿<br>2</a>
        <a href="#" class="card-footer-item has-text-grey" v-bind:class="{is_selected: tab==2}" v-on:click="tab=2">ウォッチ<br>10</a>
        <a href="#" class="card-footer-item has-text-grey" v-bind:class="{is_selected: tab==3}" v-on:click="tab=3">いいね<br>202</a>
      </footer>
    </div>
    <div class="tab-contents">
      <div class="photoarea" v-if="tab==1">
        <div v-for="photo in photo_list">
          <router-link v-bind:to="'/photo/' + photo.id">
            <div class="photo" v-bind:style="'background-image: url(/storage/photo/' + photo.path+');'"></div>
          </router-link>
        </div>
      </div>
      <div v-if="tab==2">
        <div class="card" v-for="f_user in follow_list">
          <router-link v-bind:to="'/user/' + f_user.screen_name">
            <div class="card-content">
              <div class="media">
                <div class="media-left">
                  <figure class="image is-48x48 is_round">
                    <img v-bind:src="'/storage/icon/' + f_user.icon" alt="">
                  </figure>
                </div>
                <div class="media-content">
                  <p class="title is-4">{{ f_user.name }}</p>
                  <p class="subtitle is-6">@{{ f_user.screen_name }}</p>
                </div>
              </div>
            </div>
          </router-link>
        </div>
      </div>
      <div class="photoarea" v-if="tab==3">
        <div class="photo">1</div>
        <div class="photo">2</div>
        <div class="photo">3</div>
        <div class="photo">4</div>
        <div class="photo">5</div>
        <div class="photo">6</div>
        <div class="photo">7</div>
        <div class="photo">8</div>
        <div class="photo">9</div>
        <div class="photo">10</div>
      </div>

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
      follow_list: [],
      photo_list: [],
      isMine: false,
      isFollow: false,
      tab: 1
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
      //ユーザデータ
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
      //フォローチェック・情報
      try {
        let res;
        res = await axios.get('/api/users/follow/check/' + user_screen_name + '/' + this.user_data.screen_name);
        if(res.data==true) {
          this.isFollow = true;
        }
        res = await axios.get('/api/users/follow/list/' + this.user_data.screen_name);
        this.follow_list = res.data;

        res = await axios.get('/api/users/photo/' + this.user_data.screen_name);
        this.photo_list = res.data;
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
