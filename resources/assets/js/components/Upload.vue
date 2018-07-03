<template>
<section class="section">
    <form>
      <div class="field is-grouped is-grouped-centered">
        <div class="file has-name is-boxed">
          <label class="file-label">
            <input class="file-input" type="file" name="photofile" accept="image/*" v-on:change="onFileChange">
            <span class="file-cta">
              <span class="file-icon">
                <i class="fas fa-camera-retro"></i>
              </span>
              <span class="file-label">
                写真を選択
              </span>
              <img v-show="uploadedImage" :src="uploadedImage" class="updimg">
            </span>
            <!--<span class="file-name width100">{{ uploadedImage }}</span>-->
          </label>
        </div>
      </div>
      <div class="field is-horizontal">
        <div class="field-label is-normal">
          <label class="label">情報</label>
        </div>
        <div class="field-body">
          <div class="field">
            <p class="control is-expanded has-icons-left">
              <input class="input" type="text" name="title" placeholder="タイトル">
              <span class="icon is-small is-left">
                <i class="far fa-image"></i>
              </span>
            </p>
          </div>
          <div class="field">
            <p class="control is-expanded has-icons-left has-icons-right">
              <input class="input" name="location" placeholder="撮影場所">
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
            <div>
              <span class="tag is-primary">Nature</span>
              <span class="tag is-primary">ファインダーの中の私の世界</span>
              <span class="tag is-primary">sky</span>
              <span class="tag is-primary">写真好きな人とつながりたい</span>
              <span class="tag is-primary">絶景</span>
            </div>

            <p class="control is-expanded has-icons-left">
              <input class="input" type="text" name="tag" placeholder="タグ(コンマ(,)区切り)">
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
                <select name="category">
                  <option>自然</option>
                  <option>動物</option>
                  <option>建築</option>
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
              <button class="button is-primary">
                <span class="icon is-small is-left">
                  <i class="fas fa-upload"></i>
                </span>
                <p>アップロード</p>
              </button>
            </div>
          </div>
        </div>
      </div>
    </form>
</section>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      uploadedImage: '',
      path: ''
    };
  },
  methods: {
    onFileChange(e) {
      let files = e.target.files || e.dataTransfer.files;
      this.createImage(files[0]);

    },
    // アップロードした画像を表示
    createImage(file) {
      let reader = new FileReader();
      reader.onload = (e) => {
        this.uploadedImage = e.target.result;
      };
      this.path = reader.readAsDataURL(file);
    }
  }
}

</script>

<style scoped>
.updimg {
  max-width: 200px;
}
.width100 {
  width: 100%;
}
</style>
