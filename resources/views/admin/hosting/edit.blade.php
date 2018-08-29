@extends('admin.layouts.app')

@section('content')
<div id="app-vue">


    <hosting-edit :hosting="{{json_encode($hosting)}}"></hosting-edit>

</div>
@endsection

