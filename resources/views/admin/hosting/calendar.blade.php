@extends('admin.layouts.app')

@section('content')
<div id="app-vue">
{{--{{dd($finances)}}--}}
    <hosting-calendar :finances="{{json_encode($finances)}}"></hosting-calendar>

</div>
@endsection

