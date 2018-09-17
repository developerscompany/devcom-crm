@extends('user.layouts.app')

@section('content')

    <div id="app-vue" class="wrapper p-3">
        <div class="form-wrapper mb-4 p-3">

        <bids-stat
                :lines="{{json_encode($lines)}}"
                :sources="{{json_encode($sourses)}}"
                :statuss="{{json_encode($statuses)}}"
                :timing="{{json_encode($timings)}}"
        ></bids-stat>
    </div>

@endsection