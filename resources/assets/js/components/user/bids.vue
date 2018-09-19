<template>
    <!--<div class="">-->
        <div class="bids">
            <div class="content-wrap p-3">
                <div id="root" class="content">
                    <div class="pager-view clearfix text-center">
                        <div class="pull-left text-left viewNumber">
                            <span>Show: </span>
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
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td></td>
                                <td>
                                    Customer
                                </td>
                                <td class="filter-cell date">
                                    Date
                                    <!--<template>-->
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
                                    <!--</template>-->
                                </td>
                                <td class="filter-cell sourse">
                                    Source
                                    <select v-model="ssource" class="form-control mt-1">
                                        <option selected value="">Source...</option>
                                        <option v-for="source in sources"> {{ source.name }}</option>
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
                                    Segment
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
                                    <select v-model="sresp" class="form-control mt-1">
                                        <option selected value="">Resp...</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td class="filter-cell status">
                                    Status
                                    <select v-model="sstatus" class="form-control mt-1">
                                        <option selected value="">Status...</option>
                                        <option v-for="status in statuss"> {{ status.title }}</option>
                                    </select>
                                </td>
                                <td>
                                    Executive
                                </td>
                                <td>
                                    Comments
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="line in paginatedData">
                                <td class="border-right text-center">{{ line.id }}</td>
                                <td>
                                    {{ line.customer }}
                                </td>
                                <td>{{ line.date }}</td>
                                <td>{{ line.source }}</td>
                                <td class="link-lead">
                                    <v-tooltip top>
                                        <span slot="activator" color="primary" dark>
                                            <a target="_blank" :href="line.link">
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
                                            <a target="_blank" :href="line.current">
                                                {{ line.current.substr(0, 30) }}
                                            </a>
                                        </span>
                                        {{ line.current }}
                                    </v-tooltip>
                                </td>
                                <td>{{ line.segment }}</td>
                                <td>{{ line.description }}</td>
                                <td>{{ line.timing }}</td>
                                <td>{{ line.budget }}</td>
                                <td>
                                    {{ line.response }}
                                    <v-icon
                                            small
                                            class=""
                                            @click="editItem2(line)">
                                        edit
                                    </v-icon>
                                </td>
                                <td>
                                    {{ line.status }}
                                    <v-icon
                                            small
                                            class=""
                                            @click="editItem(line)">
                                        edit
                                    </v-icon>
                                </td>
                                <td>
                                    {{ line.execut }}
                                </td>
                                <td>{{ line.comment }}</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                    <v-dialog v-model="dialog" max-width="500px">
                        <v-card>
                            <v-card-text>
                                <v-layout wrap>
                                    <v-flex xs12 sm6 md4>
                                        <v-select
                                                v-model="editedItem[10]"
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
                    <v-dialog v-model="dialog2" max-width="500px">
                        <v-card>
                            <v-card-text>
                                <v-layout wrap>
                                    <v-flex xs12 sm6 md4>
                                        <v-select
                                                v-model="editedItem.res"
                                                :items="responses"
                                                label="Response"
                                                item-text="title"
                                                item-value="title"
                                                required
                                        ></v-select>
                                    </v-flex>
                                </v-layout>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" flat @click.native="close2">Cancel</v-btn>
                                <v-btn color="blue darken-1" flat @click.native="save2">Save</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <div class="pager-view clearfix">
                        <div class="pull-left text-left viewNumber">
                            <span>Show: </span>
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
        </div>
    <!--</div>-->
</template>

<script>

    // import {en} from "element-ui/lib/umd/locale/en"

    export default {

        props: ['lines', 'sources', 'statuss', 'timing', 'customers'],

        data(){
            return {

                dialog: false,
                dialog2: false,
                editedIndex: -1,
                editedItem: {
                    10: '',
                    res: '',
                },
                defaultItem: {
                    10: '',
                    res: '',
                },

                value6: '',

                sdate: [],

                date: null,
                dateFormatted: '',
                menu2: false,

                responses: ['Yes', 'No'],

                ssource: [],
                sagent: [],
                sstatus: [],
                stech: [],
                sresp: [],

                number: 15,
                pageNumber: 0,

                active: false,
                show: false,

                nums: [5,10,15,20,50,100],

            }
        },

        mounted() {

        },

        watch: {

            date (val) {
                this.dateFormatted = this.formatDate(this.date)
            },

            dialog (val) {
                val || this.close()
            },

            dat(val) {

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

            onSubmit() {

                let data = this.$data;

                axios.post('/user/add-google-line', data)
                    .then(response => {
                        this.lines.unshift(response.data);
                    });
            },

            editItem (item) {
                this.editedIndex = this.paginatedData.indexOf(item);
                this.editedItem = Object.assign({}, item);
                this.dialog = true;
            },
            editItem2 (item) {
                this.editedIndex = this.paginatedData.indexOf(item);
                this.editedItem = Object.assign({}, item);
                this.dialog2 = true;
            },
            close () {
                this.dialog = false;
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem);
                    this.editedIndex = -1;
                }, 300)
            },
            close2 () {
                this.dialog2 = false;
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem);
                    this.editedIndex = -1;
                }, 300)
            },
            save () {

                let data = this.editedItem;
                let index = this.editedIndex;

                if (this.editedIndex > -1) {

                    axios.post('/user/edit-google-line', {data, index})
                        .then(
                            this.paginatedData[this.editedIndex].status = data[10]
                        );

                } else {
                    this.lines.push(this.editedItem)
                }
                this.close()
            },
            save2 () {

                let data = this.editedItem;
                let index = this.editedIndex;

                if (this.editedIndex > -1) {

                    axios.post('/user/edit-bid-response', {data, index})
                        .then(
                            this.paginatedData[this.editedIndex].response = data[10]
                        );

                } else {
                    this.lines.push(this.editedItem)
                }
                this.close()
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

    };

</script>

<style>
    #line-form ul {
        justify-content: center;
    }
    select.form-control {
        height: 22px !important;
    }
    .col-md-1 {
        margin: 0;
        text-align: center;
        position: relative;
    }
    .col-md-1:after {
        content: '';
        display: block;
        position: absolute;
        right: 1px;
        top: 0;
        height: 100%;
        width: 1px;
        background: #e5e5e5;
    }
    .col-md-1:last-child:after {
        display: none;
    }
    .form-control {
        border-color: #e5e5e5;
        padding: 0.02rem 0.1rem;
        height: auto !important;
        font-size: 13px;
        text-align: center;
        border: none;
        color: #000000;
        font-weight: bold;
        -moz-appearance: none;
        -webkit-appearance: none;
    }
    .form-control:focus {
        box-shadow: none;
    }
    .btn {
        font-size: 13px;
        padding: 0.02rem 0.3rem;
    }
    .content {
        padding: 0;
    }
    tbody {
        border-top: 1px solid #f4f5f5;
        border-bottom: 1px solid #f4f5f5;
    }
    td {
        border: none;
    }
    td.filter-cell select.form-control,
    td.filter-cell input.form-control {
        padding: 0.02rem 0.3rem;
        border: 1px solid #a1a1a1;
        font-size: 13px;
        height: auto !important;
        text-align: left;
    }
</style>