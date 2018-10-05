@extends('admin.layouts.app')

@section('content')

    <div id="app-vue">

        <settings :conditions="{{json_encode($conditions)}}"></settings>

    </div>


@endsection



