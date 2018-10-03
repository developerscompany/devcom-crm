<template>
    <div class="hosting-card" >

        <div class="container-fluid">
            <div class="row">
                <div id="modal-sale" v-show="showSale">

                    <div class="x-block" @click="showSale = false">X</div>

                    <hosting-sale :hosting="hosting" :conds="conds"></hosting-sale>

                </div>
                <div class=" col-sm-12 col-md-5 col-lg-4 acc-data">

                    <p class="label">Особиста інформація:</p>
                    <p class="pib">{{hosting.last_name}} {{hosting.name}} {{hosting.second_name}}</p>

                    <p class="label">Домен:</p>
                    <p class="phone">{{hosting.site}}</p>

                    <p class="label">Телефон:</p>
                    <p class="phone">{{hosting.phone}}</p>

                    <p class="label">Послуги:</p>
                    <div class="conditions" v-for="condition in hosting.conditions">
                        <div v-for="cond in conds">
                            <div v-if="condition.condition == cond.name" class="condition-item">


                                <div class="container-fluid">
                                    <div class="row">

                                        <div :class="cond.class" class="mark">{{cond.name_ua}}</div>

                                    </div>

                                    <div class="row">
                                        <div class="col-12 finance-item">За місяць - {{condition.amount}}</div>
                                        <br>
                                        <div class="col-12 finance-item">За рік - {{condition.amount_year}}</div>
                                        <br>
                                        <div class="col-12 finance-item" v-if="condition.finance">Дійсно до - {{editShortDate(condition.finance.really_to)}}</div>
                                        <br>
                                        <div class="col-12 finance-item" v-if="condition.finance">Оплачено - {{editShortDate(condition.finance.created_at)}}</div>
                                        <br>

                                    </div>
                                </div>
                            </div>
                        </div>

                    <!--<div v-else-if="condition.condition == 'cert'" class="condition-item">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="mark-orange mark">Сертифікат</div>
                            </div>
                            <div class="row">
                                <div class="col-12 finance-item">За місяць - {{condition.amount}}</div>
                                <br>
                                <div class="col-12 finance-item">За рік - {{condition.amount_year}}</div>
                                <br>
                                <div class="col-12 finance-item" v-if="condition.finance">Дійсно до - {{editShortDate(condition.finance.really_to)}}</div>
                                <br>
                                <div class="col-12 finance-item" v-if="condition.finance">Оплачено - {{editShortDate(condition.finance.created_at)}}</div>
                                <br>

                            </div>
                        </div>
                    </div>
                    <div v-else-if="condition.condition == 'support'" class="condition-item">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="mark-red mark">Підтримка</div>
                            </div>
                            <div class="row">
                                <div class="col-12 finance-item">За місяць - {{condition.amount}}</div>
                                <br>
                                <div class="col-12 finance-item">За рік - {{condition.amount_year}}</div>
                                <br>
                                <div class="col-12 finance-item" v-if="condition.finance">Дійсно до - {{editShortDate(condition.finance.really_to)}}</div>
                                <br>
                                <div class="col-12 finance-item" v-if="condition.finance">Оплачено - {{editShortDate(condition.finance.created_at)}}</div>
                                <br>

                            </div>
                        </div>
                    </div>
                    <div v-else-if="condition.condition == 'domain'" class="condition-item">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="mark-green mark">Домен</div>
                            </div>
                            <div class="row">
                                <div class="col-12 finance-item">За місяць - {{condition.amount}}</div>
                                <br>
                                <div class="col-12 finance-item">За рік - {{condition.amount_year}}</div>
                                <br>
                                <div class="col-12 finance-item" v-if="condition.finance">Дійсно до - {{editShortDate(condition.finance.really_to)}}</div>
                                <br>
                                <div class="col-12 finance-item" v-if="condition.finance">Оплачено - {{editShortDate(condition.finance.created_at)}}</div>
                                <br>

                            </div>
                        </div>
                    </div>
                    <div v-else></div>-->

                    </div>

                    <br>
                    <!--<button class="btn-edit" @click="openEdit">Змінити</button>-->
                    <button class="btn-edit" @click="showSale = !showSale">Оплатити</button>


                </div>

                <div class="col-sm-12 col-md-7 col-lg-8 message-box">
                    <button class="btn-edit" @click="openComments">Коментарі</button>
                    <button class="btn-edit" @click="openArchive">Архів</button>
                    <hosting-archive v-if="toogleBox" :conds="conds" :finances="finances"></hosting-archive>
                    <div v-if="!toogleBox">
                        <div class="message-list" id="block-scroll">
                            <div class="message-item" v-for="comment in hosting.comments">
                                <div class="message-image">
                                </div>
                                <div class="message-content">
                                    <div class="message-time">
                                        {{editDate(comment.created_at)}}
                                    </div>
                                    <div class="message-email">
                                        {{comment.user.email}}
                                    </div>
                                    <div class="message-text">
                                        {{comment.message}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="writing-block">
                            <span class="error" v-if="errors.comment">{{errors.comment[0]}}</span>
                            <textarea name="comment" v-model="data.comment" class="form-control"></textarea>
                            <br>

                            <button class="btn-create" @click="comment">Відправити</button>
                        </div>
                    </div>


                </div>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <div class="finance-content">
                        <div class="finance-list">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import HostingSale from './sale'
    import HostingArchive from './archive'
    export default {

        data() {
            return {
                title: "Hostings",
                data: {
                    comment: "",
                    hosting_id: this.hosting.id,
                },
                errors: {},
                storeStatus: false,
                showSale: false,
                toogleBox: false,
            }
        },
        props: ['hosting', 'conds', 'finances'],
        components: {
            HostingSale,
            HostingArchive,
        },
        mounted() {
            this.scrollToEnd();
        },
        updated() {
            this.scrollToEnd();

        },
        methods: {
            openComments(){
                this.toogleBox = false
            },
            openArchive () {
                this.toogleBox = true

                // return location.href = "/admin/hostings/account/" + this.hosting.id + "/archive";

            },
            comment() {
                this.$http.post('/admin/hostings/account/' + this.hosting.id + '/comment', this.data).then(res => {
                    if (res.status === 201) {
                        // console.log(res.data)
                        location.href = '/admin/hostings/account/' + this.hosting.id
                    }
                    else {

                    }
                }, err => {
                    this.errors = err.data.errors
                })
            },

            editDate(date) {
                if (date) {
                    var dateT = date.split(' ')['0']
                    var timeT = date.split(' ')['1']
                    var dateTemp = dateT.split('-')
                    var timeTemp = timeT.split(':')
                    date = dateTemp['2'] + '.' + dateTemp['1'] + '.' + dateTemp['0'] + ' ' + timeTemp['0'] + ':' + timeTemp['1']

                    return date
                }
                else {
                    return date
                }

            },
            editShortDate(date){
                if (date) {
                    var dateT = date.split(' ')['0']
                    var dateTemp = dateT.split('-')
                    date = dateTemp['2'] + '.' + dateTemp['1'] + '.' + dateTemp['0']
                    return date
                }
                else {
                    return date
                }
            },
            scrollToEnd() {
                if(!this.toogleBox){

                    let block = document.querySelector("#block-scroll");
                    block.scrollTop = block.scrollHeight;
                }
            },
            openEdit() {
                return location.href = "/admin/hostings/account/" + this.hosting.id + "/edit";
            },
            openSale() {

                return location.href = "/admin/hostings/account/" + this.hosting.id + "/sale";

            },


        }

    };
</script>

<style>
    .error {
        color: red;
    }
</style>