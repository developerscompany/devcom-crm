@extends('admin.layouts.app')

@section('content')
<div id="app-vue">
{{--{{dd($hosting)}}--}}
    <hosting-card :hosting="{{json_encode($hosting)}}"></hosting-card>

</div>
@endsection

