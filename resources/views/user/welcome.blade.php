@extends('user.layouts.app')

@section('content')

    <div id="app-vue" class="wrapper p-3">
        <div class="form-wrapper mb-4 p-3">

            <add-customer></add-customer>

        </div>

        <bids
                :lines="{{json_encode($lines)}}"
                {{--:agent="{{json_encode($agent)}}"--}}
                :sources="{{json_encode($sourses)}}"
                :statuss="{{json_encode($statuses)}}"
                :timing="{{json_encode($timings)}}"
                :customers="{{json_encode($customers)}}"
        ></bids>
    </div>


@endsection