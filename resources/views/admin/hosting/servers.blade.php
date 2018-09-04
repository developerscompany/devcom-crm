@extends('admin.layouts.app')

@section('content')
    <div id="app-vue">


    {{--{{dd($server)}}--}}
    <hosting-servers :servers="{{json_encode($servers)}}" :pay="{{json_encode($pay)}}"  :amounts="{{json_encode($amounts)}}"></hosting-servers>



    </div>
@endsection

