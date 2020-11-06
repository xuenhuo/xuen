@extends('layouts.admin')

@section('content')
<div class="text-center">
    <form class="form-signin" method="POST" action="{{ route('admin.login') }}">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal">登录</h1>

        <label for="inputemail" class="sr-only">{{ __('Email') }}</label>
        <div>
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email address" autofocus>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <label for="inputPassword" class="sr-only">{{ __('Password') }}</label>
        <div>
            <input id="inputPassword" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password">

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>{{ __('Remember Me') }}
            </label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">
            {{ __('Login') }}
        </button>
        <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
    </form>        
</div>
@endsection
