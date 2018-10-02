@extends('admin.layouts.app')

@section('content')
<div id="app-vue">
{{--{{dd($hosting)}}--}}
    <hosting-card :hosting="{{json_encode($hosting)}}" :conds="{{json_encode($conds)}}" :finances="{{json_encode($finances)}}"></hosting-card>

</div>
@endsection

