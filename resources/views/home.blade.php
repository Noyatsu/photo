@extends('layouts.app')

@section('content')
<div class="container">
  <div id="tab" v-cloak>
    <div class="m-tab-bar">
        <div class="m-tab" v-for="(tab, index) in tabnavs" v-bind:class="{ 'm-tab-active': tab.isActive }" @click="changeTab(index)">
          <i v-bind:class="[ tab.cls ]"></i>
        </div>
    </div>
    <div v-if="contents == 0" class="m-tab-contents">
      TL
    </div>
    <div v-if="contents == 1" class="m-tab-contents">
      検索
    </div>
    <div v-if="contents == 2" class="m-tab-contents">
      アップロード
    </div>
    <div v-if="contents == 3" class="m-tab-contents">
      いいね!
    </div>
    <div v-if="contents == 4" class="m-tab-contents">
      @include('user/profile-block')
    </div>
  </div>
</div>
<script>
var tab = new Vue({
  el: '#tab',
  data: {
    scrollY: 0,
    tabnavs: [
      { cls: 'fas fa-home', isActive: true },
      { cls: 'fas fa-search', isActive: false },
      { cls: 'far fa-plus-square', isActive: false },
      { cls: 'fas fa-heart', isActive:false },
      { cls: 'fas fa-user-circle', isActive:false }
    ],
    contents: 0
  },
  methods: {
    changeTab: function (index) {
      this.contents = index;
      this.tabnavs[0].isActive = false;
      this.tabnavs[1].isActive = false;
      this.tabnavs[2].isActive = false;
      this.tabnavs[3].isActive = false;
      this.tabnavs[4].isActive = false;
      this.tabnavs[index].isActive = true;
    }
  }
})
</script>
@endsection
