<template>
  <div>
    <transition-group name="fade">
      <span class="tag is-light" v-for="(tag, index) in tags" v-bind:key="index" v-on:click="deleteTag(index)">{{ tag }} ×</span>
    </transition-group>
    <div class="field has-addons">
      <p class="is-expanded has-icons-left control">
        <input class="input" type="text" ref="tag" placeholder="タグ名" v-on:keyup.enter="addTag">
        <span class="icon is-small is-left">
          <i class="fas fa-tag"></i>
        </span>
      </p>
      <p class="control">
        <a class="button is-outlined" v-on:click="addTag">追加</a>
      </p>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      tags: [],
      tags_str: ''
    };
  },
  methods: {
    addTag() {
      if(this.$refs.tag.value != "") {
        this.tags.push(this.$refs.tag.value);
        this.$refs.tag.value = "";
        this.tags_str = this.tags.join(',');
        this.$emit('update-tags', this.tags_str);
      }
    },
    deleteTag(id) {
      this.tags.splice(id, 1);
      this.tags_str = this.tags.join(',');
      this.$emit('update-tags', this.tags_str);
    }
  },
  created() {

  }
}
</script>
<style scoped>
.tag{
  margin-right: 0.3rem;
  margin-bottom: 0.3rem;
}
</style>
