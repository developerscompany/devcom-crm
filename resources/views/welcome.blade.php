@extends('layouts.app')

@section('content')
    <div class="user">
        <div class="form-wrapper mb-4 p-3">
            <form id="line-form" method="post" action="/" enctype="multipart/form-data" style="width: 100%;">
                {{ csrf_field() }}
                <ul class="row nav">
                    <li class="col-md-1">
                        <select name="source" id="source" class="form-control" required>
                            <option value="">Source...</option>
                            @foreach($sourses as $source)
                                <option value="{{ $source->name }}"> {{ $source->name }} </option>
                            @endforeach
                        </select>
                    </li>

                    <li class="col-md-1">
                        <input type="text" id="link" name="link" class="form-control" placeholder="Link..." required>
                    </li>

                    <li class="col-md-1">
                        <input type="text" id="niche" name="niche" class="form-control" placeholder="Niche..." required>
                    </li>

                    <li class="col-md-1">
                        <input type="text" id="site" name="site" class="form-control" placeholder="Site..." required>
                    </li>

                    <li class="col-md-1">
                        <input type="text" id="desc" name="desc" class="form-control" placeholder="Description..." required>
                    </li>

                    <li class="col-md-1">
                        <select class="form-control" name="timing" id="timing" class="form-control" required>
                            <option value="">Timing...</option>
                            @foreach($timings as $timing)
                                <option value="{{ $timing->title }}"> {{ $timing->title }} </option>
                            @endforeach
                        </select>
                    </li>

                    <li class="col-md-1">
                        <input type="text" id="budget" name="budget" class="form-control" placeholder="Budget..." required>
                    </li>

                    <li class="col-md-1">
                        <input type="text" id="resp" name="resp" class="form-control" placeholder="Response..." required>
                    </li>

                    <li class="col-md-1">
                        <select name="status" id="status" class="form-control" required>
                            <option value="">Status...</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->title }}"> {{ $status->title }} </option>
                            @endforeach
                        </select>
                    </li>

                    <li class="col-md-1">
                        <input type="text" id="comment" name="comment" class="form-control" placeholder="Comment...">
                    </li>

                    <li class="col-md-1 align-self-end">
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
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="filter-cell date">
                                Date
                                {{--<template>--}}
                                    {{--<v-layout>--}}
                                        {{--<v-flex>--}}
                                            {{--<v-menu--}}
                                                    {{--ref="menu2"--}}
                                                    {{--:close-on-content-click="false"--}}
                                                    {{--v-model="menu2"--}}
                                                    {{--:nudge-right="40"--}}
                                                    {{--:return-value.sync="date"--}}
                                                    {{--lazy--}}
                                                    {{--transition="scale-transition"--}}
                                                    {{--offset-y--}}
                                                    {{--full-width--}}
                                                    {{--min-width="290px"--}}
                                            {{-->--}}
                                                {{--<v-text-field--}}
                                                        {{--slot="activator"--}}
                                                        {{--v-model="dateFormatted"--}}
                                                        {{--placeholder="Date"--}}
                                                        {{--clearable--}}
                                                {{--></v-text-field>--}}
                                                {{--<v-date-picker--}}
                                                        {{--v-model="date"--}}
                                                        {{--locale="ru-ru"--}}
                                                        {{--color="blue lighten-1"--}}
                                                        {{--header-color="primary"--}}
                                                        {{--@input="$refs.menu2.save(date)"></v-date-picker>--}}

                                            {{--</v-menu>--}}
                                        {{--</v-flex>--}}
                                    {{--</v-layout>--}}
                                {{--</template>--}}
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
                            <td>@{{ line[0] }}</td>
                            <td>@{{ line[2] }}</td>
                            <td class="link-lead">

                            <v-tooltip top>
                                <span slot="activator" color="primary" dark>
                                    <a target="_blank" :href=line[3]>
                                        @{{ line[3].substr(0, 30) }}
                                    </a>
                                </span>
                                @{{ line[3] }}
                            </v-tooltip>

                            </td>
                            <td>@{{ line[4] }}</td>
                            <td class="link-current">
                                <v-tooltip top>
                                <span slot="activator" color="primary" dark>
                                    <a target="_blank" :href=line[3]>
                                        @{{ line[5].substr(0, 30) }}
                                    </a>
                                </span>
                                    @{{ line[5] }}
                                </v-tooltip>
                            </td>
                            <td>@{{ line[6] }}</td>
                            <td>@{{ line[7] }}</td>
                            <td>@{{ line[8] }}</td>
                            <td>@{{ line[9] }}</td>
                            <td>
                                @{{ line[10] }}
                                <v-icon
                                        small
                                        class=""
                                        @click="editItem(line)">
                                    edit
                                </v-icon>
                            </td>
                            <td>@{{ line[11] }}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <v-dialog v-model="dialog" max-width="500px">
                    {{--<v-btn slot="activator" color="primary" dark class="mb-2">New Item</v-btn>--}}
                    <v-card>
                        <v-card-text>
                            <v-layout wrap>
                                <v-flex xs12 sm6 md4>

                                    <v-select
                                            v-model="editedItem.status"
                                            :items="statuss"
                                            label="Status"
                                            item-text="title"
                                            item-value="title"
                                            required
                                    ></v-select>

                                </v-flex>
                            </v-layout>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
                            <v-btn color="blue darken-1" flat @click.native="save">Save</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
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

                dialog: false,
                editedIndex: -1,
                editedItem: {
                    status: '',
                },
                defaultItem: {
                    status: '',
                },

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

                nums: [5,10,15,20,50,100],

            },

            mounted() {

                axios.get('/user/lines')
                    .then(response => this.lines = response.data);

                axios.get('/user/agents')
                    .then(response => this.agents = response.data);

                axios.get('/user/sources')
                    .then(response => this.sources = response.data);

                axios.get('/user/statuss')
                    .then(response => this.statuss = response.data);


                $('#line-form').submit(function (event) {
                    event.preventDefault();

                    let data = $(this).serialize();
                    $('#line-form')[0].reset();

                    axios.post('/user/add-google-line', data)
                        .then(response => {
                            app.newLine = response.data[0];
                            app.lines.unshift(app.newLine)
                        });
                });

            },

            watch: {

                date (val) {
                    this.dateFormatted = this.formatDate(this.date)
                },

                dialog (val) {
                    val || this.close()
                },

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

                editItem (item) {
                    this.editedIndex = this.lines.indexOf(item);
                    this.editedItem = Object.assign({}, item);

                    this.dialog = true;
                },
                close () {
                    this.dialog = false;
                    setTimeout(() => {
                        this.editedItem = Object.assign({}, this.defaultItem);
                        this.editedIndex = -1;
                    }, 300)
                },
                save () {
                    console.log('save');

                    let data = this.editedItem;
                    let index = this.editedIndex;

                    if (this.editedIndex > -1) {

                        app.lines[app.editedIndex][10] = app.editedItem.status;
                        // Object.assign(app.lines[app.editedIndex][10], app.editedItem.status)
                    }

                    axios.post('/user/edit-google-line', {data, index})
                        .then(
                            // this.lines[this.editedIndex][10] = this.editedItem.status
                        );

                    // else {
                    //     this.desserts.push(this.editedItem)
                    // }
                    // this.close()
                },

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