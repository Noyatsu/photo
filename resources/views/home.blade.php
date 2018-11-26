<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <link rel="manifest" href="/manifest.json">
  <link rel="icon" type="image/png" href="/images/icons/icon-72x72.png" sizes="72x72">
  <link rel="icon" type="image/png" href="/images/icons/icon-96x96.png" sizes="96x96">
  <link rel="icon" type="image/png" href="/images/icons/icon-192x192.png" sizes="192x192">
  <link rel="apple-touch-icon" type="image/png" href="/images/icons/icon-72x72.png" sizes="72x72">
  <link rel="apple-touch-icon" type="image/png" href="/images/icons/icon-96x96.png" sizes="96x96">
  <link rel="apple-touch-icon" type="image/png" href="/images/icons/icon-192x192.png" sizes="192x192">

  <script>
  // service workerが有効なら、service-worker.js を登録
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/service-worker.js').then(function() { console.log('Service Worker Registered'); });
  }
  </script>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Photo Club</title>

  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/smartphoto.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/master.css') }}">

  <script src="{{ asset('js/pulltorefresh.min.js') }}"></script>
  <script src="{{ asset('js/smartphoto.min.js') }}"></script>
  <script>
  window.Laravel = {
    csrfToken: "{{ csrf_token() }}"
  };
  const user_api_token = "{{ @Auth::user()->api_token }}";
  const user_screen_name = "{{ @Auth::user()->screen_name }}";

  </script>

</head>
 @include('layouts/home-main')
</html>
