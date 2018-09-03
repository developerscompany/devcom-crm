@extends('admin.layouts.app')

@section('content')
    <div id="app-vue">


    {{--{{dd($server)}}--}}
    <hosting-servers :servers="{{json_encode($servers)}}" :pays="{{json_encode($pays)}}" :paids="{{json_encode($paids)}}" :amounts="{{json_encode($amounts)}}"></hosting-servers>



    </div>
@endsection

