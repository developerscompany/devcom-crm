@extends('admin.layouts.app')

@section('content')
<div id="app-vue">


    {{--{{dd($server)}}--}}

    <hosting-servers :servers="{{json_encode($servers)}}"></hosting-servers>

</div>
@endsection

