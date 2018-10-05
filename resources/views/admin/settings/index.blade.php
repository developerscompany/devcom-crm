@extends('admin.layouts.app')

@section('content')

    <div id="app-vue">

        <settings :conditions="{{json_encode($conditions)}}" :currencies="{{json_encode($currencies)}}"></settings>

    </div>


@endsection



