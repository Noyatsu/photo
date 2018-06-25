@extends('layouts.app')

@section('content')
<div class="container">
  <div class="columns">
    <div class="column">
      <br>
      <div class="card">
        <div class="card-header">
          <p class="card-header-title">{{ __('ログイン') }}</p>
        </div>

        <div class="card-content">
          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="field">
              <label for="email" class="label">{{ __('メールアドレス') }}</label>

              <div class="control">
                <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="field">
              <label for="password" class="label">{{ __('パスワード') }}</label>

              <div class="control">
                <input id="password" type="password" class="input{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="field">
              <div class="control">
                <label class="checkbox">
                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('ログイン情報を記憶') }}
                </label>
              </div>
            </div>

            <div class="field">
              <div class="control">
                <button type="submit" class="button is-info">
                  {{ __('ログイン') }}
                </button>

                <a class="button" href="{{ route('password.request') }}">
                  {{ __('パスワードを忘れましたか？') }}
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
