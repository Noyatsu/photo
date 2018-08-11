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
        <div class="dropdown is-right">
          <div class="dropdown-trigger">
            <button id="dropdown-btn" class="button" aria-haspopup="true">
              <span>...</span>
            </button>
          </div>
          <div class="dropdown-menu" id="dropdown-menu" role="menu">
            <div class="dropdown-content">
              <a class="nav-link navbar-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
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
    <!--<transition name="fade" mode="out-in">-->
    <router-view></router-view>
    <!--</transition>-->
  </div>
  <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyAItrDehXl9lF8abSCqiYuP9onCHY7gs7M&libraries=places"></script>
</body>
<script src="{{ mix('js/app.js') }}"></script>
<script>
let is_dropdown = false;
if (user_screen_name != '') {
  document.getElementById("dropdown-btn").onclick = function() {
    let dropdown = document.getElementById('dropdown-menu');
    if(is_dropdown) {
      is_dropdown = false;
      dropdown.style.display ="none";
    }
    else {
      is_dropdown = true;
      dropdown.style.display ="block";
    }
  };
}
</script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
