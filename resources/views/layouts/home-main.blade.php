<body>
  <div id="app">
    <nav class="m-navbar has-background-white-ter">
      <a class="m-navbar-item" href="/home">
        {{ config('app.name') }}
      </a>
      <!-- Authentication Links -->
      @guest
      <a class="m-navbar-item" href="{{ route('login') }}">{{ __('Login') }}</a>
      <a class="m-navbar-item" href="{{ route('register') }}">{{ __('Register') }}</a>
      @else
      <div class="m-navbar-right">
        <div class="dropdown is-active is-right">
          <div class="dropdown-trigger">
            <button v-on:click="is_displaydd = !is_displaydd" class="button" aria-haspopup="true" aria-controls="dropdown-menu2">
              <i class="fas fa-ellipsis-h"></i>
            </button>
          </div>
          <div class="dropdown-menu" id="dropdown-menu2" role="menu" v-if="is_displaydd" v-on:click="is_displaydd = !is_displaydd">
            <div class="dropdown-content">
              <router-link class="dropdown-item" to="/config">設定</router-link>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('ログアウト') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </div>
        </div>

      </div>
      @endguest
    </nav>
    <div class="m-tab-bar" v-if="is_logined">
      <router-link class="m-tab" to='/home' tag="div"><i class="fas fa-home"></i></router-link>
      <router-link class="m-tab" to='/home/search' tag="div"><i class="fas fa-search"></i></router-link>
      <router-link class="m-tab" to='/home/upload' tag="div"><i class="far fa-plus-square"></i></router-link>
      <router-link class="m-tab" to='/home/like' tag="div"><i class="fas fa-heart"></i></router-link>
      <router-link class="m-tab" to='/home/profile' tag="div"><i class="fas fa-user-circle"></i></router-link>
    </div>
    <transition name="fade">
      <div class="center-box" v-if="is_loading">
        <i class="fas fa-circle-notch fa-spin fa-2x"></i>
        <p v-text="loading_msg"></p>
      </div>
    </transition>
    <transition name="fade" mode="out-in">
      <div v-bind:class="{blur : is_loading}">
        <router-view v-on:tglloading="tgl_loading($event)"></router-view>
      </div>
    </transition>
  </div>
  <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyAItrDehXl9lF8abSCqiYuP9onCHY7gs7M&libraries=places"></script>
</body>
<script src="{{ mix('js/app.js') }}"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
