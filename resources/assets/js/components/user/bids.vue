<template>
    <!--<div class="">-->
        <div class="bids">
            <div class="content-wrap pb-4">
                <div class="form-wrap py-3">
                    <form id="line-form" v-model="form" method="post" action="/" enctype="multipart/form-data" @submit.prevent="onSubmit" style="width: 100%;">
                        <ul class="row nav">
                            <li class="col-md-1">
                                <v-select
                                    name="customer" id="customer"
                                    v-model="form.customer"
                                    :items="customers"
                                    item-text="name"
                                    item-value="name"
                                    label="Customer"
                                    :rules="[(v) => !!v || 'Item is required']"
                                    required
                                ></v-select>
                            </li>
                            <li class="col-md-1">
                                <v-select
                                        name="source" id="source"
                                        v-model="form.source"
                                        :items="sources"
                                        item-text="name"
                                        item-value="name"
                                        label="Source"
                                        required
                                ></v-select>
                            </li>

                            <li class="col-md-1">
                                <v-text-field
                                    id="link" name="link"
                                    v-model="form.link"
                                    label="Link"
                                    required
                                ></v-text-field>
                            </li>

                            <li class="col-md-1">
                                <v-text-field
                                        id="niche" name="niche"
                                        v-model="form.niche"
                                        label="Niche"
                                        required
                                ></v-text-field>
                            </li>

                            <li class="col-md-1">
                                <div class="row">
                                    <div class="col-4 text-left border-right px-1">
                                        <v-text-field
                                                id="site" name="site"
                                                v-model="form.site"
                                                label="Site"
                                                required
                                        ></v-text-field>
                                    </div>
                                    <div class="col-8">
                                        <v-text-field
                                                id="segment" name="segment"
                                                v-model="form.segment"
                                                label="Segment"
                                                required
                                        ></v-text-field>
                                    </div>
                                </div>
                            </li>

                            <li class="col-md-1">
                                <v-text-field
                                        id="desc" name="desc"
                                        v-model="form.descr"
                                        label="Description"
                                        required
                                ></v-text-field>
                            </li>

                            <li class="col-md-1">
                                <v-select
                                        name="timing" id="timing"
                                        v-model="form.timing"
                                        :items="timing"
                                        item-text="title"
                                        item-value="title"
                                        label="Timing"
                                        required
                                ></v-select>
                            </li>

                            <li class="col-md-1">
                                <v-text-field
                                        id="budget" name="budget"
                                        v-model="form.budget"
                                        label="Budget"
                                        required
                                ></v-text-field>
                            </li>

                            <li class="col-md-1">
                                <v-select
                                        name="resp" id="resp"
                                        v-model="form.response"
                                        :items="responses"
                                        label="Response"
                                        required
                                ></v-select>
                            </li>

                            <li class="col-md-1">
                                <v-select
                                        name="status" id="status"
                                        v-model="form.status"
                                        :items="statuss"
                                        item-text="title"
                                        item-value="title"
                                        label="Status"
                                        required
                                ></v-select>
                            </li>

                            <li class="col-md-1">
                                <v-text-field
                                        id="execut" name="execut"
                                        v-model="form.execut"
                                        label="Executive"
                                        required
                                ></v-text-field>
                            </li>

                            <li class="col-md-1">
                                <v-text-field
                                        id="comment" name="comment"
                                        v-model="form.comment"
                                        label="Comment"
                                        required
                                ></v-text-field>
                            </li>
                        </ul>
                        <div class="mt-3 text-center">
                            <button id="btn-save" type="submit" class="btn btn-primary sbm-button">Зберегти</button>
                        </div>
                    </form>
                </div>
                <div id="root" class="content mt-4 py-3">
                    <div class="pager-view clearfix text-center">
                        <div class="pull-left text-left viewNumber">
                            <a class="mx-1 nums" :class="{ 'active' : num == number }" v-for="num in nums" @click="changeNum(num)">{{num}}</a>
                        </div>

                        <span class="font-weight-bold" v-text="lines1.length"></span>

                        <div class="pull-right text-right viewPager">
                            <a
                                    :disabled="pageNumber === 0"
                                    @click="prevPage">
                                <
                            </a>
                            <a
                                    :disabled="pageNumber >= pageCount"
                                    @click="nextPage">
                                >
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <td></td>
                                <td class="">
                                    Customer
                                </td>
                                <td class="filter-cell date col-md-1">
                                    Date
                                    <div class="">
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
                                </td>
                                <td class="filter-cell sourse col-md-1">
                                    Source
                                    <v-select
                                            v-model="ssource"
                                            :items="sources"
                                            item-text="name"
                                            item-value="name"
                                            label="Source"
                                            required
                                            clearable
                                    ></v-select>
                                </td>
                                <td class="col-md-1">
                                    Link to lead
                                </td>
                                <td class="filter-cell niche col-md-1">
                                    Niche
                                    <v-text-field
                                            v-model="stech"
                                            label="Niche"
                                            required
                                    ></v-text-field>
                                </td>
                                <td class="curr-site-cell">
                                    Current site
                                </td>
                                <td class="">
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
                                <td class="filter-cell response col-md-1">
                                    Responce
                                    <v-select
                                            v-model="sresp"
                                            :items="responses"
                                            label="Responce"
                                            required
                                            clearable
                                    ></v-select>
                                </td>
                                <td class="filter-cell status col-md-1">
                                    Status
                                    <v-select
                                            v-model="sstatus"
                                            :items="statuss"
                                            item-text="title"
                                            item-value="title"
                                            label="Status"
                                            required
                                            clearable
                                    ></v-select>
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
                                    <v-icon
                                            small
                                            class=""
                                            @click="editItem3(line)">
                                        edit
                                    </v-icon>
                                </td>
                                <td>
                                    {{ line.comment }}
                                    <v-icon
                                            small
                                            class=""
                                            @click="editItem4(line)">
                                        edit
                                    </v-icon>
                                </td>
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
                    <v-dialog v-model="dialog3" max-width="500px">
                        <v-card>
                            <v-card-text>
                                <v-layout wrap>
                                    <v-flex xs12 sm6 md4>
                                        <v-text-field
                                                v-model="editedItem.exec"
                                                label="Executive"
                                                required
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" flat @click.native="close3">Cancel</v-btn>
                                <v-btn color="blue darken-1" flat @click.native="save3">Save</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <v-dialog v-model="dialog4" max-width="500px">
                        <v-card>
                            <v-card-text>
                                <v-layout wrap>
                                    <v-flex xs12 sm6 md4>
                                        <v-text-field
                                                v-model="editedItem.comm"
                                                label="Comment"
                                                required
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" flat @click.native="close4">Cancel</v-btn>
                                <v-btn color="blue darken-1" flat @click.native="save4">Save</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <div class="pager-view clearfix">
                        <div class="pull-left text-left viewNumber">
                            <a class="mx-1 nums" :class="{ 'active' : num == number }" v-for="num in nums" @click="changeNum(num)">{{num}}</a>
                        </div>
                        <div class="pull-right text-right viewPager">
                            <a
                                    :disabled="pageNumber === 0"
                                    @click="prevPage">
                                <
                            </a>
                            <a
                                    :disabled="pageNumber >= pageCount"
                                    @click="nextPage">
                                >
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--</div>-->
</template>

<script>

    export default {

        props: ['lines', 'sources', 'statuss', 'timing', 'customers'],

        data(){
            return {

                form: {
                    customer: null,
                    source: null,
                    link: '',
                    niche: '',
                    site: '',
                    segment: '',
                    descr: '',
                    timing: null,
                    budget: '',
                    response: null,
                    status: null,
                    execut: '',
                    comment: '',
                },

                lines1: this.$props.lines,

                dialog: false,
                dialog2: false,
                dialog3: false,
                dialog4: false,
                editedIndex: -1,
                editedItem: {
                    10: '',
                    res: '',
                    exec: '',
                    comm: '',
                },
                defaultItem: {
                    10: '',
                    res: '',
                    exec: '',
                    comm: '',
                },

                value6: '',
                sdate: [],

                date: null,
                dateFormatted: '',
                menu2: false,

                responses: ['Yes', 'No'],

                ssource: '',
                sagent: [],
                sstatus: '',
                stech: '',
                sresp: '',

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
                let l = this.lines1.length,
                    s = this.number;
                return Math.floor(l/s);
            },
            paginatedData(){
                var self = this;

                const start = self.pageNumber * self.number,
                    end = start + self.number;

                    // if (self.value6 == null) {
                    //     self.value6 = '';
                    // }

                // if (self.value6.length > 0) {
                //
                //     var st = new Date(this.value6[0].split('.').reverse());
                //     var en = new Date(this.value6[1].split('.').reverse());
                //
                //     return self.lines1.filter(function(item) {
                //
                //         var current = new Date(item.date.split('.').reverse());
                //
                //         if (current >= st && current <= en)
                //         {
                //             return true;
                //         }
                //
                //     }).slice(start, end);
                //
                // }
                //
                // if (self.sresp.length > 0) {
                //
                //     return self.lines1.filter(function(item) {
                //         return self.sresp.indexOf(item.response) > -1;
                //     }).slice(start, end);
                //
                // }
                // if (self.ssource.length > 0) {
                //
                //     return self.lines1.filter(function(item) {
                //         return self.ssource.indexOf(item.source) > -1;
                //     }).slice(start, end);
                //
                // }
                // if (self.stech.length > 0) {
                //
                //     return self.lines1.filter(function (item) {
                //         return Object.keys(item).some(function (key) {
                //             return String(item.niche).toLowerCase().indexOf(self.stech) > -1
                //         });
                //     }).slice(start, end);
                // }
                // if (self.sstatus.length > 0) {
                //
                //     return self.lines1.filter(function(item) {
                //         return self.sstatus.indexOf(item.status) > -1;
                //     }).slice(start, end);
                //
                // }

                if (self.lines1) {
                    if (self.value6 == null) {
                        self.value6 = '';
                    }
                    if (self.value6.length > 0) {
                        var st = new Date(this.value6[0].split('.').reverse());
                        var en = new Date(this.value6[1].split('.').reverse());
                    }

                    return self.lines1.filter((el) => {
                        return el.source.toLowerCase().indexOf(self.ssource.toLowerCase()) > -1 &&
                                el.response.toLowerCase().indexOf(self.sresp.toLowerCase()) > -1 &&
                                el.status.toLowerCase().indexOf(self.sstatus.toLowerCase()) > -1 &&
                                Object.keys(el).some(function (key) {
                                    return String(el.niche).toLowerCase().indexOf(self.stech) > -1
                                })
                    }).filter(function(item) {

                        if (self.value6 != '')
                        {
                            var current = new Date(item.date.split('.').reverse());

                            if (current >= st && current <= en)
                            {
                                return true;
                            }
                        }
                        else {
                            return item;
                        }

                    });
                }

                return this.lines1.slice(start, end);
            }
        },

        methods: {

            onSubmit() {

                let dataForm = this.form;

                axios.post('/user/add-google-line', dataForm)
                    .then(response => {
                        this.lines1.unshift(response.data);

                        this.form.comment = '';
                        this.form.execut = '';
                        this.form.status = '';
                        this.form.response = '';
                        this.form.budget = '';
                        this.form.descr = '';
                        this.form.segment = '';
                        this.form.site = '';
                        this.form.niche = '';
                        this.form.link = '';
                        this.form.source = '';
                        this.form.customer = '';
                        this.form.timing = '';
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
            editItem3 (item) {
                this.editedIndex = this.paginatedData.indexOf(item);
                this.editedItem = Object.assign({}, item);
                this.dialog3 = true;
            },
            editItem4 (item) {
                this.editedIndex = this.paginatedData.indexOf(item);
                this.editedItem = Object.assign({}, item);
                this.dialog4 = true;
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
            close3 () {
                this.dialog3 = false;
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem);
                    this.editedIndex = -1;
                }, 300)
            },
            close4 () {
                this.dialog4 = false;
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
                    this.lines1.push(this.editedItem)
                }
                this.close()
            },
            save2 () {

                let data = this.editedItem;
                let index = this.editedIndex;

                if (this.editedIndex > -1) {

                    axios.post('/user/edit-bid-response', {data, index})
                        .then(
                            this.paginatedData[this.editedIndex].response = data['res']
                        );

                } else {
                    this.lines1.push(this.editedItem)
                }
                this.dialog2 = false;
            },
            save3 () {

                let data = this.editedItem;
                let index = this.editedIndex;

                if (this.editedIndex > -1) {

                    axios.post('/user/edit-bid-exec', {data, index})
                        .then(
                            this.paginatedData[this.editedIndex].execut = data['exec']
                        );

                } else {
                    this.lines1.push(this.editedItem)
                }
                this.dialog3 = false;
            },
            save4 () {

                let data = this.editedItem;
                let index = this.editedIndex;

                if (this.editedIndex > -1) {

                    axios.post('/user/edit-bid-comm', {data, index})
                        .then(
                            this.paginatedData[this.editedIndex].comment = data['comm']
                        );

                } else {
                    this.lines1.push(this.editedItem)
                }
                this.dialog4 = false;
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
    .bids {
        background: #fff;
    }
    .menuable__content__active {
        background: #fff;
    }
    .content-wrapper {
        background: #f0f0f1;
    }
    .el-date-editor .el-range-separator {
        line-height: 24px;
    }
    #line-form label {
        font-weight: bold;
        font-size: 15px;
    }
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
    .form-wrap .col-md-1:after {
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
        font-size: 12px;
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
    .filter-cell.date > div {
        margin-top: 4px !important;
        padding-top: 16px !important;
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
    tr {
        transition: all 0.3s;
        box-shadow: none;
    }
    tr:hover {
        box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.5);
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
    td.filter-cell .v-select,
    td.filter-cell .v-text-field{
        /*padding: 0;*/
        /*margin: 0;*/
    }
    input::placeholder{
        color: #404447;
    }
</style>