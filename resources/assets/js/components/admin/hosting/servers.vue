<template>
    <div class="servers-list">
        <div class="container-fluid">
            <div class="block-name">Сервери</div>
            <div class="row" v-if="statusForm" style="width: 100%; margin-right: 0; margin-left: 0;">
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Name" v-model="data.name">
                    <span class="error" v-if="errors.name">{{errors.name[0]}}</span>

                </div>

                <div class="col-md-3">
                    <input type="number" class="form-control" placeholder="Amount month"  v-model="data.amount_month">
                    <span class="error" v-if="errors.amount_month">{{errors.amount_month[0]}}</span>

                </div>

                <div class="col-md-3">
                    <input type="number" class="form-control" placeholder="Amount year" v-model="data.amount_year">
                    <span class="error" v-if="errors.amount_year">{{errors.amount_year[0]}}</span>

                </div>

                <div class="col-md-3" style="text-align: center">
                    <button class="btn btn-add" @click="add">Зберегти</button>
                </div>
                <br>

            </div>
            <div class="row" v-if="!statusForm" style="width: 100%; margin-right: 0; margin-left: 0;">
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Name" v-model="edit.name">
                    <span class="error" v-if="errors.name">{{errors.name[0]}}</span>

                </div>

                <div class="col-md-3">
                    <input type="number" class="form-control" placeholder="Amount month"  v-model="edit.amount_month">
                    <span class="error" v-if="errors.amount_month">{{errors.amount_month[0]}}</span>

                </div>

                <div class="col-md-3">
                    <input type="number" class="form-control" placeholder="Amount year" v-model="edit.amount_year">
                    <span class="error" v-if="errors.amount_year">{{errors.amount_year[0]}}</span>

                </div>

                <div class="col-md-3" style="text-align: center">
                    <button class="btn btn-add" @click="editServer">Зберегти</button>
                    <button class="btn btn-del" @click="returnAdd">Новий</button>

                </div>
                <br>

            </div>
            <div class="row" style="width: 100%; margin-right: 0; margin-left: 0; margin-bottom: 20px">
                <div class="col-md-3 " v-for="server in servers">
                    <div class="label-server">
                        <div class="server-name">{{server.name}}</div>
                        <div class="server-amount">{{server.amount_month}} / {{server.amount_year}}</div>
                        <button class="btn btn-edit" @click="editForm(server)">Змінити</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="block-name">Статистика виплат</div>
            <div class="row grafic">
                <div class="col-md-1 col-xs-1"></div>
                <div class="col-md-11 col-xs-11">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 grafic-block"  v-for="month in monthsList">
                            <div class="month">{{month.name}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        </div>
</template>

<script>
    export default {

        data() {
            return {
                statusForm: true,
                data: {
                    name: '',
                    amount_month: '',
                    amount_year: '',
                },
                edit: {
                    name: '',
                    amount_month: '',
                    amount_year: '',
                    id: '',
                },
                errors: {},

                monthsList: [
                    {
                        name: "Січень",
                        number: 1,
                    },
                    {
                        name: "Лютий",
                        number: 2,
                    },
                    {
                        name: "Березень",
                        number: 3,
                    },
                    {
                        name: "Квітень",
                        number: 4,
                    },
                    {
                        name: "Травень",
                        number: 5,
                    },
                    {
                        name: "Червень",
                        number: 6,
                    },
                    {
                        name: "Липень",
                        number: 7,
                    },
                    {
                        name: "Серпень",
                        number: 8,
                    },
                    {
                        name: "Вересень",
                        number: 9,
                    },
                    {
                        name: "Жовтень",
                        number: 10,
                    },
                    {
                        name: "Листопад",
                        number: 11,
                    },
                    {
                        name: "Грудень",
                        number: 12,
                    },

                ],

            }
        },
        mounted: function(){




        },
        props: ['servers'],
        methods: {
            add(){
                this.$http.post('/admin/hostings/server/add', this.data).then(res => {
                    location.href = '/admin/hostings/servers'
                }, err => {
                    this.errors = err.data.errors
                })
            },

            editForm(server){

                this.edit = server

                this.statusForm = false
            },

            returnAdd(){
                this.statusForm = true

            },

            editServer(){
                this.$http.post('/admin/hostings/server/edit', this.edit).then(res => {
                    location.href = '/admin/hostings/servers'
                }, err => {
                    this.errors = err.data.errors
                })
            },









        }

    };
</script>

<style>
    .error{
        color: red;
    }
</style>