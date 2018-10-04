@extends('admin.layouts.app')

@section('content')
    <div id="app-vue" class="wrapper">
        <admin-bids
                :lines="{{json_encode($lines)}}"
                :agents="{{json_encode($agents)}}"
                :sources="{{json_encode($sourses)}}"
                :statuss="{{json_encode($statuses)}}"
                {{--:timing="{{json_encode($timings)}}"--}}
        ></admin-bids>
    </div>
@endsection

@section('script')

@endsection