<template>
    <div class="admin-bids">
        <div class="form-wrapper mb-4 p-3">

            <div class="pager-view clearfix text-center">
                <div class="pull-left text-left viewNumber">
                    <a class="mx-1 nums" :class="{ 'active' : num == number }" v-for="num in nums" @click="changeNum(num)">{{num}}</a>
                </div>

                <span class="font-weight-bold" v-text="paginatedData.length"></span>

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

            <div class="mt-2">
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
                                <v-select
                                        v-model="sagent"
                                        :items="agents"
                                        item-text="name"
                                        item-value="name"
                                        label="Agent"
                                        required
                                        clearable
                                ></v-select>
                            </td>
                            <td class="filter-cell sourse">
                                Source
                                <v-select
                                        v-model="ssource"
                                        :items="sources"
                                        item-text="name"
                                        item-value="name"
                                        label="Source"
                                        required
                                ></v-select>
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
                            <td class="filter-cell response">
                                Responce
                                <v-select
                                        v-model="sresp"
                                        :items="responses"
                                        label="Responce"
                                        required
                                ></v-select>
                            </td>
                            <td class="filter-cell status">
                                Status
                                <v-select
                                        v-model="sstatus"
                                        :items="statuss"
                                        item-text="title"
                                        item-value="title"
                                        label="Status"
                                        required
                                ></v-select>
                            </td>
                            <td>
                                Comments
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="line in paginatedData">
                            <td>{{ line.date }}</td>
                            <td>{{ line.agent }}</td>
                            <td>{{ line.source }}</td>
                            <td class="link-lead">

                                <v-tooltip top>
                            <span slot="activator" color="primary" dark>
                                <a target="_blank" :href=line.link>
                                    {{ line.link.substr(0, 30) }}
                                </a>
                            </span>
                                    {{ line.link }}
                                </v-tooltip>

                            </td>
                            <td>{{ line.niche }}</td>
                            <td class="link-current">
                                <v-tooltip top>
                            <span slot="activator" color="primary" dark>
                                <a target="_blank" :href=line.current>
                                    {{ line.current.substr(0, 30) }}
                                </a>
                            </span>
                                    {{ line.current }}
                                </v-tooltip>
                            </td>
                            <td>{{ line.description }}</td>
                            <td>{{ line.timing }}</td>
                            <td>{{ line.budget }}</td>
                            <td>{{ line.response }}</td>
                            <td>{{ line.status }}</td>
                            <td>{{ line.comment }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="pager-view clearfix">
                <div class="pull-left text-left viewNumber">
                    <a class="mx-1 nums" :class="{ 'active' : num == number }" v-for="num in nums" @click="changeNum(num)">{{num}}</a>
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
</template>

<script>

    export default {
        props: ['lines', 'agents', 'sources', 'statuss'],

        data() {

            return {
                value6: '',

                sdate: [],

                date: null,
                dateFormatted: '',
                menu2: false,

                // agents: [],
                // sources: [],
                // statuss: [],
                // lines: [],
                ssource: [],
                sagent: [],
                sstatus: [],
                stech: [],
                sresp: [],

                number: 15,
                pageNumber: 0,

                responses: ['Yes', 'No'],

                active: false,
                show: false,

                nums: [5,10,15,20,50,100]
            }
        },

        mounted() {

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

                    return self.lines.filter(function(item) {

                        var current = new Date(item.date.split('.').reverse());

                        if (current >= st && current <= en)
                        {
                            return true;
                        }

                    }).slice(start, end);

                }
                if (self.sresp.length > 0) {

                    return self.lines.filter(function(item) {
                        return self.sresp.indexOf(item.response) > -1;
                    }).slice(start, end);

                }
                if (self.ssource.length > 0) {

                    return self.lines.filter(function(item) {
                        return self.ssource.indexOf(item.source) > -1;
                    }).slice(start, end);

                }
                if (self.sagent.length > 0) {

                    return self.lines.filter(function(item) {
                        return self.sagent.indexOf(item.agent) > -1;
                    }).slice(start, end);

                }
                if (self.stech.length > 0) {

                    return self.lines.filter(function (item) {
                        return Object.keys(item).some(function (key) {
                            return String(item.niche).toLowerCase().indexOf(self.stech) > -1
                        });
                    }).slice(start, end);
                }
                if (self.sstatus.length > 0) {

                    return self.lines.filter(function(item) {
                        return self.sstatus.indexOf(item.status) > -1;
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
    };

</script>

<style>

</style>