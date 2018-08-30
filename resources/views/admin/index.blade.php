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
                                        <div class="mt-1">
                                            <el-date-picker
                                                    v-model="value6"
                                                    format="dd.MM"
                                                    value-format="dd.MM.yyyy"
                                                    type="daterange"
                                                    range-separator="-"
                                                    start-placeholder="From"
                                                    end-placeholder="To">
                                            </el-date-picker>
                                        </div>
                                    </template>
                                </td>
                                <td class="filter-cell agent">
                                    Agent
                                    <select v-model="sagent" class="form-control mt-1">
                                        <option value="">Agent...</option>
                                        <option v-for="agent in agents"> @{{ agent.name }}</option>
                                    </select>
                                </td>
                                <td class="filter-cell sourse">
                                    Source
                                    <select v-model="ssource" class="form-control mt-1">
                                        <option value="">Source...</option>
                                        <option v-for="source in sources"> @{{ source.name }}</option>
                                    </select>
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
                                <td class="budget-td">
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
                                <td>@{{ line.date }}</td>
                                <td>@{{ line.agent }}</td>
                                <td>@{{ line.source }}</td>
                                <td class="link-lead">

                                    <v-tooltip top>
                                <span slot="activator" color="primary" dark>
                                    <a target="_blank" :href=line[3]>
                                        @{{ line.link.substr(0, 30) }}
                                    </a>
                                </span>
                                        @{{ line.link }}
                                    </v-tooltip>

                                </td>
                                <td>@{{ line.niche }}</td>
                                <td class="link-current">
                                    <v-tooltip top>
                                <span slot="activator" color="primary" dark>
                                    <a target="_blank" :href=line[3]>
                                        @{{ line.current.substr(0, 30) }}
                                    </a>
                                </span>
                                        @{{ line.current }}
                                    </v-tooltip>
                                </td>
                                <td>@{{ line.description }}</td>
                                <td>@{{ line.timing }}</td>
                                <td>@{{ line.budget }}</td>
                                <td>@{{ line.responce }}</td>
                                <td>@{{ line.status }}</td>
                                <td>@{{ line.comment }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
        </div>
    </div>
@endsection

@section('script')
    <script src="//unpkg.com/element-ui"></script>
    <script src="//unpkg.com/element-ui/lib/umd/locale/en.js"></script>

    <script>

        ELEMENT.locale(ELEMENT.lang.en);

        var app = new Vue({

            el: '#root',

            data: {

                value6: '',

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

                active: false,
                show: false,

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


                    if (self.value6 == null) {
                        self.value6 = '';
                    }
                    if (self.value6.length > 0) {

                        var st = new Date(this.value6[0].split('.').reverse());
                        var en = new Date(this.value6[1].split('.').reverse());
                        // var current = new Date();

                        // console.log(start);
                        // console.log(end);
                        // console.log(current);
                        //
                        // function inRange(value)
                        // {
                        //     if (value >= start && value <= end)
                        //     {
                        //         return value;
                        //     }
                        // }

                        return self.lines.filter(function(item) {

                            var current = new Date(item[0].split('.').reverse());
                            // console.log(current);
                            // console.log(start);
                            // console.log(end);
                            // console.log(current);
                            // console.log('       ');

                            if (current >= st && current <= en)
                            {
                                return true;
                            }

                        }).slice(start, end);

                    }
                    if (self.ssource.length > 0) {

                        return self.lines.filter(function(item) {
                            // console.log(self.ssource.indexOf(item[2]));
                            return self.ssource.indexOf(item[2]) > -1;
                        }).slice(start, end);

                    }
                    if (self.sagent.length > 0) {

                        return self.lines.filter(function(item) {
                            return self.sagent.indexOf(item[1]) > -1;
                        }).slice(start, end);

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