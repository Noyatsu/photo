@extends('layouts.app')

@section('content')
<div class="container">
  <div class="columns">
    <div class="column">
      <br>
      <div class="card">
        <div class="m-profile">
          <div class="notification is-info m-profile">
            <figure class="image is-96x96 m-profile">
              <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
            </figure>
            <p class="title is-4">{{ $user->name }}</p>
            <p class="subtitle is-6">@<span>{{ $user->screen_name }}</span></p>
          </div>
          <div class="content">
            {{ $user->description }}
            <br>
            <p><time datetime="2016-1-1">{{ $user->created_at }}</time>に登録</p>
          </div>
        </div>
        <footer class="card-footer">
          <a href="#" class="card-footer-item">フォロー: 0</a>
          <a href="#" class="card-footer-item">フォロワー: 0</a>
          <a href="#" class="card-footer-item">いいね: 0</a>
        </footer>
      </div>
    </div>
  </div>
</div>
@endsection
