@extends('layouts.app')

@section('content')
    <div class="user">
        <div class="form-wrapper mb-4 p-3">
            <form id="line-form" method="post" action="/" enctype="multipart/form-data" style="width: 100%;">
                {{ csrf_field() }}
                <ul class="nav navbar">
                    <li class="form-group">
                        <select name="source" id="source" class="form-control" required>
                            <option value="">Source...</option>
                            @foreach($sourses as $source)
                                <option value="{{ $source->name }}"> {{ $source->name }} </option>
                            @endforeach
                        </select>
                    </li>

                    <li class="form-group">
                        <input type="text" id="link" name="link" class="form-control" placeholder="Link..." required>
                    </li>

                    <li class="form-group">
                        <input type="text" id="niche" name="niche" class="form-control" placeholder="Niche..." required>
                    </li>

                    <li class="form-group">
                        <input type="text" id="site" name="site" class="form-control" placeholder="Site..." required>
                    </li>

                    <li class="form-group">
                        <input type="text" id="desc" name="desc" class="form-control" placeholder="Description..." required>
                    </li>

                    <li class="form-group">
                        <select class="form-control" name="timing" id="timing" class="form-control" required>
                            <option value="">Timing...</option>
                            @foreach($timings as $timing)
                                <option value="{{ $timing->title }}"> {{ $timing->title }} </option>
                            @endforeach
                        </select>
                    </li>

                    <li class="form-group">
                        <input type="text" id="budget" name="budget" class="form-control" placeholder="Budget..." required>
                    </li>

                    <li class="form-group">
                        <input type="text" id="resp" name="resp" class="form-control" placeholder="Response..." required>
                    </li>

                    <li class="form-group">
                        <select name="status" id="status" class="form-control" required>
                            <option value="">Response...</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->title }}"> {{ $status->title }} </option>
                            @endforeach
                        </select>
                    </li>

                    <li class="form-group">
                        <input type="text" id="comment" name="comment" class="form-control" placeholder="Comment...">
                    </li>

                    <li class="form-group align-self-end">
                        <button id="btn-save" type="submit" class="btn btn-primary">Зберегти</button>
                    </li>
                </ul>
            </form>
        </div>

        <div class="content-wrap p-3">
            <div id="root" class="content">
                <div class="pager-view clearfix">
                    <div class="pull-left text-left viewNumber">
                        <span>Show: </span>
                        <a class="nums" @click="changeNum(5)">5</a>
                        <a class="nums" @click="changeNum(10)">10</a>
                        <a class="nums" @click="changeNum(15)">15</a>
                        <a class="nums" @click="changeNum(20)">20</a>
                        <a class="nums" @click="changeNum(50)">50</a>
                        <a class="nums" @click="changeNum(100)">100</a>
                    </div>
                    <div class="pull-right text-right viewPager">
                        <button
                                :disabled="pageNumber === 0"
                                @click="prevPage">
                            prev
                        </button>
                        <button
                                :disabled="pageNumber >= pageCount"
                                @click="nextPage">
                            next
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>
                                Date
                            </th>
                            <th>
                                Agent
                            </th>
                            <th>
                                Source
                            </th>
                            <th>
                                Link to lead
                            </th>
                            <th>
                                Niche
                            </th>
                            <th>
                                Current site
                            </th>
                            <th>
                                Description
                            </th>
                            <th>
                                Timing
                            </th>
                            <th>
                                Budget $
                            </th>
                            <th>
                                Responce
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Comments
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="line in paginatedData">
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
        </div>
    </div>
@endsection

@section('script')

    <script>
        var app = new Vue({

            el: '#root',

            data: {
                lines: [],
                filterByName: [],
                ssource: '',
                number: 5,
                pageNumber: 0,
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

                            let comment = '';
                            console.log(response.data[0][11]);
                            if (response.data[0][11]){
                                comment = response.data[0][11];
                            }

                            $('#root tbody').prepend('<tr>' +
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
            },

            computed: {
                // listView: function () {
                //     var self = this;
                //     if (self.filterByName.length > 0) {
                //         return self.lines.filter(function(item) {
                //             return self.filterByName.indexOf(item[2]) > -1;
                //         });
                //     } else {
                //         return this.lines;
                //     }
                // },

                pageCount(){
                    let l = this.lines.length,
                        s = this.number;
                    return Math.floor(l/s);
                },
                paginatedData(){
                    var self = this;

                    const start = self.pageNumber * self.number,
                        end = start + self.number;
                    // return self.lines
                    //     .slice(start, end);

                    if (self.filterByName.length > 0) {
                        return self.lines.filter(function(item) {
                            return self.filterByName.indexOf(item[2]) > -1;
                        }).slice(start, end);
                    } else {
                        return this.lines.slice(start, end);
                    }
                }
            },

            methods: {

                changeNum(index) {
                    this.number = index;
                },
                nextPage()  {
                    this.pageNumber++;
                },
                prevPage(){
                    this.pageNumber--;
                }

            },

        })
    </script>
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection