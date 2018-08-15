<template>
  <div class="field is-grouped is-grouped-centered" @dragleave.prevent @dragover.prevent @drop.prevent="onFileChange">
    <div class="file has-name is-boxed">
      <label class="file-label">
        <input class="file-input" type="file" name="photofile" accept="image/*" v-on:change="onFileChange">
        <span class="file-cta">
          <span class="file-icon">
            <i class="fas fa-camera-retro"></i>
          </span>
          <span class="file-label" v-show="!uploadedImage">
            写真を選択
          </span>
          <span class="file-label" v-show="uploadedImage">
            写真を変更
          </span>
          <img v-show="uploadedImage" :src="uploadedImage" class="updimg" id="updimg">
        </span>
        <!--<span class="file-name width100">{{ uploadedImage }}</span>-->
      </label>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      uploadedImage: ''
    };
  },
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

      let rotate = 0;
      let orientation;
      EXIF.getData(file, function() {
        orientation = EXIF.getTag(this, "Orientation");
        if (orientation) {
          switch (orientation) {
            case 3:
              rotate = 180;
              break;
            case 6:
              rotate = 90;
              break;
            case 8:
              rotate = -90;
              break;
          } 
        }
        let updimg = document.getElementById("updimg");
        updimg.style.cssText = `transform: rotate(${rotate}deg); margin: 25px 0 15px;`;
      });

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
