@extends('admin.layouts.app')

@section('content')
    <div class="home-page page">
        <div id="app-vue" class="wrapper p-3">
            {{dd($users_projects)}}

        </div>
    </div>
@endsection

@section('script')

@endsection