@extends('admin.layouts.app')

@section('content')
    <div class="home-page page">
        <div id="app-vue" class="wrapper p-4">

            <add-user :roles="{{json_encode($roles)}}"></add-user>

            <users :users="{{json_encode($users)}}" :roles="{{json_encode($roles)}}"></users>

        </div>
    </div>
@endsection

@section('script')

@endsection