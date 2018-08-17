<template>
  <div class="has-text-centered">
    <back-button v-if="is_logined"></back-button>
    <br>
    <h1 class="title">設定</h1>
    <div class="container">
      <h2 class="subtitle is-size-7">カスタマイズ</h2>
      <a class="button is-medium is-fullwidth">プロフィール画面の編集</a>
      <a class="button is-medium is-fullwidth">通知</a>
      <a class="button is-medium is-fullwidth">ブロックユーザ一覧</a>
      <br>
      <h2 class="subtitle is-size-7">セキュリティ</h2>
      <a class="button is-medium is-fullwidth">パスワードのリセット</a>
      <a class="button is-medium is-fullwidth">アカウントの削除</a>
      <br>
      <h2 class="subtitle is-size-7">情報</h2>
      <a class="button is-medium is-fullwidth">利用規約</a>
      <a class="button is-medium is-fullwidth">使い方</a>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import BackButton from './parts/BackButton.vue';
import DetailContent from './parts/DetailContent.vue';

export default{
  components: {
    'back-button': BackButton,
    'detail-content': DetailContent
  },
  data: function () {
    return {
      photo: [],
      isLiked: false,
      is_logined: false
    }
  },
  async created() {
    this.is_logined = (user_screen_name == "") ? false : true;

  },
  methods: {
  }
}
</script>
