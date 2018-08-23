@extends('admin.layouts.app')

@section('content')
<div id="app-vue">
    {{--{{dd($hosting)}}--}}
    <hosting-sale :hosting="{{json_encode($hosting)}}"></hosting-sale>

</div>
@endsection

