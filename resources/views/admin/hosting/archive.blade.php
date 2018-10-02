@extends('admin.layouts.app')

@section('content')
<div id="app-vue">
{{--{{dd($finances)}}--}}
    <hosting-archive :finances="{{json_encode($finances)}}" :conds="{{json_encode($conds)}}"></hosting-archive>

</div>
@endsection

