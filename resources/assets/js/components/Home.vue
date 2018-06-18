<template>
  <div>
    <post-component></post-component>
  </div>
</template>

<script>
import PostComponent from './parts/Post.vue';
Vue.component('post-component', PostComponent);

export default {
}

</script>
