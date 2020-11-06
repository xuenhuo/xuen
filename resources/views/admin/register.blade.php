@extends('layouts.admin')

@section('content')
<div class="text-center">
    <form class="form-signin" method="POST" action="{{ route('admin.register') }}">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal">Please Register</h1>

        <label for="name" class="sr-only">{{ __('Name') }}</label>
        <div>
            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>

            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <label for="inputemail" class="sr-only">{{ __('E-Mail Address') }}</label>
        <div>
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email address" required>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <label for="password" class="sr-only">{{ __('Password') }}</label>
        <div>
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div>
            <label for="password-confirm" class="sr-only">{{ __('Confirm Password') }}</label>
            <div>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
            </div>
        </div>

        <button type="submit" class="btn btn-lg btn-primary btn-block">
            {{ __('Register') }}
        </button>
    </form>
</div>
@endsection