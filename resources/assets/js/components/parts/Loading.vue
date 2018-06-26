<template>
  <div class="loadingbox">
    <i class="fas fa-spinner fa-spin fa-2x fa-fw margin-bottom"></i>
  </div>
</template>

<style>
.loadingbox {
  background-color: #fff;
  z-index: 9999;
  position: absolute;
  top: 0px;
  bottom: 0px;
  left: 0px;
  right: 0px;
  margin: 0 auto;
}
</style>

<script>
export default{
  name: 'load-component',
}
</script>
