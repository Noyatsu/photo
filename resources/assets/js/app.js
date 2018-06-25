/**
* First we will load all of this project's JavaScript dependencies which
* includes Vue and other libraries. It is a great starting point when
* building robust, powerful web applications using Vue and Laravel.
*/

// vueとvue-routerの定義
import Vue from 'vue'
import VueRouter from 'vue-router'

//require('./bootstrap');

window.Vue = require('vue');
Vue.use(VueRouter);

// vue-routerのインスタンス化、オプションroutesでアクセスされるパスとその時に表示するComponentを指定
const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/home', component: require('./components/Home.vue') },
        { path: '/home/search', component: require('./components/Search.vue') },
        { path: '/home/upload', component: require('./components/Upload.vue') },
        { path: '/home/like', component: require('./components/Like.vue') },
        { path: '/home/profile', component: require('./components/Profile.vue') },

        { path: '/user/' + user_screen_name,  redirect: '/home/profile' },
        { path: '/user/:screen_name', component: require('./components/Profile.vue') },

    ]
});

/**
* Next, we will create a fresh Vue application instance and attach it to
* the page. Then, you may begin adding components to this application
* or customize the JavaScript scaffolding to fit your unique needs.
*/

const app = new Vue({
  router,
  el: '#app',
  data: {
    scrollY: 0,
    tabnavs: [
      { cls: 'fas fa-home', isActive: false, name: 'timeline'},
      { cls: 'fas fa-search', isActive: false, name: 'search' },
      { cls: 'far fa-plus-square', isActive: false, name: 'upload' },
      { cls: 'fas fa-heart', isActive:false, name: 'like' },
      { cls: 'fas fa-user-circle', isActive:false, name: 'profile' }
    ]
  },
  methods: {
    setTab: function (index) {
      for (let i = 0; i < 5; i++) {
        this.tabnavs[i].isActive = false;
      }
      this.tabnavs[index].isActive = true;
    }
  }
});
