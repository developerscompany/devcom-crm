@extends('admin.layouts.app')

@section('content')
<div id="app-vue">


    <hosting-list :lists="{{json_encode($lists)}}"></hosting-list>

</div>
@endsection

