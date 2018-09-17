@extends('user.layouts.app')

@section('content')

    <div id="app-vue" class="wrapper p-3">
        <div class="form-wrapper mb-4 p-3">

            <add-customer></add-customer>

            <!--<form id="line-form"  method="post" action="/" enctype="multipart/form-data" @submit.prevent="onSubmit" style="width: 100%;">-->
            <form id="line-form"  method="post" action="/user/bid/add" enctype="multipart/form-data" style="width: 100%;">
                {{ csrf_field() }}

                <ul class="row nav">
                    <li class="col-md-1">
                        <label for="customer" class="label">Customer</label>
                        <select name="customer" id="customer" class="form-control" required>
                            <option value="">Customer...</option>
                            @foreach($customers as $customer)
                                <option> {{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </li>

                    <li class="col-md-1">
                        <label for="source" class="label">Source</label>
                        <select name="source" id="source" class="form-control" required>
                            <option value="">Source...</option>
                            @foreach($sourses as $source)
                                <option> {{ $source->name }}</option>
                            @endforeach
                        </select>
                    </li>

                    <li class="col-md-1">
                        <label for="link" class="label">Link</label>
                        <input type="text" id="link" name="link" class="form-control" placeholder="Link..." required>
                    </li>

                    <li class="col-md-1">
                        <label for="niche" class="label">Niche</label>
                        <input type="text" id="niche" name="niche" class="form-control" placeholder="Niche..." required>
                    </li>

                    <li class="col-md-1">
                        <div class="row">
                            <div class="col-4 text-left border-right px-1">
                                <label for="site" class="label">Site</label>
                                <input type="text" id="site" name="site" class="form-control" placeholder="Site..." required>
                            </div>
                            <div class="col-6">
                                <label for="segment" class="label">Segment</label>
                                <input type="text" id="segment" name="segment" class="form-control" placeholder="Segment...">
                            </div>
                        </div>
                    </li>

                    <li class="col-md-1">
                        <label for="desc" class="label">Description</label>
                        <input type="text" id="desc" name="desc" class="form-control" placeholder="Description..." required >
                    </li>

                    <li class="col-md-1">
                        <label for="timing" class="label">Timing</label>
                        <select name="timing" id="timing" class="form-control" required >
                            <option value="">Timing...</option>
                            @foreach($timings as $time)
                                <option> {{ $time->title }}</option>
                            @endforeach
                        </select>
                    </li>

                    <li class="col-md-1">
                        <label for="budget" class="label">Budget</label>
                        <input type="text" id="budget" name="budget" class="form-control" placeholder="Budget..." required >
                    </li>

                    <li class="col-md-1">
                        <label for="resp" class="label">Response</label>
                        <select name="resp" id="resp" class="form-control" required>
                            <option value="">Yes/No...</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                        {{--<input type="text" id="resp" name="resp" class="form-control" placeholder="Response..." required >--}}
                    </li>

                    <li class="col-md-1">
                        <label for="status" class="label">Status</label>
                        <select name="status" id="status" class="form-control" required >
                            <option value="">Status...</option>
                            @foreach($statuses as $status)
                                <option> {{ $status->title }}</option>
                            @endforeach
                        </select>
                    </li>

                    <li class="col-md-1">
                        <label for="execut" class="label">Executive</label>
                        <input type="text" id="execut" name="execut" class="form-control" placeholder="Executive..." >
                    </li>

                    <li class="col-md-1">
                        <label for="comment" class="label">Comment</label>
                        <input type="text" id="comment" name="comment" class="form-control" placeholder="Comment..." >
                    </li>
                </ul>
                <div class="my-2 text-center">
                    <button id="btn-save" type="submit" class="btn btn-primary">Зберегти</button>
                </div>
            </form>
        </div>

        <bids
                :lines="{{json_encode($lines)}}"
                {{--:roles="{{json_encode($agents)}}"--}}
                :sources="{{json_encode($sourses)}}"
                :statuss="{{json_encode($statuses)}}"
                :timing="{{json_encode($timings)}}"
        ></bids>
    </div>

    {{--<div class="user">--}}
        {{--<div class="form-wrapper mb-4 p-3">--}}
            {{--<form id="line-form" method="post" action="/" enctype="multipart/form-data" style="width: 100%;">--}}
                {{--{{ csrf_field() }}--}}
                {{--<ul class="row nav">--}}
                    {{--<li class="col-md-1">--}}
                        {{--<select name="source" id="source" class="form-control" required>--}}
                            {{--<option value="">Source...</option>--}}
                            {{--@foreach($sourses as $source)--}}
                                {{--<option value="{{ $source->name }}"> {{ $source->name }} </option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</li>--}}

                    {{--<li class="col-md-1">--}}
                        {{--<input type="text" id="link" name="link" class="form-control" placeholder="Link..." required>--}}
                    {{--</li>--}}

                    {{--<li class="col-md-1">--}}
                        {{--<input type="text" id="niche" name="niche" class="form-control" placeholder="Niche..." required>--}}
                    {{--</li>--}}

                    {{--<li class="col-md-1">--}}
                        {{--<input type="text" id="site" name="site" class="form-control" placeholder="Site..." required>--}}
                    {{--</li>--}}

                    {{--<li class="col-md-1">--}}
                        {{--<input type="text" id="desc" name="desc" class="form-control" placeholder="Description..." required>--}}
                    {{--</li>--}}

                    {{--<li class="col-md-1">--}}
                        {{--<select class="form-control" name="timing" id="timing" class="form-control" required>--}}
                            {{--<option value="">Timing...</option>--}}
                            {{--@foreach($timings as $timing)--}}
                                {{--<option value="{{ $timing->title }}"> {{ $timing->title }} </option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</li>--}}

                    {{--<li class="col-md-1">--}}
                        {{--<input type="text" id="budget" name="budget" class="form-control" placeholder="Budget..." required>--}}
                    {{--</li>--}}

                    {{--<li class="col-md-1">--}}
                        {{--<input type="text" id="resp" name="resp" class="form-control" placeholder="Response..." required>--}}
                    {{--</li>--}}

                    {{--<li class="col-md-1">--}}
                        {{--<select name="status" id="status" class="form-control" required>--}}
                            {{--<option value="">Status...</option>--}}
                            {{--@foreach($statuses as $status)--}}
                                {{--<option value="{{ $status->title }}"> {{ $status->title }} </option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</li>--}}

                    {{--<li class="col-md-1">--}}
                        {{--<input type="text" id="comment" name="comment" class="form-control" placeholder="Comment...">--}}
                    {{--</li>--}}

                    {{--<li class="col-md-1 align-self-end">--}}
                        {{--<button id="btn-save" type="submit" class="btn btn-primary">Зберегти</button>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</form>--}}
        {{--</div>--}}

        {{--<div class="content-wrap p-3">--}}
            {{--<div id="root" class="content">--}}
                {{--<div class="pager-view clearfix">--}}
                    {{--<div class="pull-left text-left viewNumber">--}}
                        {{--<span>Show: </span>--}}
                        {{--<a class="mx-1 nums" :class="{ 'active' : num == number }" v-for="num in nums" @click="changeNum(num)">@{{num}}</a>--}}
                    {{--</div>--}}
                    {{--<div class="pull-right text-right viewPager">--}}
                        {{--<button--}}
                                {{--:disabled="pageNumber === 0"--}}
                                {{--@click="prevPage">--}}
                            {{--prev--}}
                        {{--</button>--}}
                        {{--<button--}}
                                {{--:disabled="pageNumber >= pageCount"--}}
                                {{--@click="nextPage">--}}
                            {{--next--}}
                        {{--</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="table-responsive">--}}
                    {{--<table class="table table-striped">--}}
                        {{--<thead>--}}
                        {{--<tr>--}}
                            {{--<td class="filter-cell date">--}}
                                {{--Date--}}
                                {{--<template>--}}
                                    {{--<div class="mt-1">--}}
                                        {{--<el-date-picker--}}
                                                {{--v-model="value6"--}}
                                                {{--format="dd.MM"--}}
                                                {{--value-format="dd.MM.yyyy"--}}
                                                {{--type="daterange"--}}
                                                {{--range-separator="-"--}}
                                                {{--start-placeholder="From"--}}
                                                {{--end-placeholder="To">--}}
                                        {{--</el-date-picker>--}}
                                    {{--</div>--}}
                                {{--</template>--}}
                            {{--</td>--}}
                            {{--<td class="filter-cell sourse">--}}
                                {{--Source--}}
                                {{--<select v-model="ssource" class="form-control mt-1">--}}
                                    {{--<option value="">Source...</option>--}}
                                    {{--<option v-for="source in sources"> @{{ source.name }}</option>--}}
                                {{--</select>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--Link to lead--}}
                            {{--</td>--}}
                            {{--<td class="filter-cell niche">--}}
                                {{--Niche--}}
                                {{--<input v-model="stech" class="form-control mt-1" placeholder="Filter">--}}
                            {{--</td>--}}
                            {{--<td class="curr-site-cell">--}}
                                {{--Current site--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--Description--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--Timing--}}
                            {{--</td>--}}
                            {{--<td class="budget-td">--}}
                                {{--Budget $--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--Responce--}}
                            {{--</td>--}}
                            {{--<td class="filter-cell status">--}}
                                {{--Status--}}
                                {{--<select v-model="sstatus" class="form-control mt-1">--}}
                                    {{--<option value="">Status...</option>--}}
                                    {{--<option v-for="status in statuss"> @{{ status.title }}</option>--}}
                                {{--</select>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--Comments--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                        {{--</thead>--}}
                        {{--<tbody>--}}
                        {{--<tr v-for="line in paginatedData">--}}
                            {{--<td>@{{ line.date }}</td>--}}
                            {{--<td>@{{ line.source }}</td>--}}
                            {{--<td class="link-lead">--}}

                                {{--<v-tooltip top>--}}
                                {{--<span slot="activator" color="primary" dark>--}}
                                    {{--<a target="_blank" :href=line[3]>--}}
                                        {{--@{{ line.link.substr(0, 30) }}--}}
                                    {{--</a>--}}
                                {{--</span>--}}
                                    {{--@{{ line.link }}--}}
                                {{--</v-tooltip>--}}

                            {{--</td>--}}
                            {{--<td>@{{ line.niche }}</td>--}}
                            {{--<td class="link-current">--}}
                                {{--<v-tooltip top>--}}
                                {{--<span slot="activator" color="primary" dark>--}}
                                    {{--<a target="_blank" :href=line[3]>--}}
                                        {{--@{{ line.current.substr(0, 30) }}--}}
                                    {{--</a>--}}
                                {{--</span>--}}
                                    {{--@{{ line.current }}--}}
                                {{--</v-tooltip>--}}
                            {{--</td>--}}
                            {{--<td>@{{ line.description }}</td>--}}
                            {{--<td>@{{ line.timing }}</td>--}}
                            {{--<td>@{{ line.budget }}</td>--}}
                            {{--<td>@{{ line.response }}</td>--}}
                            {{--<td>--}}
                                {{--@{{ line.status }}--}}
                                {{--<v-icon--}}
                                        {{--small--}}
                                        {{--class=""--}}
                                        {{--@click="editItem(line)">--}}
                                    {{--edit--}}
                                {{--</v-icon>--}}
                            {{--</td>--}}
                            {{--<td>@{{ line.comment }}</td>--}}
                        {{--</tr>--}}
                        {{--</tbody>--}}
                    {{--</table>--}}

                {{--</div>--}}
                {{--<v-dialog v-model="dialog" max-width="500px">--}}
                    {{--<v-card>--}}
                        {{--<v-card-text>--}}
                            {{--<v-layout wrap>--}}
                                {{--<v-flex xs12 sm6 md4>--}}

                                    {{--<v-select--}}
                                            {{--v-model="editedItem[10]"--}}
                                            {{--:items="statuss"--}}
                                            {{--label="Status"--}}
                                            {{--item-text="title"--}}
                                            {{--item-value="title"--}}
                                            {{--required--}}
                                    {{--></v-select>--}}

                                {{--</v-flex>--}}
                            {{--</v-layout>--}}
                        {{--</v-card-text>--}}

                        {{--<v-card-actions>--}}
                            {{--<v-spacer></v-spacer>--}}
                            {{--<v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>--}}
                            {{--<v-btn color="blue darken-1" flat @click.native="save">Save</v-btn>--}}
                        {{--</v-card-actions>--}}
                    {{--</v-card>--}}
                {{--</v-dialog>--}}
                {{--<div class="pager-view clearfix">--}}
                    {{--<div class="pull-left text-left viewNumber">--}}
                        {{--<span>Show: </span>--}}
                        {{--<a class="mx-1 nums" :class="{ 'active' : num == number }" v-for="num in nums" @click="changeNum(num)">@{{num}}</a>--}}
                    {{--</div>--}}
                    {{--<div class="pull-right text-right viewPager">--}}
                        {{--<button--}}
                                {{--:disabled="pageNumber === 0"--}}
                                {{--@click="prevPage">--}}
                            {{--prev--}}
                        {{--</button>--}}
                        {{--<button--}}
                                {{--:disabled="pageNumber >= pageCount"--}}
                                {{--@click="nextPage">--}}
                            {{--next--}}
                        {{--</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--@endsection--}}

{{--@section('script')--}}

    {{--<script src="//unpkg.com/element-ui"></script>--}}
    {{--<script src="//unpkg.com/element-ui/lib/umd/locale/en.js"></script>--}}

    {{--<script>--}}

        {{--ELEMENT.locale(ELEMENT.lang.en);--}}

        {{--var app = new Vue({--}}

            {{--el: '#root',--}}

            {{--data: {--}}

                {{--dialog: false,--}}
                {{--editedIndex: -1,--}}
                {{--editedItem: {--}}
                    {{--10: '',--}}
                {{--},--}}
                {{--defaultItem: {--}}
                    {{--10: '',--}}
                {{--},--}}

                {{--value6: '',--}}

                {{--sdate: [],--}}

                {{--date: null,--}}
                {{--dateFormatted: '',--}}
                {{--menu2: false,--}}

                {{--agents: [],--}}
                {{--sources: [],--}}
                {{--statuss: [],--}}
                {{--lines: [],--}}
                {{--ssource: [],--}}
                {{--sagent: [],--}}
                {{--sstatus: [],--}}
                {{--stech: [],--}}

                {{--newLine: {},--}}

                {{--number: 5,--}}
                {{--pageNumber: 0,--}}

                {{--active: false,--}}
                {{--show: false,--}}

                {{--nums: [5,10,15,20,50,100],--}}

            {{--},--}}

            {{--mounted() {--}}

                {{--axios.get('/user/lines')--}}
                    {{--.then(response => this.lines = response.data);--}}

                {{--axios.get('/user/agents')--}}
                    {{--.then(response => this.agents = response.data);--}}

                {{--axios.get('/user/sources')--}}
                    {{--.then(response => this.sources = response.data);--}}

                {{--axios.get('/user/statuss')--}}
                    {{--.then(response => this.statuss = response.data);--}}


                {{--$('#line-form').submit(function (event) {--}}
                    {{--event.preventDefault();--}}

                    {{--let data = $(this).serialize();--}}
                    {{--$('#line-form')[0].reset();--}}

                    {{--axios.post('/user/add-google-line', data)--}}
                        {{--.then(response => {--}}
                            {{--app.lines.unshift(response.data)--}}
                        {{--});--}}
                {{--});--}}

            {{--},--}}

            {{--watch: {--}}

                {{--date (val) {--}}
                    {{--this.dateFormatted = this.formatDate(this.date)--}}
                {{--},--}}

                {{--dialog (val) {--}}
                    {{--val || this.close()--}}
                {{--},--}}

                {{--dat(val) {--}}

                {{--}--}}

            {{--},--}}

            {{--computed: {--}}

                {{--pageCount(){--}}
                    {{--let l = this.lines.length,--}}
                        {{--s = this.number;--}}
                    {{--return Math.floor(l/s);--}}
                {{--},--}}
                {{--paginatedData(){--}}
                    {{--var self = this;--}}

                    {{--const start = self.pageNumber * self.number,--}}
                        {{--end = start + self.number;--}}


                    {{--if (self.dateFormatted == null) {--}}
                        {{--self.dateFormatted = '';--}}
                    {{--}--}}
                    {{--if (self.dateFormatted.length > 0) {--}}

                        {{--return self.lines.filter(function(item) {--}}
                            {{--return self.dateFormatted.indexOf(item[0]) > -1;--}}
                        {{--}).slice(start, end);--}}

                    {{--}--}}
                    {{--if (self.ssource.length > 0) {--}}

                        {{--return self.lines.filter(function(item) {--}}
                            {{--return self.ssource.indexOf(item[2]) > -1;--}}
                        {{--}).slice(start, end);--}}

                    {{--}--}}
                    {{--if (self.sagent.length > 0) {--}}

                        {{--return self.lines.filter(function(item) {--}}
                            {{--return self.sagent.indexOf(item[1]) > -1;--}}
                        {{--}).slice(start, end);--}}

                    {{--}--}}
                    {{--if (self.stech.length > 0) {--}}

                        {{--return self.lines.filter(function (item) {--}}
                            {{--return Object.keys(item).some(function (key) {--}}
                                {{--return String(item[4]).toLowerCase().indexOf(self.stech) > -1--}}
                            {{--});--}}
                        {{--}).slice(start, end);--}}
                    {{--}--}}
                    {{--if (self.sstatus.length > 0) {--}}

                        {{--return self.lines.filter(function(item) {--}}
                            {{--return self.sstatus.indexOf(item[10]) > -1;--}}
                        {{--}).slice(start, end);--}}

                    {{--}--}}

                    {{--return this.lines.slice(start, end);--}}
                {{--}--}}
            {{--},--}}

            {{--methods: {--}}

                {{--editItem (item) {--}}
                    {{--this.editedIndex = this.lines.indexOf(item);--}}
                    {{--this.editedItem = Object.assign({}, item);--}}
                    {{--this.dialog = true;--}}
                {{--},--}}
                {{--close () {--}}
                    {{--this.dialog = false;--}}
                    {{--setTimeout(() => {--}}
                        {{--this.editedItem = Object.assign({}, this.defaultItem);--}}
                        {{--this.editedIndex = -1;--}}
                    {{--}, 300)--}}
                {{--},--}}
                {{--save () {--}}

                    {{--let data = this.editedItem;--}}
                    {{--let index = this.editedIndex;--}}

                    {{--if (this.editedIndex > -1) {--}}

                        {{--axios.post('/sale/edit-google-line', {data, index})--}}
                            {{--.then(--}}
                                {{--this.paginatedData[this.editedIndex].status = data[10]--}}
                            {{--);--}}

                    {{--} else {--}}
                        {{--this.lines.push(this.editedItem)--}}
                    {{--}--}}
                    {{--this.close()--}}
                {{--},--}}

                {{--formatDate (date) {--}}
                    {{--if (!date) return null;--}}

                    {{--const [year, month, day] = date.split('-');--}}
                    {{--return `${day}.${month}.${year}`--}}
                {{--},--}}

                {{--changeNum(index) {--}}
                    {{--this.number = index;--}}
                {{--},--}}
                {{--nextPage()  {--}}
                    {{--this.pageNumber++;--}}
                {{--},--}}
                {{--prevPage(){--}}
                    {{--this.pageNumber--;--}}
                {{--}--}}

            {{--},--}}

        {{--})--}}
    {{--</script>--}}
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
@endsection