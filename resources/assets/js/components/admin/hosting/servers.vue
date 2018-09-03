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
                    <button class="btn btn-new" @click="returnAdd">Новий</button>

                </div>
                <br>

            </div>
            <div class="row" style="width: 100%; margin-right: 0; margin-left: 0; margin-bottom: 20px">
                <div class="col-md-3 " v-for="server in servers">
                    <div class="label-server">
                        <div class="server-name">{{server.name}}</div>
                        <div class="server-amount">{{server.amount_month}} / {{server.amount_year}}</div>
                        <button class="btn btn-edit" @click="editForm(server)" ><img src="/icons/012-pencil.svg" alt="" id="edit-server"></button>
                        <button class="btn btn-del" @click="delServer(server)" ><img src="/icons/112-garbage.svg" alt="" id="del-server"></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="block-name">Статистика виплат</div>
            <!--<div class="row grafic">
                <div class="col-md-1 col-xs-1"></div>
                <div class="col-md-11 col-xs-11">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 grafic-block"  v-for="month in monthsList">
                            <div class="month">{{month.name}}</div>
                        </div>
                    </div>
                </div>
            </div>-->

            <div class="row">

                <canvas ref="chart"></canvas>


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
            // let data = this.retData(this.amounts)
            let chart = this.$refs.chart;
            let ctx = chart.getContext("2d");
            let gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
            gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
            gradientFill.addColorStop(1, "rgba(24, 206, 15, 0.4)");

            let myChart = new Chart(ctx, {
                type: 'line',
                responsive: true,
                data: {
                    labels: ["12pm,", "3pm", "6pm", "9pm", "12am", "3am", "6am", "9am"],
                    datasets: [{
                        label: "Email Stats",
                        borderColor: "#18ce0f",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#18ce0f",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        fill: true,
                        backgroundColor: gradientFill,
                        borderWidth: 2,
                        data: [40, 500, 650, 700, 1200, 1250, 1300, 1900]
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        bodySpacing: 4,
                        mode:"nearest",
                        intersect: 0,
                        position:"nearest",
                        xPadding:10,
                        yPadding:10,
                        caretPadding:10
                    },
                    responsive: true,
                    scales: {
                        yAxes: [{
                            gridLines:0,
                            gridLines: {
                                zeroLineColor: "transparent",
                                drawBorder: false
                            }
                        }],
                        xAxes: [{
                            display:0,
                            gridLines:0,
                            ticks: {
                                display: false
                            },
                            gridLines: {
                                zeroLineColor: "transparent",
                                drawTicks: false,
                                display: false,
                                drawBorder: false
                            }
                        }]
                    },
                    layout:{
                        padding:{left:0,right:0,top:15,bottom:15}
                    }
                }
            });

        },
        props: ['servers', 'pays', 'paids', 'amounts'],
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

            delServer(server){
                if(confirm("Видалити сервер "+ server.name +" ?")){

                    this.$http.post('/admin/hostings/server/del/'+ server.id).then(res => {
                        location.href = '/admin/hostings/servers'
                    }, err => {
                    })
                }
            },

            retData(finances){
                this.amounts.forEach(
                    function (finance) {
                        console.log(finance)

                    }
                )
            },












        }

    };
</script>

<style>
    .error{
        color: red;
    }
</style>