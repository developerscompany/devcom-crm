@extends('user.layouts.app')

@section('content')
    <div id="app-vue" class="cabinet">
        <h3>Проекти:</h3>
        <user-card :projects="{{json_encode($users_projects)}}"></user-card>
    </div>
@endsection