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
    <nav class="navbar has-background-white-ter" role="navigation" aria-label="main navigation">
      <div class="navbar-brand">
        <a class="navbar-item" href="{{ url('/') }}">
          {{ config('app.name') }}
        </a>
      </div>
        <!-- Authentication Links -->
        @guest
        <a class="nav-link navbar-item" href="{{ route('login') }}">{{ __('Login') }}</a>
        <a class="nav-link navbar-item" href="{{ route('register') }}">{{ __('Register') }}</a>
        @else
        <a class="nav-link navbar-item" href="/user">
          {{ Auth::user()->name }}のプロフィール
        </a>
        <a class="nav-link navbar-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
    </li>
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
