<template>
    <div class="hosting-add">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-4">
                    <select v-model="type" class="form-control">
                        <option :value="cond.name" v-for="cond in conds">{{cond.name_ua}}</option>
                    </select>
                </div>

            </div>

            <br>
            <div class="row">
                <div class="col-md-2">Тип</div>
                <div class="col-md-2">Сума</div>
                <div class="col-md-3">Оплачено до</div>
                <div class="col-md-3">Дата оплати</div>
                <div class="col-md-2">Місяць/Рік</div>
            </div>
            <div class="row" v-for="finance in finances" v-if="finance.condition == type">

                <div class="col-md-2">{{condition[finance.condition]}}</div>
                <div class="col-md-2">{{finance.amount}}</div>
                <div class="col-md-3">{{editShortDate(finance.really_to)}}</div>
                <div class="col-md-3">{{editShortDate(finance.created_at)}}</div>
                <div class="col-md-2">{{finance.type == 'm' ? 'Місяць' : 'Рік'}}</div>

            </div>

        </div>


    </div>
</template>

<script>
    export default {

        data() {
            return {
                title: "Hostings",
                type: 'hosting',
                condition: {
                    'hosting': "Хостинг",
                    'cert': "Сертифікат",
                    'support': "Підтримка",
                    'domain': "Домен",
                },

            }
        },
        props: ['finances', 'conds'],

        methods: {

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

        }

    };
</script>

<style>
    .error{
        color: red;
    }
</style>