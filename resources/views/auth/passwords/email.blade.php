@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns">
        <div class="column">
          <br>
            <div class="card">
              <div class="card-header">
                <p class="card-header-title">{{ __('パスワードのリセット') }}</p>
              </div>

                <div class="card-content">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="field">
                            <label for="email" type="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>

                            <div class="control">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-primary">
                                    {{ __('パスワードリセット用リンクを送信') }}
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
