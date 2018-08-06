<template>
  <div>
    <div class="s-area has-background-light">
      <div class="tabs is-centered">
        <ul>
          <li><router-link v-bind:to="'/search/freeword/' + this.query_text">フリーワード</router-link></li>
          <li class="is-active"><a>ユーザ</a></li>
          <li><a>場所</a></li>
          <li><a>タグ</a></li>
          <li><a>カメラ・レンズ</a></li>
        </ul>
      </div>
      <div class="field has-addons">
        <div class="control is-expanded">
          <input class="input" type="text" v-model:value="query_text" v-on:keyup.enter="usr_search" placeholder="検索..">
        </div>
        <div class="control">
          <a class="button is-info" v-on:click="usr_search">
            <i class="fas fa-search"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="container">
      <user-list-item-component v-for="user in user_list" :user="user" :key="user.id"></user-list-item-component>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

import UserListItemComponent from '../parts/UserListItem.vue';

export default {
  data() {
    return {
      user_list: [],
      query_text: "",
      loading: false
    };
  },
  methods: {
    usr_search: function() {
      this.$router.push('/search/user/' + this.query_text);
    },
    created_method:async function(query_text) {
      try {
        let res = await axios.get('/api/search/user?words=' + query_text);
        this.user_list = res.data;
        console.log(this.user_list);
      } catch (e) {
        console.error(e)
      }
    }
  },
  components: {
    'user-list-item-component': UserListItemComponent
  },
  async created() {
    this.query_text = this.$route.params.words;
    this.created_method(this.query_text);
  },
  watch: {
    '$route' (to, from) {
      this.created_method(to.params.words);
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
