<template>
  <section class="section">
    <div class="notification is-info" v-if="upload_mes">
      {{ upload_mes }}
    </div>
    <form>
      <apdarea @send-file="sendFile"></apdarea>
      <div class="field is-horizontal">
        <div class="field-label is-normal">
          <label class="label">情報</label>
        </div>
        <div class="field-body">
          <div class="field">
            <p class="control is-expanded has-icons-left">
              <input class="input" type="text" name="title" v-model="title" placeholder="タイトル">
              <span class="icon is-small is-left">
                <i class="far fa-image"></i>
              </span>
            </p>
          </div>
          <div class="field">
            <p class="control is-expanded has-icons-left has-icons-right">
              <input class="input" name="location" v-model="location" placeholder="撮影場所">
              <span class="icon is-small is-left">
                <i class="fas fa-map-marker"></i>
              </span>
            </p>
          </div>
        </div>
      </div>
      <div class="field is-horizontal">
        <div class="field-label is-normal">
          <label class="label"></label>
        </div>
        <div class="field-body">
          <div class="field">
            <!-- <div>
            <span class="tag is-info">Nature</span>
            <span class="tag is-info">ファインダーの中の私の世界</span>
            <span class="tag is-info">sky</span>
            <span class="tag is-info">写真好きな人とつながりたい</span>
            <span class="tag is-info">絶景</span>
          </div> -->

          <p class="control is-expanded has-icons-left">
            <input class="input" type="text" name="tag" v-model="tag" placeholder="タグ(コンマ(,)区切り)">
            <span class="icon is-small is-left">
              <i class="fas fa-tag"></i>
            </span>
          </p>
        </div>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label"></label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <textarea class="textarea" name="description" placeholder="説明"></textarea>
          </div>
        </div>
      </div>
    </div>

    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">カテゴリ</label>
      </div>
      <div class="field-body">
        <div class="field is-narrow">
          <div class="control">
            <div class="select is-fullwidth">
              <select name="category" v-model="category">
                <option v-for="category in categories" v-bind:value="category.id">{{ category.name }}</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label">
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <button type="button" class="button is-info" v-bind:disabled="is_uploading" v-on:click="onSubmit">
              <span class="icon is-small is-left">
                <i class="fas fa-upload"></i>
              </span>
              <p>アップロード</p>
            </button>
            <img src="/storage/gload.gif" v-if="is_uploading">
          </div>
        </div>
      </div>
    </div>
  </form>
</section>
</template>

<script>
import axios from 'axios';
const upd_area = require('./parts/UploadArea');

export default {
  data() {
    return {
      is_uploading: false,
      upload_mes: '',
      categories: [],
      files: [],
      title: 'Untitled',
      location: '',
      tag: '',
      description: '',
      category: '1'
    };
  },
  methods: {
    //ファイル送信処理
    onSubmit() {
      if(undefined != this.files[0]) {
        this.is_uploading = true;
        this.upload_mes = "ファイルをアップロード中です…";
        let data = new FormData;
        data.append('title', this.title);
        data.append('location', this.location);
        data.append('tag', this.tag);
        data.append('description', this.description);
        data.append('category', this.category);
        data.append('photofile', this.files[0]);
        data.append('screen_name', user_screen_name);
        data.append('api_token', user_api_token);
        //axiosでサーバーに送信
        axios.post('/api/photos/uploadtest',data)
        .then((response) => {
          console.log(response.data);
          this.upload_mes = "アップロードに成功しました!";
          this.is_uploading = false;
        })
        .catch((error) => {
          console.log(error);
          this.upload_mes = "アップロードに失敗しました…("+error+")";
          this.is_uploading = false;
        })
      }
      else {
        this.upload_mes = "写真を選択してください!";
      }
    },
    //子コンポネートからファイルを受け取り
    sendFile(files){
      this.files = files;
      this.upload_mes = "";
    }
  },
  async created() {
    //カテゴリ一覧を取得
    try {
      let res = await axios.get('/api/categories/');
      this.categories = res.data;
    } catch (e) {
      console.error(e)
    }
  },
  components:{
    //コンポーネントを登録する！
    'apdarea':upd_area
  }
}

</script>
