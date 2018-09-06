@extends('user.layouts.app')

@section('content')
    <section class="section">
        <div class="container">
            <h1 class="title">Registration Confirmed</h1><br>
            <h2 class="subtitle">Your Email is successfully verified. Click here to
                <a href="{{url('/login')}}" class="button is-primary" style="margin-top: -4px">log in</a>
            </h2>
        </div>
    </section>
@endsection