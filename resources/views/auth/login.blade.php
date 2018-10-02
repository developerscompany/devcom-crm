@extends('auth.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-12 text-uppercase text-block mb-5">
            <div>
                Удобная система
            </div>
            <div>
                управления проектами
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                {{--<div class="card-header">{{ __('Login') }}</div>--}}

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="">{{ __('Email') }}</label>

                            <input placeholder="rivocompany@gmail.com" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password" class="">{{ __('Password') }}</label>

                            <input placeholder="........." id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group row mb-0 justify-content-between">
                            <div class="col-6 text-left">
                                <button type="submit" class="btn py-2">
                                    {{ __('Log in') }}
                                </button>
                            </div>
                            <div class="col-6 text-right">
                                <a class="btn btn-link forgot" href="{{ route('password.request') }}">
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
