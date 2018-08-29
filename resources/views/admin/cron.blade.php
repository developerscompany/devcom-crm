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
                                <td>@{{ line[0] }}</td>
                                <td>@{{ line[1] }}</td>
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
                                <td>@{{ line[10] }}</td>
                                <td>@{{ line[11] }}</td>
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

    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection