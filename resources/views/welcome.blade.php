@extends('layouts.app')

@section('content')
    <form id="line-form" method="post" action="/" enctype="multipart/form-data" style="width: 100%;">
        {{ csrf_field() }}
        <div class="row">
        <div class="form-group col-md-1">
            <label class="required" for="source">Source</label>
            <select name="source" id="source" class="form-control" required>
                @foreach($sourses as $source)
                    <option value="{{ $source->name }}"> {{ $source->name }} </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-1">
            <label class="required" for="link">Link</label>
            <input type="text" id="link" name="link" class="form-control" required>
        </div>

        <div class="form-group col-md-1">
            <label class="required" for="niche">Niche</label>
            <input type="text" id="niche" name="niche" class="form-control" required>
        </div>

        <div class="form-group col-md-1">
            <label class="required" for="site">Site</label>
            <input type="text" id="site" name="site" class="form-control" required>
        </div>

        <div class="form-group col-md-1">
            <label class="required" for="desc">Description</label>
            <input type="text" id="desc" name="desc" class="form-control" required>
        </div>

        <div class="form-group col-md-1">
            <label class="required" for="timing">Timing</label>
            <select class="form-control" name="timing" id="timing" class="form-control" required>
                @foreach($timings as $timing)
                    <option value="{{ $timing->title }}"> {{ $timing->title }} </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-1">
            <label class="required" for="budget">Budget</label>
            <input type="text" id="budget" name="budget" class="form-control" required>
        </div>

        <div class="form-group col-md-1">
            <label class="required" for="resp">Responce</label>
            <input type="text" id="resp" name="resp" class="form-control" required>
        </div>

        <div class="form-group col-md-1">
            <label class="required" for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                @foreach($statuses as $status)
                    <option value="{{ $status->title }}"> {{ $status->title }} </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-1">
            <label for="img">Comments</label>
            <input type="text" id="comment" name="comment" class="form-control">
        </div>

        <div class="form-group col-md-1 align-self-end">
            <button id="btn-save" type="submit" class="btn btn-primary">Зберегти</button>
        </div>
        </div>
    </form>

    <div class="content">
        <div class="table-responsive">
            <table class="table">
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

                axios.get('/user/lines')
                    .then(response => this.lines = response.data);


                $('#line-form').submit(function (event) {
                    event.preventDefault();

                    let data = $(this).serialize();
                    console.log(data);
                    $('#line-form')[0].reset();

                    axios.post('/user/add-google-line', data)
                        // .then(response => app.lines = response.data);
                        .then(response => {

                            if (response.data[0][11] == null){
                                let comment = '';
                            } else {
                                let comment = response.data[0][11];
                            }

                            $('#root').prepend('<tr>' +
                                    '<td>' + response.data[0][0] + '</td>' +
                                    '<td>' + response.data[0][1] + '</td>' +
                                    '<td>' + response.data[0][2] + '</td>' +
                                    '<td>' + response.data[0][3] + '</td>' +
                                    '<td>' + response.data[0][4] + '</td>' +
                                    '<td>' + response.data[0][5] + '</td>' +
                                    '<td>' + response.data[0][6] + '</td>' +
                                    '<td>' + response.data[0][7] + '</td>' +
                                    '<td>' + response.data[0][8] + '</td>' +
                                    '<td>' + response.data[0][9] + '</td>' +
                                    '<td>' + response.data[0][10] + '</td>' +
                                    '<td>' + comment + '</td>' +
                                '</tr>');
                        });
                });
            }

        })
    </script>
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection