<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Photo Club</title>

  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/master.css') }}">
  <script>
  window.Laravel = {
    csrfToken: "{{ csrf_token() }}"
  };
  const user_api_token = "{{ $api_token }}";
  const user_screen_name = "{{ Auth::user()->screen_name }}";
  </script>
</head>
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
        <div class="dropdown is-hoverable is-right">
          <div class="dropdown-trigger">
            <button class="button" aria-haspopup="true" aria-controls="dropdown-menu3">
              <span>...</span>
            </button>
          </div>
          <div class="dropdown-menu" id="dropdown-menu3" role="menu">
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
    <div class="m-tab-bar">
      <router-link class="m-tab" to='/home' tag="div"><i class="fas fa-home"></i></router-link>
      <router-link class="m-tab" to='/home/search' tag="div"><i class="fas fa-search"></i></router-link>
      <router-link class="m-tab" to='/home/upload' tag="div"><i class="far fa-plus-square"></i></router-link>
      <router-link class="m-tab" to='/home/like' tag="div"><i class="fas fa-heart"></i></router-link>
      <router-link class="m-tab" to='/home/profile' tag="div"><i class="fas fa-user-circle"></i></router-link>
    </div>
    <transition name="fade" mode="out-in">
      <router-view></router-view>
    </transition>
  </div>
</body>
<script src="{{ mix('js/app.js') }}"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
</html>
