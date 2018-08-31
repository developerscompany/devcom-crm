@extends('admin.layouts.app')

@section('content')
    <div class="home-page page">
        <div id="app-vue" class="wrapper p-3">

            <users :users="{{json_encode($users)}}" :roles="{{json_encode($roles)}}"></users>

        </div>
    </div>
@endsection

@section('script')

@endsection