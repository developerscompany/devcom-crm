@extends('admin.layouts.app')

@section('content')
    <div id="app-vue">

            {{--{{dd($lists)}}--}}
        {{--<hosting-add></hosting-add>--}}
        <hosting-list :lists-all="{{json_encode($lists)}}" :conds="{{json_encode($conds)}}"></hosting-list>

    </div>
@endsection

