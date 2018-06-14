@extends('layouts.app')

@section('content')
<div class="container">
  <div id="tab" v-cloak>
    <div class="m-tab-bar">
      <div class="m-tab" v-for="(tab, index) in tabnavs" v-bind:class="{ 'm-tab-active': tab.isActive }" @click="changeTab(index)">
        <i v-bind:class="[ tab.cls ]"></i>
      </div>
    </div>
    <transition name="fade">
      <div v-if="contents == 0" class="m-tab-contents">
        TL
      </div>
    </transition>
    <transition name="fade">
      <div v-if="contents == 1" class="m-tab-contents">
        検索
      </div>
    </transition>
    <transition name="fade">
      <div v-if="contents == 2" class="m-tab-contents">
        @include('photo/upload')
      </div>
    </transition>
    <transition name="fade">
      <div v-if="contents == 3" class="m-tab-contents">
        いいね!
      </div>
    </transition>
    <transition name="fade">
      <div v-if="contents == 4" class="m-tab-contents">
        @include('user/profile-block')
      </div>
    </transition>
  </div>
</div>
<script>
let tab = new Vue({
  el: '#tab',
  data: {
    scrollY: 0,
    tabnavs: [
      { cls: 'fas fa-home', isActive: false, name: 'timeline'},
      { cls: 'fas fa-search', isActive: false, name: 'search' },
      { cls: 'far fa-plus-square', isActive: false, name: 'upload' },
      { cls: 'fas fa-heart', isActive:false, name: 'like' },
      { cls: 'fas fa-user-circle', isActive:false, name: 'profile' }
    ],
    contents: {{ $tab }}
  },
  methods: {
    setTab: function (index) {
      for (let i = 0; i < 5; i++) {
        this.tabnavs[i].isActive = false;
      }
      this.tabnavs[index].isActive = true;
    },
    changeTab: function (index) {
      this.contents = index;
      this.setTab(index);
      history.pushState(index,'','/home/'+this.tabnavs[index].name);
    }
  },
  created: function () {
    let self = this;
    this.tabnavs[self.contents].isActive = true;

    window.onpopstate = function(e) {
      self.contents = e.state;
      self.setTab(e.state);
    }
  }
});

</script>
@endsection
