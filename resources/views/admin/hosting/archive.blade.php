@extends('admin.layouts.app')

@section('content')
<div id="app-vue">
{{--{{dd($finances)}}--}}
    <hosting-archive :finances="{{json_encode($finances)}}"></hosting-archive>

</div>
@endsection

