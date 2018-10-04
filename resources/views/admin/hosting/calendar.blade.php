@extends('admin.layouts.app')

@section('content')
            <div id="app-vue">
                {{--{{dd($finances[0]->currency)}}--}}
                <hosting-calendar :finances="{{json_encode($finances)}}" :conds="{{json_encode($conds)}}"></hosting-calendar>

            </div>


@endsection

