@extends('admin.layouts.app')

@section('content')
    <div class="sales-page page">
        <div id="root" class="wrapper p-3">
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

            <div class="">
                <div class="">
                    <div class="table-responsive">
                        <table class="table table-striped" style="font-size: 14px; line-height: 15px">
                            <thead>
                            <tr>
                                <th>
                                    Date
                                </th>
                                <th class="filter-cell agent">
                                    Agent
                                    <input v-model="sagent" class="form-control mt-1" placeholder="Filter">
                                </th>
                                <th class="filter-cell sourse">
                                    Source
                                    <input v-model="ssource" class="form-control mt-1" placeholder="Filter">
                                </th>
                                <th>
                                    Link to lead
                                </th>
                                <th class="filter-cell niche">
                                    Niche
                                    <input v-model="stech" class="form-control mt-1" placeholder="Filter">
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
                    </div>
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
                ssource: [],
                sagent: [],
                stech: [],
                number: 5,
                pageNumber: 0,
            },

            mounted() {

                axios.get('/admin/lines')
                    .then(response => this.lines = response.data);


            },

            computed: {

                pageCount(){
                    let l = this.lines.length,
                        s = this.number;
                    return Math.floor(l/s);
                },
                paginatedData(){
                    var self = this;

                    const start = self.pageNumber * self.number,
                        end = start + self.number;

                    if (self.ssource.length > 0) {

                        return self.lines.filter(function (item) {
                            return Object.keys(item).some(function (key) {
                                return String(item[2]).toLowerCase().indexOf(self.ssource) > -1
                            });
                        }).slice(start, end);

                    } else if (self.sagent.length > 0) {

                        return self.lines.filter(function (item) {
                            return Object.keys(item).some(function (key) {
                                return String(item[1]).toLowerCase().indexOf(self.sagent) > -1
                            });
                        }).slice(start, end);
                    } else if (self.stech.length > 0) {

                        return self.lines.filter(function (item) {
                            return Object.keys(item).some(function (key) {
                                return String(item[4]).toLowerCase().indexOf(self.stech) > -1
                            });
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