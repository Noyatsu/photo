<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
  <script src="{{ asset('js/vue.js') }}"></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/master.css') }}" rel="stylesheet">
</head>
<body>
  <div id="app">
    <nav class="m-navbar has-background-white-ter">
          <a class="m-navbar-item" href="{{ url('/') }}">
            {{ config('app.name') }}
          </a>
      <!-- Authentication Links -->
      @guest
      <a class="m-navbar-item" href="{{ route('login') }}">{{ __('ログイン') }}</a>
      <a class="m-navbar-item" href="{{ route('register') }}">{{ __('新規登録') }}</a>
      @else
      <div class="m-navbar-right">
        <a class="button is-info" href="home">ホーム</a>
        <div class="dropdown is-hoverable is-right">
          <div class="dropdown-trigger">
            <button class="button" aria-haspopup="true" aria-controls="dropdown-menu3">
              <span>...</span>
            </button>
          </div>
          <div class="dropdown-menu" id="dropdown-menu3" role="menu">
            <div class="dropdown-content">
              <a class="nav-link navbar-item" href="/user">
                {{ Auth::user()->name }}のプロフィール
              </a>
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
    </div>
  </div>
</nav>

<main class="container">
  @yield('content')
</main>
</div>
</body>
</html>
