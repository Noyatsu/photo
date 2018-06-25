<template>
  <div class="post">
    <div class="post-header">
      <div class="post-header-left is-size-7">
        <p><router-link v-bind:to="'/user/' + photo.screen_name"><img src="https://bulma.io/images/placeholders/128x128.png"></router-link></p>
        <p><router-link v-bind:to="'/user/' + photo.screen_name"><strong>{{ photo.name }}</strong></router-link>(@{{photo.screen_name}}) at {{ photo.p_location }}</p>
      </div>
    </div>
    <div class="post-contents">
      <img v-bind:src="'/storage/photo/' + photo.path" @click="showModal = true">
    </div>
    <div class="post-footer">
      <p class="post-title"><strong>{{ photo.title }}</strong></p>
      <div class="post-right">
        <a class="button is-light"><i class="fas fa-share-alt"></i></a>
        <a class="button is-light"><i class="far fa-heart"></i>11</a>
      </div>
      <p class="is-size-7 has-text-grey">{{ photo.p_created_at }}</p>
    </div>

    <transition name="fade" mode="out-in">
      <div class="modal is-active" v-if="showModal" @close="showModal = false">
        <div class="modal-background" @click="showModal = false"></div>
        <div class="modal-card">
          <header class="modal-card-head has-background-black">
            <p class="modal-card-title has-text-light">{{ photo.title }}</p>
            <button class="delete" aria-label="close"  @click="showModal = false"></button>
          </header>
          <section class="modal-card-body has-background-black has-text-light">
            <p class="image">
              <img v-bind:src="'/storage/photo/' + photo.path" alt="">
            </p>
            <p><i class="fas fa-user fa-fw"></i> <router-link v-bind:to="'/user/' + photo.screen_name">{{ photo.name }}</router-link>(@{{photo.screen_name}})</p>
            <p><i class="fas fa-tag fa-fw"></i> <span class="tag is-dark">{{ photo.c_name }}</span></p>
            <p><i class="fas fa-map-marker fa-fw"></i> {{ photo.p_location }}</p>
            <p><i class="fas fa-camera fa-fw"></i> {{ photo.camera }}</p>
            <p><i class="far fa-dot-circle fa-fw"></i> {{ photo.lens }}</p>
            <p>{{ photo.focal_length }}mm {{ photo.speed }} F{{ photo.iris }} ISO{{ photo.iso }}</p>
            <h3>コメント</h3>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input class="input has-background-dark has-text-light" placeholder="コメントを追加">
                <span class="icon is-small is-left">
                  <i class="fas fa-comment"></i>
                </span>
              </p>
            </div>
          </section>
          <footer class="modal-card-foot has-background-black">
            <a class="button is-dark"><i class="fas fa-share-alt"></i></a>
            <a class="button is-dark"><i class="far fa-heart"></i>11</a>
            <button class="button is-dark" @click="showModal = false">閉じる</button>
          </footer>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
export default{
  name: 'post-component',
  props: [ 'photo' ],
  data: function () {
    return {
      showModal: false
    }
  },
  created () {
  }
}
</script>
<style scoped lang="scss">
.post {
  margin-top: 1rem;
  margin-bottom: 1rem;
  .post-header {
    height: 2rem;
    position: relative;

    .post-header-left {
      display: inline-block;
      position: absolute;
      left: 0.5rem;
      top: 0;
      bottom: 0;
      p {
        display: inline-block;
        vertical-align: middle;
        height: 2rem;
        line-height: 2rem;
      }
      p img {
        width: 2rem;
        height: 2rem;
        margin-right: 0.2rem;
        border-radius: 100%;
      }
    }
    .post-header-right {
      display: inline-block;
      position: absolute;
      right: 0.5rem;
      top: 0;
      bottom: 0;
    }
  }
  .post-contents {
    margin-top: 0.25rem;
  }
  .post-footer {
    position: relative;
    margin-left: 0.5rem;
    .post-right {
      display: inline-block;
      position: absolute;
      right: 0.5rem;
      top: 0.2rem;
      bottom: 0;
    }
    .post-title {
    }
    margin-top: 0rem;
  }
}

.modal {
  z-index: 1000;
}

a strong{
  color: #000000;
}

a {
  color: white;
}
</style>
