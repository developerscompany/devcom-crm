@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container">
            <form method="post" action="/savepassword/{{$user->id}}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group">
                    <button id="btn-save" type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </section>
@endsection