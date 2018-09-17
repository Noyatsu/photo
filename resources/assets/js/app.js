/**
* First we will load all of this project's JavaScript dependencies which
* includes Vue and other libraries. It is a great starting point when
* building robust, powerful web applications using Vue and Laravel.
*/

// vueとvue-routerの定義
import Vue from 'vue'
import VueRouter from 'vue-router'
//require('./bootstrap');

import axios from 'axios';
import ThumbComponent from './components/parts/Thumbnail.vue';

window.Vue = require('vue');
Vue.use(VueRouter);

// vue-routerのインスタンス化、オプションroutesでアクセスされるパスとその時に表示するComponentを指定
let router = new VueRouter({
  mode: 'history',
  routes: [
    { path: '/home', component: require('./components/Home.vue') },
    { path: '/home/search', component: require('./components/Search.vue') },
    { path: '/home/upload', component: require('./components/Upload.vue') },
    { path: '/home/like', component: require('./components/Like.vue') },
    { path: '/home/profile', component: require('./components/Profile.vue') },

    { path: '/photo/:id', component: require('./components/Detail.vue') },

    { path: '/user/' + user_screen_name,  redirect: '/home/profile' },
    { path: '/user/:screen_name', component: require('./components/Profile.vue') },

    { path: '/search',  redirect: '/home/search' },
    { path: '/search/freeword', redirect: '/home/search' },
    { path: '/search/user', redirect: '/home/search' },
    { path: '/search/freeword/:words', component: require('./components/search/Freeword.vue') },
    { path: '/search/user/:words', component: require('./components/search/User.vue') },
    { path: '/search/location/:words', component: require('./components/search/Location.vue') },
    { path: '/search/tag/:words', component: require('./components/search/Tag.vue') },
    { path: '/search/lenscamera/:words', component: require('./components/search/LensCamera.vue') },

    { path: '/config', component: require('./components/config.vue') },
    { path: '/config/profile', component: require('./components/config/Profile.vue') },
  ],

  scrollBehavior (to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    } else {
      return { x: 0, y: 0 }
    }
  }
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
    is_global: false,
    is_displaydd: false,
    is_logined: false,
    is_loading: false,
    loading_msg: "読み込み中",
    is_notification: false,
    notification_msg: "こんにちは",
    notification_type: "",
    tabnavs: [
      { cls: 'fas fa-home', isActive: false, name: 'timeline'},
      { cls: 'fas fa-search', isActive: false, name: 'search' },
      { cls: 'far fa-plus-square', isActive: false, name: 'upload' },
      { cls: 'fas fa-heart', isActive:false, name: 'like' },
      { cls: 'fas fa-user-circle', isActive:false, name: 'profile' }
    ]
  },
  methods: {
    tgl_loading: function(msg) {
      this.loading_msg = msg;
      this.is_loading = !this.is_loading;
    },
    show_notification: function(msg, type) {
      this.notification_msg = msg;
      this.notification_type = type;
      this.is_notification = true;
      const self = this;
      setTimeout(function(){
        self.is_notification = false;
      }, 4000);
    },
    scroll_to_top: function() {
      window.scrollTo(0, 0);
    }
  },
  created: function() {
    this.is_logined = (user_screen_name == "") ? false : true;

  }
});
