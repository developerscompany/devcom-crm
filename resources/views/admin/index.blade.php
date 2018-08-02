@extends('admin.layouts.app')

@section('content')
    <div class="sales-page page">
        <div id="root" class="wrapper p-3">
            <div class="pager-view clearfix">
                <div class="pull-left text-left viewNumber">
                    <span>Show: </span>
                    <a class="mx-1 nums" :class="{ 'active' : num == number }" v-for="num in nums" @click="changeNum(num)">@{{num}}</a>
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
                                <td class="filter-cell date">
                                    Date
                                    <template>
                                        <v-layout>
                                            <v-flex>
                                                <v-menu
                                                        ref="menu2"
                                                        :close-on-content-click="false"
                                                        v-model="menu2"
                                                        :nudge-right="40"
                                                        :return-value.sync="date"
                                                        lazy
                                                        transition="scale-transition"
                                                        offset-y
                                                        full-width
                                                        min-width="290px"
                                                >
                                                    <v-text-field
                                                            slot="activator"
                                                            v-model="dateFormatted"
                                                            placeholder="Date"
                                                            clearable
                                                    ></v-text-field>
                                                    <v-date-picker
                                                            v-model="date"
                                                            locale="ru-ru"
                                                            color="blue lighten-1"
                                                            header-color="primary"
                                                            @input="$refs.menu2.save(date)"></v-date-picker>

                                                </v-menu>
                                            </v-flex>
                                        </v-layout>
                                    </template>
                                </td>
                                <td class="filter-cell agent">
                                    Agent
                                    <select v-model="sagent" class="form-control mt-1">
                                        <option value="">Agent...</option>
                                        <option v-for="agent in agents"> @{{ agent.name }}</option>
                                    </select>
                                    {{--<input v-model="sagent" class="form-control mt-1" placeholder="Filter">--}}
                                </td>
                                <td class="filter-cell sourse">
                                    Source
                                    <select v-model="ssource" class="form-control mt-1">
                                        <option value="">Source...</option>
                                        <option v-for="source in sources"> @{{ source.name }}</option>
                                    </select>
                                    {{--<input v-model="ssource" class="form-control mt-1" placeholder="Filter">--}}
                                </td>
                                <td>
                                    Link to lead
                                </td>
                                <td class="filter-cell niche">
                                    Niche
                                    <input v-model="stech" class="form-control mt-1" placeholder="Filter">
                                </td>
                                <td class="curr-site-cell">
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
                                <td class="filter-cell status">
                                    Status
                                    <select v-model="sstatus" class="form-control mt-1">
                                        <option value="">Status...</option>
                                        <option v-for="status in statuss"> @{{ status.title }}</option>
                                    </select>
                                </td>
                                <td>
                                    Comments
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="line in paginatedData">
                                <td>@{{ line[0] }}</td>
                                <td>@{{ line[1] }}</td>
                                <td>@{{ line[2] }}</td>
                                <td>@{{ line[3] }}</td>
                                <td>@{{ line[4] }}</td>
                                <td class="curr-site-cell">@{{ line[5] }}</td>
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

                sdate: [],

                date: null,
                dateFormatted: '',
                menu2: false,

                agents: [],
                sources: [],
                statuss: [],
                lines: [],
                ssource: [],
                sagent: [],
                sstatus: [],
                stech: [],

                number: 5,
                pageNumber: 0,

                nums: [5,10,15,20,50,100]
            },

            mounted() {

                axios.get('/admin/lines')
                    .then(response => this.lines = response.data);

                axios.get('/admin/agents')
                    .then(response => this.agents = response.data);

                axios.get('/admin/sources')
                    .then(response => this.sources = response.data);

                axios.get('/admin/statuss')
                    .then(response => this.statuss = response.data);


            },

            watch: {

                date (val) {
                    this.dateFormatted = this.formatDate(this.date)
                }
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


                    if (self.dateFormatted == null) {
                        self.dateFormatted = '';
                    }
                    if (self.dateFormatted.length > 0) {

                        return self.lines.filter(function(item) {
                            return self.dateFormatted.indexOf(item[0]) > -1;
                        }).slice(start, end);

                    }
                    if (self.ssource.length > 0) {

                        return self.lines.filter(function(item) {
                            return self.ssource.indexOf(item[2]) > -1;
                        }).slice(start, end);

                        // return self.lines.filter(function (item) {
                        //     return Object.keys(item).some(function (key) {
                        //         return String(item[2]).toLowerCase().indexOf(self.ssource) > -1
                        //     });
                        // }).slice(start, end);
                    }
                    if (self.sagent.length > 0) {

                        return self.lines.filter(function(item) {
                            return self.sagent.indexOf(item[1]) > -1;
                        }).slice(start, end);

                        // return self.lines.filter(function (item) {
                        //     return Object.keys(item).some(function (key) {
                        //         return String(item[1]).toLowerCase().indexOf(self.sagent) > -1
                        //     });
                        // }).slice(start, end);
                    }
                    if (self.stech.length > 0) {

                        return self.lines.filter(function (item) {
                            return Object.keys(item).some(function (key) {
                                return String(item[4]).toLowerCase().indexOf(self.stech) > -1
                            });
                        }).slice(start, end);
                    }
                    if (self.sstatus.length > 0) {

                        return self.lines.filter(function(item) {
                            return self.sstatus.indexOf(item[10]) > -1;
                        }).slice(start, end);

                        // return self.lines.filter(function (item) {
                        //     return Object.keys(item).some(function (key) {
                        //         return String(item[1]).toLowerCase().indexOf(self.sagent) > -1
                        //     });
                        // }).slice(start, end);
                    }

                    return this.lines.slice(start, end);
                }
            },

            methods: {

                formatDate (date) {
                    if (!date) return null;

                    const [year, month, day] = date.split('-');
                    return `${day}.${month}.${year}`
                },

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