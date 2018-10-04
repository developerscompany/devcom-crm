@extends('admin.layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="/js/calendar/scheduler.umd.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="/js/calendar/flatpickr.min.js"></script>
    <script src="/js/calendar/datepicker.min.js"></script>

    <link rel="stylesheet" href="/css/scheduler.default.min.css">
    <link rel="stylesheet" href="/css/flatpickr.css">
    <link rel="stylesheet" href="/css/datepicker.css">
    <link rel="stylesheet" href="/css/app.css">

    <div id="app-calendar">

        <div id="tools">
            <button @click="addEvent">Add event</button>
            {{--<button class="red" @click="removeEvent" :disabled="selectedEvent.name == ''">Remove event</button>--}}
            {{--<label class="sel-event">Selected event: <span>@{{ selectedEvent.name || 'None' }}</span></label>--}}

            <div class="barmargin" style="width: 100%;
    text-align: right;">
                <input type="text" id="startDate" v-model="sDate">
                <input type="text" id="endDate" v-model="eDate">
                <button @click="editDate">Enter</button>
                <label>Barmargin:</label>
                <input min=0 max=10 type="number" v-model.number="barMargin">
            </div>
        </div>

        <scheduler
                ref="scheduler"
                :columns="columns"
                :row-height=50
                :bar-margin="barMargin"
                :events="{{json_encode($events)}}"
                :resources="{{json_encode($resources)}}"
                {{--:time-ranges="timeRanges"--}}
                :start-date="startDate"
                :end-date="endDate"
                :group="'project'"
                {{--@eventselectionchange="onEventSelectionChange"--}}
                @beforeeventadd="onEventAdd"
                @beforeeventdelete="onDestroyEvent"
                @aftereventsave="onEventEdit"
        >
        </scheduler>

    </div>
    <script src="/js/calendar/scheduler.js"></script>
    <script src="/js/calendar/app.js"></script>

    <style>
        .b-watermark{
            display: none;
        }
    </style>
    </body>

    <script>
        var start = document.getElementById('startDate');
        var end = document.getElementById('endDate');
        const pickerS = datepicker('#startDate');
        const pickerE = datepicker('#endDate');

        /*$( function() {
            $("#start_date").datepicker();
            $("#end_date").datepicker();
        } );*/
    </script>


@endsection



