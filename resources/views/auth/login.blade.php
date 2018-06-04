@extends('layouts.app')

@section('content')
<div class="container">
  <div class="columns">
    <div class="column">
      <br>
      <div class="card">
        <div class="card-header">
          <p class="card-header-title">{{ __('Login') }}</p>
        </div>

        <div class="card-content">
          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="field">
              <label for="email" class="label">{{ __('E-Mail Address') }}</label>

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
              <label for="password" class="label">{{ __('Password') }}</label>

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
                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                </label>
              </div>
            </div>

            <div class="field">
              <div class="control">
                <button type="submit" class="button is-primary">
                  {{ __('Login') }}
                </button>

                <a class="button" href="{{ route('password.request') }}">
                  {{ __('Forgot Your Password?') }}
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
