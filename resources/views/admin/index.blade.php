@extends('admin.layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table" style="font-size: 14px; line-height: 15px">
                <thead>
                <tr>
                    <td>
                        Date
                    </td>
                    <td>
                        Agent
                    </td>
                    <td>
                        Source
                    </td>
                    <td>
                        Link to lead
                    </td>
                    <td>
                        Niche
                    </td>
                    <td>
                        Current site
                    </td>
                    <td>
                        Description
                    </td>
                    <td>
                        Timing
                    </td>
                    <td>
                        Budget $
                    </td>
                    <td>
                        Responce
                    </td>
                    <td>
                        Status
                    </td>
                    <td>
                        Comments
                    </td>
                </tr>
                </thead>
                <tbody id="root">
                <tr v-for="line in lines">
                    <td>@{{ line[0] }}</td>
                    <td>@{{ line[1] }}</td>
                    <td>@{{ line[2] }}</td>
                    <td>@{{ line[3] }}</td>
                    <td>@{{ line[4] }}</td>
                    <td>@{{ line[5] }}</td>
                    <td>@{{ line[6] }}</td>
                    <td>@{{ line[7] }}</td>
                    <td>@{{ line[8] }}</td>
                    <td>@{{ line[9] }}</td>
                    <td>@{{ line[10] }}</td>
                    <td>@{{ line[11] }}</td>
                </tr>
                </tbody>
            </table>

            {{--<div>--}}
            {{--<ul v-for="line in lines">--}}
            {{--<li>--}}
            {{--@{{ line[0] }}--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</div>--}}

        </div>
    </div>
@endsection

@section('script')

    <script>
        var app = new Vue({

            el: '#root',

            data: {
                lines: []
            },

            mounted() {

                axios.get('/admin/lines')
                    .then(response => this.lines = response.data);
            }

        })
    </script>
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection