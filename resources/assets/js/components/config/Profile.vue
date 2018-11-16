<template>
  <div class="container">
    <back-button></back-button>
    <div class="card">
      <form>
      <div class="m-profile">
        <div class="m-profile-img has-background-link">
          <upload-area v-on:send-file="sendBackground" v-bind:beforephoto="user_data.background"></upload-area>
        </div>
        <div class="flex">
          <figure class="image is-96x96 is-round">
            <upload-area v-on:send-file="sendIcon" v-bind:beforephoto="user_data.icon"></upload-area>
          </figure>
        </div>
        <input class="has-text-centered input is-large" type="text" placeholder="表示名" v-model="name">
        <p class="is-size-7 has-text-grey-light">@<span>{{ user_data.screen_name }}</span></p>
        <textarea class="textarea" placeholder="あなたを紹介する説明文" v-model="description"></textarea>
        <br>
        <input class="has-text-centered input" type="text" placeholder="場所" v-model="location">
      </div>
      <footer>
        <div class="field is-grouped is-grouped-centered">
          <p class="control">
            <button type="button" class="button is-primary" v-on:click="onSubmit">
              保存
            </button>
          </p>
        </div>
      </footer>
      </form>
    </div>
  </div>
</template>
<script>
import axios from "axios";

import BackButton from "../parts/BackButton.vue";
import UploadArea from "../parts/UploadArea.vue";

export default {
  data() {
    return {
      user_data: [],
      name: "",
      location: "",
      description: "",
      icons: [],
      backs: [],
      is_logined: false
    };
  },
  components: {
    "back-button": BackButton,
    "upload-area": UploadArea
  },
  async created() {
    this.is_logined = user_screen_name == "" ? false : true;
    try {
      let res = await axios.get("/api/users/" + user_screen_name);
      this.user_data = res.data;
      this.name = this.user_data.name;
      this.location = this.user_data.location;
      this.description = this.user_data.description;
    } catch (e) {
      console.error(e);
    }
  },
  methods: {
    //ファイル送信処理
    onSubmit() {
      let data = new FormData();
      this.$emit("tglloading", "プロフィール設定中");
      data.append("name", this.name ? this.name : "Unnamed");
      data.append("location", this.location);
      data.append("description", this.description);
      data.append("backgrounds", this.backs[0]);
      data.append("icons", this.icons[0]);
      data.append("screen_name", user_screen_name);
      data.append("api_token", user_api_token);
      console.log(user_screen_name);
      console.log(user_api_token);
      //axiosでサーバーに送信
      axios
        .post("/api/users/profile/update", data)
        .then(response => {
          console.log(response.data);
          this.$emit(
            "shownotification",
            "プロフィールの更新に成功しました!",
            "is-success"
          );
          this.is_uploading = false;
          this.$emit("tglloading", "プロフィール設定中");
        })
        .catch(error => {
          console.log(error.response);
          this.$emit(
            "shownotification",
            "プロフィールの更新に失敗しました…(" +
              error +
              " " +
              error.response.data +
              ")",
            "is-danger"
          );
          this.is_uploading = false;
          this.$emit("tglloading", "プロフィール設定中");
        });
    },
    sendIcon(files) {
      this.icons = files;
    },
    sendBackground(files) {
      this.backs = files;
    }
  }
};
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

.flex {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  padding-bottom: 1rem;
}

/*profile*/
.m-profile {
  text-align: center;
  margin: 0 auto;
}

.m-profile-img {
  height: 256px;
  margin-bottom: 1rem;
  position: relative;
}

.m-profile figure label {
  border: solid 2px white;
  border-radius: 100px;
  font-size: 50%;
}

@media (max-width: 767px) {
  .m-profile-img {
    height: 128px;
    margin-bottom: 1rem;
  }

  .m-profile figure {
    display: block;
  }

  .m-profile img {
    border: solid 2px white;
    border-radius: 100px;
  }
}

footer {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
}
</style>
