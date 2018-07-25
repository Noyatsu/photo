<template>
  <div class="card">
    <router-link v-bind:to="'/user/' + user.screen_name">
      <div class="card-content">
        <div class="media">
          <div class="media-left">
            <figure class="image is-48x48 is_round">
              <img v-bind:src="'/storage/icon/' + user.icon" alt="">
            </figure>
          </div>
          <div class="media-content">
            <p class="title is-4">{{ user.name }}</p>
            <p class="subtitle is-6">@{{ user.screen_name }}</p>
          </div>
        </div>
      </div>
    </router-link>
  </div>
</template>

<script>
export default {
  props: [ 'user' ]

}
</script>
