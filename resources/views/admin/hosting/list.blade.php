@extends('admin.layouts.app')

@section('content')
<div id="app-vue">

{{--    {{dd($lists[0]['amount_all_year'])}}--}}

    <hosting-list :lists="{{json_encode($lists)}}"></hosting-list>

</div>
@endsection

