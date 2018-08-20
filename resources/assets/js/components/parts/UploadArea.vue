<template>
  <label class="m-file has-background-black-ter has-text-light has-text-centered" v-bind:style="'background-image: url(' + uploadedImage + ');'">
    <input class="file-input" type="file" name="photofile" accept="image/*" v-on:change="onFileChange" style="display:none;">
    <div>
      <i class="fas fa-camera-retro"></i>
    </div>
    <div class="file-label" v-show="!uploadedImage">
      写真を選択
    </div>
    <div class="file-label" v-show="uploadedImage">
      写真を変更
    </div>
    <!--<span class="file-name width100">{{ uploadedImage }}</span>-->
  </label>
</template>
<script>
export default {
  data() {
    return {
      uploadedImage: ''
    };
  },
  props: [ 'beforephoto'],
  methods: {
    //画像が変わったときのイベント
    onFileChange(e) {
      let files = e.target.files || e.dataTransfer.files;
      this.createImage(files[0]);

      this.$emit('send-file', files);
    },
    // アップロードした画像を表示
    createImage(file) {
      let reader = new FileReader();
      reader.onload = (e) => {
        this.uploadedImage = e.target.result;
      };
      this.path = reader.readAsDataURL(file);
    }
  },
  created() {
    if (this.beforephoto!="") {
      this.uploadedImage = this.beforephoto;
    }
  }
}
</script>
<style scoped>
.m-file {
  width: 100%;
  height: 100%;
  min-height: 96px;
  max-height: 400px;
  margin: 0 auto;
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

.updimg {
  max-width: 200px;
}
.width100 {
  width: 100%;
}
</style>
