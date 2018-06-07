<br>
<div class="card">
  <div class="m-profile">
    <div class="m-profile-img has-background-link" style="background-image: url('{{ Storage::url('photo/1.JPG') }}'); background-position:center center; background-size: cover;">
      <figure class="image is-96x96">
        <img src="https://bulma.io/images/placeholders/128x128.png" alt="Placeholder image">
      </figure>
    </div>
    <div class="content">
      <p class="is-large is-size-4 has-text-weight-light is-marginless">{{ $user->name }}</p>
      <p class="is-size-7 has-text-grey-light">@<span>{{ $user->screen_name }}</span></p>
      <p>{{ $user->description }}</p>
      <p class="is-size-7 has-text-grey-light"><time>{{ $user->created_at }}</time>に登録</p>
    </div>
  </div>
  <footer class="card-footer">
    <a href="#" class="card-footer-item">フォロー: 0</a>
    <a href="#" class="card-footer-item">フォロワー: 0</a>
    <a href="#" class="card-footer-item">いいね: 0</a>
  </footer>
</div>
