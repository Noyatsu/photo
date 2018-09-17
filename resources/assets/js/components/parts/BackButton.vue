<template>
  <div class="backarea">
    <transition name="fade" mode="out-in">
      <div class="has-background-white-ter">
        <a class="m-navbar-item" onclick="javascript:window.history.back(-1);return false;">
          <i class="fas fa-chevron-left"></i>
        </a>
      </div>
    </transition>
  </div>
</template>

<style>
.backarea {
  position: fixed;
  top: 1px;
  left: 0px;
  padding: 0.5rem;
  width: 15rem;
  line-height: 1.5;
  text-align: left;
  z-index: 1000;
}
</style>
