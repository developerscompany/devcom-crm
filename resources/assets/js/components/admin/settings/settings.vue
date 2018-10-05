<template>

    <div class="settings-block">

        <div class="container-fluid">
            <h2>Хостинг.Послуги</h2>
            <div class="row table-head-field">
                <div class="col-md-3">Назва(англ)</div>
                <div class="col-md-3">Назва(укр)</div>
                <div class="col-md-3">Класс(class)</div>
                <div class="col-md-3">Події</div>
            </div>
            <div class="row ">
                <div class="col-md-3">
                    <input type="text" class="form-control" v-model="cond.name">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" v-model="cond.name_ua">
                </div>

                <div class="col-md-3">
                    <input type="text" class="form-control" v-model="cond.class">
                </div>

                <div class="col-md-3">

                    <button class="btn btn-edit" @click="saveConditions">Зберегти</button>
                </div>

            </div>
            <div class="row table-content-field" v-for="condition in conditions">
                <div class="col-md-3">{{condition.name}}</div>
                <div class="col-md-3">{{condition.name_ua}}</div>
                <div class="col-md-3">{{condition.class}}</div>
                <div class="col-md-3"></div>


            </div>
        </div>
        <div class="container-fluid">
            <h2>Валюта</h2>
            <div class="row table-head-field">
                <div class="col-md-3">Назва(англ)</div>
                <div class="col-md-3">Назва(укр)</div>
                <div class="col-md-1">Символ</div>
                <div class="col-md-2">Коефіцієнт</div>
                <div class="col-md-3">Події</div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <input type="text" class="form-control" v-model="currencyNew.name">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" v-model="currencyNew.name_ua">
                </div>

                <div class="col-md-1">
                    <input type="text" class="form-control" v-model="currencyNew.symbol">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" v-model="currencyNew.coeff">
                </div>

                <div class="col-md-3">

                    <button class="btn btn-edit" @click="saveCurrency">Зберегти</button>
                </div>

            </div>
            <div class="row table-content-field" v-for="currency in currencies">
                <div class="col-md-3">{{currency.name}}</div>
                <div class="col-md-3">{{currency.name_ua}}</div>
                <div class="col-md-1">{{currency.symbol}}</div>
                <div class="col-md-2">{{currency.coeff}}</div>
                <div class="col-md-3"></div>


            </div>
        </div>
    </div>

</template>

<script>

    export default {

        data(){
            return {

                cond: {},
                currencyNew: {},


            }
        },

        props: ['conditions', 'currencies'],


        mounted() {

        },

        methods: {
            saveConditions() {

                this.$http.post('/admin/settings/add-condition', this.cond).then(res => {
                    location.href = '/admin/settings'
                }, err => {

                    console.log(err.data)
                })


            },
            saveCurrency() {

                this.$http.post('/admin/settings/add-currency', this.currencyNew).then(res => {
                    location.href = '/admin/settings'
                }, err => {

                    console.log(err.data)
                })


            }

        },

        watch: {

        },
    };
</script>

<style>
    .active{
        color: green;
    }


</style>