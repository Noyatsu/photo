<template>
  <div class="post">
    <div class="post-header">
      <div class="post-header-left is-size-7">
        <p><img src="https://bulma.io/images/placeholders/128x128.png"></p>
        <p><strong>{{ photo.name }}</strong>(@{{photo.screen_name}}) {{ photo.location }}</p>
      </div>
    </div>
    <div class="post-contents">
      <img v-bind:src="'/storage/photo/' + photo.path">
    </div>
    <div class="post-footer">
      <p class="post-title"><strong>{{ photo.title }}</strong></p>
      <div class="post-right">
        <a class="button is-light"><i class="fas fa-share-alt"></i></a>
        <a class="button is-light"><i class="far fa-heart"></i></a>
      </div>
      <p class="is-size-7 has-text-grey">{{ photo.created_at }}</p>
    </div>
  </div>
</template>

<script>
export default{
  name: 'post-component',
  props: [ 'photo' ],
  data: function () {
    return {

    }
  },
  created () {
    console.log(this.photo);
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
</style>
