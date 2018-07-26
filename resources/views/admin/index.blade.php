@extends('admin.layouts.app')

@section('content')
    <div class="sales-page page">
        <div id="root" class="wrapper p-3">
            <div class="pager-view clearfix">
                <div class="pull-left text-left viewNumber">
                    <span>Show: </span>
                    <a @click="changeNum(5)" v-link="{path : 'your-link', activeClass: 'active', exact: true}">5</a>
                    <a @click="changeNum(10)" v-link="{path : 'your-link', activeClass: 'active', exact: true}">10</a>
                    <a @click="changeNum(15)" v-link="{path : 'your-link', activeClass: 'active', exact: true}">15</a>
                    <a @click="changeNum(20)" v-link="{path : 'your-link', activeClass: 'active', exact: true}">20</a>
                    <a @click="changeNum(20)" v-link="{path : 'your-link', activeClass: 'active', exact: true}">50</a>
                    <a @click="changeNum(20)" v-link="{path : 'your-link', activeClass: 'active', exact: true}">100</a>
                </div>
                <div class="pull-right text-right viewPager">
                    <button
                            :disabled="pageNumber === 0"
                            @click="prevPage">
                        prev
                    </button>
                    <button
                            :disabled="pageNumber >= pageCount - 1"
                            @click="nextPage">
                        next
                    </button>
                </div>
            </div>

            <div class="">
                <div class="">
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
                                <td class="sourse">
                                    Source
                                    <input v-model="ssource" class="form-control mt-1" placeholder="Filter">
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
                filteredLines: [],
                ssource: '',
                number: 20,
                pageNumber: 0,
                listData:{
                    type:Array,
                    required:true
                },
                size:{
                    type:Number,
                    required:false,
                    default: this.number
                }
            },

            mounted() {

                axios.get('/admin/lines')
                    .then(response => this.lines = response.data);

                // filteredItems: function () {
                //     return this.lines.slice(0, 10)
                // },
            },

            computed: {
                filteredItems: function () {
                    return this.lines.slice(0, this.number)
                },

                pageCount(){
                    let l = this.lines.length,
                        s = this.number;
                    return Math.floor(l/s);
                },
                paginatedData(){
                    const start = this.pageNumber * this.number,
                        end = start + this.number;
                    return this.lines
                        .slice(start, end);
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