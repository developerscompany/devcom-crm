@extends('admin.layouts.app')

@section('content')
    <div id="app-vue" class="wrapper p-3">

        {{--{{ dd($bankAccs) }}--}}

        <transactions
                :bank="{{json_encode($bankAccs)}}"
                :type="{{json_encode($costTypes)}}"
                :users="{{json_encode($users)}}"
        ></transactions>

    </div>
@endsection

@section('script')

@endsection