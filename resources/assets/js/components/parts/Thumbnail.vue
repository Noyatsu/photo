<template>
  <div v-on:mouseover="hovered = true" v-on:mouseleave="hovered = false">
    <router-link v-bind:to="'/photo/' + photo.p_id">
      <div class="photo" v-bind:style="'background-image: url(/storage/' + photo.path+');'">
        <transition name="fade">
          <div class="photo_title" v-if="hovered">{{ photo.title }}<br><span class="is-size-7">by @{{ photo.screen_name }}</span></div>
        </transition>
      </div>
    </router-link>
  </div>
</template>

<script>
export default{
  name: 'thumb-component',
  props: [ 'photo' ],
  data: function () {
    return {
      hovered: false
    }
  }
}
</script>

<style scoped lang="scss">
.photo {
  position: relative;
  height: 180px;
  width: 320px;
  background-color: hsl(217, 71%, 53%);
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  text-align: center;
  margin: 0.2rem;
  color: white;
  line-height: 150px;
}
@media (max-width: 767px) {
  .photo {
    height: 100px;
    width: 100px;
    margin: 0.01rem;

  }
}
.photo_title {
  position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  height: 2.5rem;
  background: -moz-linear-gradient(bottom, #000, transparent);
  background: -webkit-linear-gradient(bottom, #000, transparent);
  background-color: linear-gradient(to top, #000, transparent);
  line-height: 1;
  color: #fff;
  overflow: hidden;
  white-space: nowrap;
}
</style>
