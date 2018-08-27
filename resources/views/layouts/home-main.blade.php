<body>
  <div id="app">
    <transition name="fadedown">
      <div class="notification m-notification" v-show="is_notification" v-bind:class="notification_type" style="display: none;">
        <button class="delete" v-on:click="is_notification=false"></button>
        @{{ notification_msg }}
      </div>
    </transition>
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
            <button onclick="location.reload()" class="button">
              <i class="fas fa-sync-alt"></i>
            </button>
            <button v-on:click="is_displaydd = !is_displaydd" class="button" aria-haspopup="true" aria-controls="dropdown-menu2">
              <i class="fas fa-ellipsis-h"></i>
            </button>
          </div>
          <div class="dropdown-menu" id="dropdown-menu2" role="menu" v-show="is_displaydd" v-on:click="is_displaydd = !is_displaydd" style="display: none;">
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
    <div class="block-box" v-if="is_loading"></div>

    <transition name="fade" mode="out-in">
      <keep-alive>

        <div v-bind:class="{blur : is_loading}">
          <router-view v-on:tglloading="tgl_loading" v-on:shownotification="show_notification"></router-view>
        </div>
      </keep-alive>

    </transition>
  </div>
  <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyAItrDehXl9lF8abSCqiYuP9onCHY7gs7M&libraries=places"></script>
</body>
<script src="{{ mix('js/app.js') }}"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
