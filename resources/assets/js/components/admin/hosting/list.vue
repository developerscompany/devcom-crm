<template>
    <div class="hosting-list">

        <hosting-add></hosting-add>

        <div class="container-fluid">
            <div class="row">
                <!-- number item on page -->
                <div class="col-md-8 showing-elements">
                    <div class="showing-text">
                        Показати:
                    </div>
                    <div class="showing-number">
                        <div :class="[{active: itemsPerPage === 5}, 'number-column']" @click="itemsPerPage = 5">5</div>
                        <div :class="[{active: itemsPerPage === 10}, 'number-column']" @click="itemsPerPage = 10">10
                        </div>
                        <div :class="[{active: itemsPerPage === 20}, 'number-column']" @click="itemsPerPage = 20">20
                        </div>
                        <div :class="[{active: itemsPerPage === 50}, 'number-column']" @click="itemsPerPage = 50">50
                        </div>
                    </div>

                </div>
                <div class="col-md-4 paginate-right">
                    <!-- pagination -->
                    <ul class="pagination" v-if="itemsPerPage < resultCount && totalPages >4">
                        <!-- prev -->
                        <li class="page-item">
                            <a :class="[ 'page-link']" href="#" v-bind:key="1"
                               @click="setPage(currentPage-1)" v-if="currentPage > 1">Назад</a>
                            <div :class="[ 'page-link']" href="#" v-bind:key="1"
                                 v-else>Назад
                            </div>
                        </li>
                        <!--first page-->
                        <div class="page-item">
                            <li v-if="currentPage !== 1 && currentPage !== 2 && currentPage !== 3">
                                <a :class="[{active: currentPage === 1}, 'page-link']" href="#" v-bind:key="1"
                                   @click="setPage(1)">1 ...</a>
                            </li>
                            <li v-else>
                                <a :class="[{active: currentPage === 1}, 'page-link']" href="#" v-bind:key="1"
                                   @click="setPage(1)">1 </a>
                            </li>
                        </div>
                        <!-- other pages -->
                        <div v-if="currentPage == 1 || currentPage == 2 " class="pagination">
                            <li class="page-item"
                                v-for="pageNumber in totalPages">
                                <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#"
                                   v-bind:key="pageNumber"
                                   v-if="pageNumber == 2 || pageNumber == 3" @click="setPage(pageNumber)"
                                >{{pageNumber}}</a>
                            </li>
                        </div>

                        <div v-else-if="currentPage == (totalPages-1) || currentPage == totalPages" class="pagination">
                            <li class="page-item"
                                v-for="pageNumber in totalPages">
                                <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#"
                                   v-bind:key="pageNumber"
                                   v-if="pageNumber == (totalPages-1) || pageNumber == (totalPages-2)"
                                   @click="setPage(pageNumber)"
                                >{{pageNumber}}</a>
                            </li>
                        </div>
                        <div v-else class="pagination">
                            <li class="page-item"
                                v-for="pageNumber in totalPages">
                                <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#"
                                   v-bind:key="pageNumber"
                                   v-if="pageNumber == currentPage || pageNumber == (currentPage-1) || pageNumber == (currentPage+1)"
                                   @click="setPage(pageNumber)"
                                >{{pageNumber}}</a>
                            </li>
                        </div>

                        <!-- last page-->

                        <div class="page-item">
                            <li v-if="currentPage !== totalPages-1 && currentPage !== totalPages && currentPage !== (totalPages-2)">

                                <a :class="[{active: currentPage === totalPages}, 'page-link']" href="#"
                                   v-bind:key="totalPages"
                                   @click="setPage(totalPages)">... {{totalPages}}</a>
                            </li>
                            <li v-else>
                                <a :class="[{active: currentPage === totalPages}, 'page-link']" href="#"
                                   v-bind:key="totalPages"
                                   @click="setPage(totalPages)">{{totalPages}}</a>
                            </li>
                        </div>

                        <!-- next -->
                        <li class="page-item">
                            <a :class="[{active: currentPage !== totalPages}, 'page-link']" href="#" v-bind:key="1"
                               @click="setPage(currentPage+1)" v-if="currentPage < totalPages">Вперед</a>
                            <div :class="[{active: currentPage !== totalPages}, 'page-link']" href="#" v-bind:key="1"
                                 v-else>Вперед
                            </div>
                        </li>


                    </ul>

                    <ul class="pagination" v-else-if="itemsPerPage < resultCount && totalPages <= 4">
                        <!-- prev -->

                        <li class="page-item">
                            <a :class="['page-link']" href="#" v-bind:key="1"
                               @click="setPage(currentPage-1)" v-if="currentPage > 1">Назад</a>
                            <div :class="['page-link']" href="#" v-bind:key="1"
                                 v-else>Назад
                            </div>
                        </li>
                        <!-- all -->
                        <li class="page-item"
                            v-for="pageNumber in totalPages">
                            <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#"
                               v-bind:key="pageNumber"
                               @click="setPage(pageNumber)"
                            >{{pageNumber}}</a>
                        </li>
                        <!-- next -->
                        <li class="page-item">
                            <a :class="[ 'page-link']" href="#" v-bind:key="1"
                               @click="setPage(currentPage+1)" v-if="currentPage < totalPages">Вперед</a>
                            <div :class="[ 'page-link']" href="#" v-bind:key="1"
                                 v-else>Вперед
                            </div>
                        </li>
                    </ul>

                    <!-- /pagination -->
                </div>
            </div>
            <div class="row table-head">
                <div class="col-md-2 col-sm-12">ПІБ</div>
                <div class="col-md-2 col-sm-12">Домен</div>
                <div class="col-md-2 col-sm-12">Телефон</div>
                <div class="col-md-2 col-sm-12">Послуги</div>
                <div class="col-md-2 col-sm-12">Сума (місяць/рік)</div>
                <div class="col-md-2 col-sm-12">Дійсний до</div>
            </div>
            <div :class="['row' ,'table-content']" v-for="(list, index) in paginate">
                <div class="col-md-2 col-sm-12 list-column"><a :href="'hostings/account/'+ list.id">{{list.last_name}}
                    {{list.name}} {{list.second_name}}</a></div>
                <div class="col-md-2 col-sm-12 list-column">{{list.site}}</div>
                <div class="col-md-2 col-sm-12 list-column">{{list.phone}}</div>
                <div class="col-md-2 col-sm-12 mark-all">
                    <div v-for="(condListItem,number) in list.conditions">
                        <div  v-for="itemCond in conds">
                            <div v-if="condListItem.condition == itemCond.name"  :class="itemCond.class"><span @click="showEditCond(condListItem)">{{itemCond.name_ua}}</span>
                                <v-icon
                                        small
                                        style="display: inline-block; color: white; margin: 0 !important; font-weight: 600;"
                                        class="mr-2"
                                        @click="removeCond(condListItem, itemCond.name_ua, number, index)">
                                    clear
                                </v-icon>
                            </div>
                        </div>
                    </div>

                    <v-icon
                            small
                            class="mr-2"
                            @click="addCond(list.id, index)">
                        add
                    </v-icon>
                </div>
                <div class="col-md-2 col-sm-12 list-column"><span v-if="amountAll(list.conditions) > 0">{{amountAll(list.conditions)}}(м)</span>
                    <span v-if="amountAll(list.conditions) > 0 && amountAllYear(list.conditions) > 0">/</span>
                    <span v-if="amountAllYear(list.conditions) > 0">{{amountAllYear(list.conditions)}}(р)</span></div>
                <div class="col-md-1 col-sm-12 list-column" >
                    <div v-if="list.latest_finance">{{editShortDate(list.latest_finance.really_to)}}</div>
                </div>
                <div class="col-md-1 col-sm-12 list-column" >
                    <v-icon
                            small
                            class="mr-2"
                            style="display: inline-block;"

                            @click="showEditPopup(list)">
                        edit
                    </v-icon>
                    <v-icon
                            small
                            class="mr-2"
                            style="display: inline-block;"
                            @click="showSalePopup(list)">
                        attach_money
                    </v-icon>
                </div>
            </div>
            <div class="row">
                <!-- number item on page -->
                <div class="col-md-8 showing-elements">
                    <div class="showing-text">
                        Показати:
                    </div>
                    <div class="showing-number">
                        <div :class="[{active: itemsPerPage === 5}, 'number-column']" @click="itemsPerPage = 5">5</div>
                        <div :class="[{active: itemsPerPage === 10}, 'number-column']" @click="itemsPerPage = 10">10
                        </div>
                        <div :class="[{active: itemsPerPage === 20}, 'number-column']" @click="itemsPerPage = 20">20
                        </div>
                        <div :class="[{active: itemsPerPage === 50}, 'number-column']" @click="itemsPerPage = 50">50
                        </div>
                    </div>

                </div>
                <div class="col-md-4 paginate-right">
                    <!-- pagination -->
                    <ul class="pagination" v-if="itemsPerPage < resultCount && totalPages >4">
                        <!-- prev -->
                        <li class="page-item">
                            <a :class="[{active: currentPage !== 1}, 'page-link']" href="#" v-bind:key="1"
                               @click="setPage(currentPage-1)" v-if="currentPage > 1">Назад</a>
                            <div :class="[{active: currentPage !== 1}, 'page-link']" href="#" v-bind:key="1"
                                 v-else>Назад
                            </div>
                        </li>
                        <!--first page-->
                        <div class="page-item">
                            <li v-if="currentPage !== 1 && currentPage !== 2 && currentPage !== 3">
                                <a :class="[{active: currentPage === 1}, 'page-link']" href="#" v-bind:key="1"
                                   @click="setPage(1)">1 ...</a>
                            </li>
                            <li v-else>
                                <a :class="[{active: currentPage === 1}, 'page-link']" href="#" v-bind:key="1"
                                   @click="setPage(1)">1 </a>
                            </li>
                        </div>
                        <!-- other pages -->
                        <div v-if="currentPage == 1 || currentPage == 2 " class="pagination">
                            <li class="page-item"
                                v-for="pageNumber in totalPages">
                                <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#"
                                   v-bind:key="pageNumber"
                                   v-if="pageNumber == 2 || pageNumber == 3" @click="setPage(pageNumber)"
                                >{{pageNumber}}</a>
                            </li>
                        </div>

                        <div v-else-if="currentPage == (totalPages-1) || currentPage == totalPages" class="pagination">
                            <li class="page-item"
                                v-for="pageNumber in totalPages">
                                <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#"
                                   v-bind:key="pageNumber"
                                   v-if="pageNumber == (totalPages-1) || pageNumber == (totalPages-2)"
                                   @click="setPage(pageNumber)"
                                >{{pageNumber}}</a>
                            </li>
                        </div>
                        <div v-else class="pagination">
                            <li class="page-item"
                                v-for="pageNumber in totalPages">
                                <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#"
                                   v-bind:key="pageNumber"
                                   v-if="pageNumber == currentPage || pageNumber == (currentPage-1) || pageNumber == (currentPage+1)"
                                   @click="setPage(pageNumber)"
                                >{{pageNumber}}</a>
                            </li>
                        </div>

                        <!-- last page-->

                        <div class="page-item">
                            <li v-if="currentPage !== totalPages-1 && currentPage !== totalPages && currentPage !== (totalPages-2)">

                                <a :class="[{active: currentPage === totalPages}, 'page-link']" href="#"
                                   v-bind:key="totalPages"
                                   @click="setPage(totalPages)">... {{totalPages}}</a>
                            </li>
                            <li v-else>
                                <a :class="[{active: currentPage === totalPages}, 'page-link']" href="#"
                                   v-bind:key="totalPages"
                                   @click="setPage(totalPages)">{{totalPages}}</a>
                            </li>
                        </div>

                        <!-- next -->
                        <li class="page-item">
                            <a :class="['page-link']" href="#" v-bind:key="1"
                               @click="setPage(currentPage+1)" v-if="currentPage < totalPages">Вперед</a>
                            <div :class="[ 'page-link']" href="#" v-bind:key="1"
                                 v-else>Вперед
                            </div>
                        </li>


                    </ul>

                    <ul class="pagination" v-else-if="itemsPerPage < resultCount && totalPages <= 4">
                        <!-- prev -->

                        <li class="page-item">
                            <a :class="['page-link']" href="#" v-bind:key="1"
                               @click="setPage(currentPage-1)" v-if="currentPage > 1">Назад</a>
                            <div :class="['page-link']" href="#" v-bind:key="1"
                                 v-else>Назад
                            </div>
                        </li>
                        <!-- all -->
                        <li class="page-item"
                            v-for="pageNumber in totalPages">
                            <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#"
                               v-bind:key="pageNumber"
                               @click="setPage(pageNumber)"
                            >{{pageNumber}}</a>
                        </li>
                        <!-- next -->
                        <li class="page-item">
                            <a :class="[ 'page-link']" href="#" v-bind:key="1"
                               @click="setPage(currentPage+1)" v-if="currentPage < totalPages">Вперед</a>
                            <div :class="[ 'page-link']" href="#" v-bind:key="1"
                                 v-else>Вперед
                            </div>
                        </li>
                    </ul>


                    <!-- /pagination -->
                </div>
            </div>
        </div>
        <v-dialog v-model="condShow" max-width="500px">
            <v-card>
                <v-card-text>
                    <v-layout wrap>
                        <div class="col-md-12">
                            <span
                                v-show="errorsCondAdd"
                                class="error"
                            >
                                Помилка
                            </span>
                            <v-select
                                    v-model="condition"
                                    :items="cond"
                                    label="Тип"
                                    item-text="name_ua"
                                    item-value="name"
                                    required
                                    :error-messages="conditionErrors"
                                    @change="$v.condition.$touch()"

                                    @blur="$v.condition.$touch()"

                            ></v-select>
                            <v-text-field
                                    label="За місяць"
                                    v-model="amount"
                                    :error-messages="amountErrors"
                                    @input="$v.amount.$touch()"
                                    @blur="$v.amount.$touch()"
                                    required
                                    >
                                <!--v-model="name"
                                -->
                            </v-text-field>
                            <v-text-field
                                    label="За рік"
                                    v-model="amount_year"
                                    :error-messages="amountYearErrors"
                                    @input="$v.amount_year.$touch()"

                                    @blur="$v.amount_year.$touch()"
                                    required
                                    >
                            </v-text-field>
                        </div>
                    </v-layout>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
                    <v-btn color="blue darken-1" flat @click.native="saveCond">Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog v-model="condShowEdit" max-width="500px">
            <v-card>
                <v-card-text>
                    <v-layout wrap>
                        <div class="col-md-12">
                            <span
                                    v-show="errorsCondShow"
                                    class="error"
                            >
                                Помилка
                            </span>
                            <v-select
                                    v-model="condActive.condition"
                                    :items="cond"
                                    label="Тип"
                                    item-text="name_ua"
                                    item-value="name"
                                    required
                                    :error-messages="conditionErrors"
                                    @change="$v.condition.$touch()"

                                    @blur="$v.condition.$touch()"

                            ></v-select>
                            <v-text-field
                                    label="За місяць"
                                    v-model="condActive.amount"
                                    :error-messages="amountErrors"
                                    @input="$v.amount.$touch()"
                                    @blur="$v.amount.$touch()"
                                    required
                            >
                                <!--v-model="name"
                                -->
                            </v-text-field>
                            <v-text-field
                                    label="За рік"
                                    v-model="condActive.amount_year"
                                    :error-messages="amountYearErrors"
                                    @input="$v.amount_year.$touch()"

                                    @blur="$v.amount_year.$touch()"
                                    required
                            >
                            </v-text-field>
                        </div>
                    </v-layout>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
                    <v-btn color="blue darken-1" flat @click.native="saveCond">Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog v-model="showEdit" width="500">

            <v-card>
                <v-card-title class="headline grey lighten-2" primary-title>
                </v-card-title>

                <v-card-text>

                    <form>
                        <v-text-field
                                v-model="edit.last_name"
                                :error-messages="lastNameErrors"
                                label="Прізвище"
                                required

                                @input="$v.last_name.$touch()"
                                @blur="$v.last_name.$touch()"
                        ></v-text-field>
                        <v-text-field
                                v-model="edit.name"
                                :error-messages="nameErrors"
                                label="Ім'я"
                                required
                                @input="$v.name.$touch()"
                                @blur="$v.name.$touch()"
                        ></v-text-field>
                        <v-text-field
                                v-model="edit.second_name"
                                :error-messages="secondNameErrors"
                                label="По батькові"
                                required
                                @input="$v.second_name.$touch()"
                                @blur="$v.second_name.$touch()"
                        ></v-text-field>
                        <v-text-field
                                v-model="edit.phone"
                                :error-messages="phoneErrors"
                                label="Номер телефону"
                                required
                                @input="$v.phone.$touch()"
                                @blur="$v.phone.$touch()"
                        ></v-text-field>
                        <v-text-field
                                v-model="edit.site"
                                :error-messages="siteErrors"
                                label="Домен"
                                required
                                @input="$v.site.$touch()"
                                @blur="$v.site.$touch()"
                        ></v-text-field>
                        <!--<v-select
                                v-model="select"
                                :items="roles"
                                item-text="name"
                                item-value="name"
                                :error-messages="selectErrors"
                                label="Item"
                                required
                                @change="$v.select.$touch()"
                                @blur="$v.select.$touch()"
                        ></v-select>-->

                        <v-btn @click="update()">Відправити</v-btn>
                        <!--<v-btn @click="">Очистити</v-btn>-->
                    </form>

                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" flat @click="showEdit = false">
                        Закрити
                    </v-btn>
                </v-card-actions>


            </v-card>
        </v-dialog>
        <div id="modal-sale" v-if="showSale">

            <div class="x-block" @click="showSale = false">X</div>

            <hosting-sale :hosting="hostingSale" :conds="conds"></hosting-sale>

        </div>
    </div>
</template>

<script>
    import {Events} from '../../../vue'
    import HostingAdd from './add'
    import HostingSale from './sale'
    import { validationMixin } from 'vuelidate'
    import { required, numeric } from 'vuelidate/lib/validators'


    export default {
        mixins: [validationMixin],

        validations: {
            condition: { required},
            amount: { required, numeric},
            amount_year: { required, numeric},
            name: { required },
            last_name: { required },
            second_name: { required },
            phone: { required, numeric },
            site: { required },

        },
        data() {
            return {
                edit: {},
                title: "Hostings",
                currentPage: 1,
                itemsPerPage: 20,
                resultCount: 0,
                lists: this.$props.listsAll,
                condShow: false,
                numberCond: 1,
                cond: this.$props.conds.valueOf(),
                condIdActive: '',
                condNumberActive: '',
                condition: this.$props.conds[0]? this.$props.conds[0].name : '',
                amount: 0,
                amount_year: 0,
                errorsCondAdd: '',
                errorsCondShow: '',
                condShowEdit: '',
                condActive: {},
                showEdit: false,
                errors: {},
                showSale: false,
                hostingSale: {},

            }
        },
        components: {
            HostingAdd,
            HostingSale,
        },
        created() {
            let uplists = this.updateLists
            Events.$on('getListNewAcc', function (data) {
                uplists(data)
            });
        },
        computed: {
            totalPages: function () {
                return Math.ceil(this.resultCount / this.itemsPerPage)
            },
            paginate: function () {
                if (!this.lists || this.lists.length != this.lists.length) {
                    return
                }
                this.resultCount = this.lists.length
                if (this.currentPage >= this.totalPages) {
                    this.currentPage = this.totalPages
                }
                let index = this.currentPage * this.itemsPerPage - this.itemsPerPage
                return this.lists.slice(index, index + this.itemsPerPage)
            },
            amountErrors: function () {
                const errors = [];
                if (!this.$v.amount.$dirty) return errors;
                !this.$v.amount.numeric && errors.push('Має бути число.');
                !this.$v.amount.required && errors.push("Сума за місяць - обов'язково.");
                return errors;
            },
            amountYearErrors: function () {
                const errors = [];
                if (!this.$v.amount_year.$dirty) return errors;
                !this.$v.amount_year.numeric && errors.push('Має бути число.');
                !this.$v.amount_year.required && errors.push("Сума за рік - обов'язково.");
                return errors;
            },
            conditionErrors: function () {
                const errors = [];
                if (!this.$v.condition.$dirty) return errors;
                !this.$v.condition.required && errors.push("Тип - обов'язково.");
                return errors;
            },
            lastNameErrors () {
                const errors = [];
                console.log(this.$v)
                if (!this.$v.last_name.$dirty) return errors;
                // !this.$v.last_name.required && errors.push("Прізвище - обов'язково.");
                this.errors.last_name && errors.push(this.errors.last_name[0])

                return errors;
            },
            secondNameErrors () {
                const errors = [];
                if (!this.$v.second_name.$dirty) return errors;
                // !this.$v.second_name.required && errors.push("По батькові - обов'язково.");
                this.errors.second_name && errors.push(this.errors.second_name[0])
                return errors;
            },
            nameErrors () {
                const errors = [];
                if (!this.$v.name.$dirty) return errors;
                // !this.$v.name.required && errors.push("Ім'я - обов'язково.");
                this.errors.name && errors.push(this.errors.name[0])
                return errors;
            },
            phoneErrors () {
                const errors = [];
                if (!this.$v.phone.$dirty) return errors;
                // !this.$v.phone.numeric && errors.push('Мають бути цифри або спецзнаки.');
                // !this.$v.phone.required && errors.push("Телефон - обов'язково.");
                this.errors.phone && errors.push(this.errors.phone[0])

                return errors;
            },
            siteErrors () {
                const errors = [];
                if (!this.$v.site.$dirty) return errors;
                // !this.$v.site.required && errors.push("Домен - обов'язково.");
                this.errors.site && errors.push(this.errors.site[0])
                return errors;
            }

        },
        props: ['listsAll', 'conds'],

        methods: {
            update() {
                this.$http.post('/admin/hostings/account/'+this.edit.id+'/update/', this.edit)
                    .then(res => {
                        this.showEdit = false
                        this.edit = {}
                    },
                        err => {
                            this.errors = err.data.errors

                        }
                    )
            },
            showSalePopup(item){

                this.showSale = true;
                this.hostingSale = item
                console.log(item)
                console.log(this.showSale)

            },

            updateLists(data) {
                this.lists.unshift(data.valueOf())
            },
            setPage(pageNumber) {
                this.currentPage = pageNumber
            },
            editShortDate(date) {
                if (date) {
                    let dateT = date.split(' ')['0']
                    let dateTemp = dateT.split('-')
                    date = dateTemp['2'] + '.' + dateTemp['1'] + '.' + dateTemp['0']
                    return date
                }
                else {
                    return date
                }
            },
            showEditPopup(item){
                this.edit = item
                this.showEdit = true
            },
            addCond(id, number) {
                this.condShow = true
                this.condIdActive = id
                this.condNumberActive = number
            },
            close() {
                this.condShow = false
                this.condShowEdit = false
                this.condActive = {}

            },
            showEditCond(condition){
                this.condShowEdit = true
                this.condActive = condition

            },
            removeCond(item, name, number, index){
                if(confirm("Видалити послугу "+name+"?")){
                    this.$http.post('/admin/hostings/account/'+item.hosting_id +'/remove-condition/'+item.id)
                        .then(res => {
                            this.lists[index].conditions.splice(number, 1);
                        })
                }
            },
            saveCond(){
                if(!this.amountErrors['0'] && !this.amountYearErrors['0'] && !this.conditionErrors['0']){
                    let data = {}
                    data.condition = this.condition
                    data.amount = this.amount
                    data.amount_year = this.amount_year
                    data.hosting_id = this.condIdActive
                    this.$http.post('/admin/hostings/account/'+this.condIdActive +'/add-condition', data)
                        .then(res => {
                            this.lists[this.condNumberActive].conditions.push(res.data.data);
                            this.condShow = false

                        })

                }
                else {
                    this.errorsCondAdd = true
                }

            },
            amountAll(conditions){
                let sum = 0;
                if(conditions){
                    for(let i = 0 ; i < conditions.length; i++){
                        sum += parseInt(conditions[i].amount)
                    }
                }

                return sum
            },
            amountAllYear(conditions){
                let sum = 0;
                if(conditions){
                    for(let i = 0 ; i < conditions.length; i++){
                        sum += parseInt(conditions[i].amount_year)
                    }
                }

                return sum

            },






        },

    };
</script>
<style>
    .v-messages__message {
        color: red;
    }
    .error{
        color: red;
    }
</style>