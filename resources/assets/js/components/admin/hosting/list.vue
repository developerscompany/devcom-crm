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
                        <div :class="[{active: itemsPerPage === 10}, 'number-column']" @click="itemsPerPage = 10">10</div>
                        <div :class="[{active: itemsPerPage === 20}, 'number-column']" @click="itemsPerPage = 20">20</div>
                        <div :class="[{active: itemsPerPage === 50}, 'number-column']" @click="itemsPerPage = 50">50</div>
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
                                 v-else>Назад</div>
                        </li>
                        <!--first page-->
                        <div class="page-item">
                            <li v-if="currentPage !== 1 && currentPage !== 2 && currentPage !== 3">
                                <a :class="[{active: currentPage === 1}, 'page-link']" href="#" v-bind:key="1"
                                   @click="setPage(1)">1  ...</a>
                            </li>
                            <li  v-else>
                                <a :class="[{active: currentPage === 1}, 'page-link']" href="#" v-bind:key="1"
                                   @click="setPage(1)">1 </a>
                            </li>
                        </div>
                        <!-- other pages -->
                        <div v-if="currentPage == 1 || currentPage == 2 " class="pagination">
                            <li class="page-item"
                                v-for="pageNumber in totalPages">
                                <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#" v-bind:key="pageNumber"
                                   v-if="pageNumber == 2 || pageNumber == 3" @click="setPage(pageNumber)"
                                >{{pageNumber}}</a>
                            </li>
                        </div>

                        <div v-else-if="currentPage == (totalPages-1) || currentPage == totalPages" class="pagination">
                            <li class="page-item"
                                v-for="pageNumber in totalPages">
                                <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#" v-bind:key="pageNumber"
                                   v-if="pageNumber == (totalPages-1) || pageNumber == (totalPages-2)"
                                   @click="setPage(pageNumber)"
                                >{{pageNumber}}</a>
                            </li>
                        </div>
                        <div v-else class="pagination">
                            <li class="page-item"
                                v-for="pageNumber in totalPages">
                                <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#" v-bind:key="pageNumber"
                                   v-if="pageNumber == currentPage || pageNumber == (currentPage-1) || pageNumber == (currentPage+1)"
                                   @click="setPage(pageNumber)"
                                >{{pageNumber}}</a>
                            </li>
                        </div>

                        <!-- last page-->

                        <div class="page-item">
                            <li  v-if="currentPage !== totalPages-1 && currentPage !== totalPages && currentPage !== (totalPages-2)">

                                <a :class="[{active: currentPage === totalPages}, 'page-link']" href="#" v-bind:key="totalPages"
                                   @click="setPage(totalPages)">...  {{totalPages}}</a>
                            </li>
                            <li  v-else>
                                <a :class="[{active: currentPage === totalPages}, 'page-link']" href="#" v-bind:key="totalPages"
                                   @click="setPage(totalPages)">{{totalPages}}</a>
                            </li>
                        </div>

                        <!-- next -->
                        <li class="page-item">
                            <a :class="[{active: currentPage !== totalPages}, 'page-link']" href="#" v-bind:key="1"
                               @click="setPage(currentPage+1)" v-if="currentPage < totalPages">Вперед</a>
                            <div :class="[{active: currentPage !== totalPages}, 'page-link']" href="#" v-bind:key="1"
                                 v-else>Вперед</div>
                        </li>


                    </ul>

                    <ul class="pagination" v-else-if="itemsPerPage < resultCount && totalPages <= 4">
                        <!-- prev -->

                        <li class="page-item">
                            <a :class="[{active: currentPage !== 1}, 'page-link']" href="#" v-bind:key="1"
                               @click="setPage(currentPage-1)" v-if="currentPage > 1">Назад</a>
                            <div :class="[{active: currentPage !== 1}, 'page-link']" href="#" v-bind:key="1"
                                 v-else>Назад</div>
                        </li>
                        <!-- all -->
                        <li class="page-item"
                            v-for="pageNumber in totalPages">
                            <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#" v-bind:key="pageNumber"
                               @click="setPage(pageNumber)"
                            >{{pageNumber}}</a>
                        </li>
                        <!-- next -->
                        <li class="page-item">
                            <a :class="[{active: currentPage !== totalPages}, 'page-link']" href="#" v-bind:key="1"
                               @click="setPage(currentPage+1)" v-if="currentPage < totalPages">Вперед</a>
                            <div :class="[{active: currentPage !== totalPages}, 'page-link']" href="#" v-bind:key="1"
                                 v-else>Вперед</div>
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
            <div :class="[{greyLine: index % 2 == 0 } ,'row' ,'table-content']" v-for="(list, index) in paginate">
                <div class="col-md-2 col-sm-12 list-column"><a :href="'hostings/account/'+ list.id">{{list.last_name}} {{list.name}} {{list.second_name}}</a></div>
                <div class="col-md-2 col-sm-12 list-column">{{list.site}}</div>
                <div class="col-md-2 col-sm-12 list-column">{{list.phone}}</div>
                <div class="col-md-2 col-sm-12 mark-all"><div v-for="condition in list.conditions" >
                    <div v-if="condition.condition == 'hosting'" class="mark-primary">Хостинг</div>
                    <div v-else-if="condition.condition == 'cert'" class="mark-orange">Сертифікат</div>
                    <div v-else-if="condition.condition == 'support'" class="mark-red">Підтримка</div>
                    <div v-else-if="condition.condition == 'domain'" class="mark-green">Домен</div>
                    <div v-else></div>
                </div>
                </div>
                <div class="col-md-2 col-sm-12 list-column" >{{list.amount_all}}/{{list.amount_all_year}}</div>
                <div class="col-md-2 col-sm-12 list-column" v-if="list.latest_finance">{{editShortDate(list.latest_finance.really_to)}}</div>
            </div>
            <div class="row">
                <!-- number item on page -->
                <div class="col-md-8 showing-elements">
                    <div class="showing-text">
                        Показати:
                    </div>
                    <div class="showing-number">
                        <div :class="[{active: itemsPerPage === 5}, 'number-column']" @click="itemsPerPage = 5">5</div>
                        <div :class="[{active: itemsPerPage === 10}, 'number-column']" @click="itemsPerPage = 10">10</div>
                        <div :class="[{active: itemsPerPage === 20}, 'number-column']" @click="itemsPerPage = 20">20</div>
                        <div :class="[{active: itemsPerPage === 50}, 'number-column']" @click="itemsPerPage = 50">50</div>
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
                                v-else>Назад</div>
                        </li>
                        <!--first page-->
                        <div class="page-item">
                            <li v-if="currentPage !== 1 && currentPage !== 2 && currentPage !== 3">
                                <a :class="[{active: currentPage === 1}, 'page-link']" href="#" v-bind:key="1"
                                   @click="setPage(1)">1  ...</a>
                            </li>
                            <li  v-else>
                                <a :class="[{active: currentPage === 1}, 'page-link']" href="#" v-bind:key="1"
                                   @click="setPage(1)">1 </a>
                            </li>
                        </div>
                        <!-- other pages -->
                        <div v-if="currentPage == 1 || currentPage == 2 " class="pagination">
                            <li class="page-item"
                                v-for="pageNumber in totalPages">
                                <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#" v-bind:key="pageNumber"
                                   v-if="pageNumber == 2 || pageNumber == 3" @click="setPage(pageNumber)"
                                >{{pageNumber}}</a>
                            </li>
                        </div>

                        <div v-else-if="currentPage == (totalPages-1) || currentPage == totalPages" class="pagination">
                            <li class="page-item"
                                v-for="pageNumber in totalPages">
                                <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#" v-bind:key="pageNumber"
                                   v-if="pageNumber == (totalPages-1) || pageNumber == (totalPages-2)"
                                   @click="setPage(pageNumber)"
                                >{{pageNumber}}</a>
                            </li>
                        </div>
                        <div v-else class="pagination">
                            <li class="page-item"
                                v-for="pageNumber in totalPages">
                                <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#" v-bind:key="pageNumber"
                                   v-if="pageNumber == currentPage || pageNumber == (currentPage-1) || pageNumber == (currentPage+1)"
                                   @click="setPage(pageNumber)"
                                >{{pageNumber}}</a>
                            </li>
                        </div>

                        <!-- last page-->

                        <div class="page-item">
                            <li  v-if="currentPage !== totalPages-1 && currentPage !== totalPages && currentPage !== (totalPages-2)">

                                 <a :class="[{active: currentPage === totalPages}, 'page-link']" href="#" v-bind:key="totalPages"
                                   @click="setPage(totalPages)">...  {{totalPages}}</a>
                            </li>
                            <li  v-else>
                                <a :class="[{active: currentPage === totalPages}, 'page-link']" href="#" v-bind:key="totalPages"
                                   @click="setPage(totalPages)">{{totalPages}}</a>
                            </li>
                        </div>

                        <!-- next -->
                        <li class="page-item">
                            <a :class="[{active: currentPage !== totalPages}, 'page-link']" href="#" v-bind:key="1"
                               @click="setPage(currentPage+1)" v-if="currentPage < totalPages">Вперед</a>
                            <div :class="[{active: currentPage !== totalPages}, 'page-link']" href="#" v-bind:key="1"
                                 v-else>Вперед</div>
                        </li>


                    </ul>

                    <ul class="pagination" v-else-if="itemsPerPage < resultCount && totalPages <= 4">
                        <!-- prev -->

                        <li class="page-item">
                            <a :class="[{active: currentPage !== 1}, 'page-link']" href="#" v-bind:key="1"
                               @click="setPage(currentPage-1)" v-if="currentPage > 1">Назад</a>
                            <div :class="[{active: currentPage !== 1}, 'page-link']" href="#" v-bind:key="1"
                                 v-else>Назад</div>
                        </li>
                        <!-- all -->
                        <li class="page-item"
                            v-for="pageNumber in totalPages">
                            <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#" v-bind:key="pageNumber"
                               @click="setPage(pageNumber)"
                            >{{pageNumber}}</a>
                        </li>
                        <!-- next -->
                        <li class="page-item">
                            <a :class="[{active: currentPage !== totalPages}, 'page-link']" href="#" v-bind:key="1"
                               @click="setPage(currentPage+1)" v-if="currentPage < totalPages">Вперед</a>
                            <div :class="[{active: currentPage !== totalPages}, 'page-link']" href="#" v-bind:key="1"
                                 v-else>Вперед</div>
                        </li>
                    </ul>


                    <!-- /pagination -->
                </div>
            </div>
        </div>


    </div>
</template>

<script>
    import {Events} from '../../../vue'
    import HostingAdd from './add'
    export default {

        data(){
            return {
                title: "Hostings",
                currentPage: 1,
                itemsPerPage: 20,
                resultCount: 0,
                lists: this.$props.listsAll

            }
        },
        components:{
          HostingAdd,
        },
        created(){
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
            }
        },
        props: ['listsAll'],
        methods: {
            updateLists(data){
                this.lists.unshift(data.valueOf())
                this.$forceUpdate();
            },
            setPage(pageNumber) {
                this.currentPage = pageNumber
            },
            editShortDate(date){
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
        },

    };
</script>