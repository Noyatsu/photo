@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns">
        <div class="column">
            <br>
            <div class="card">
                <div class="card-header">
                    <p class="card-header-title">{{ __('新規登録') }}</p>
                </div>

                <div class="card-content">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="field">
                            <label for="name" class="label">{{ __('名前') }}</label>

                            <div class="control">
                                <input id="name" type="text" class="input{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <label for="screen_name" class="label">{{ __('ID') }}</label>

                            <div class="control">
                                <input id="screen_name" type="text" class="input{{ $errors->has('screen_name') ? ' is-invalid' : '' }}" name="screen_name" value="{{ old('screen_name') }}" required autofocus>

                                @if ($errors->has('screen_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('screen_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <label for="email" class="label">{{ __('メールアドレス') }}</label>

                            <div class="control">
                                <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

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
                            <label for="password-confirm" class="label">{{ __('パスワードをもう一度入力') }}</label>

                            <div class="control">
                                <input id="password-confirm" type="password" class="input" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-info">
                                    {{ __('新規登録する') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
