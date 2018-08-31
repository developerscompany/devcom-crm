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
            <div class="row" style="width: 100%; margin-right: 0; margin-left: 0;">
                <div class="col-md-3 " v-for="server in servers">
                    <div class="label-server">
                        <div class="server-name">{{server.name}}</div>
                        <div class="server-amount">{{server.amount_month}} / {{server.amount_year}}</div>
                        <button class="btn btn-edit" @click="editForm(server)">Змінити</button>
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
            }
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