<template>
    <div class="calendar">
        <div class="container-fluid">
            <div id="modal-sale" v-if="showSale">

                <div class="x-block" @click="showSale = false">X</div>

                <hosting-sale :hosting="message.data.hosting" :conds="conds"></hosting-sale>

            </div>
            <div  v-if="showMes" >

                <div id="message">
                    <div class="container">
                        <h2>Календар.Подія</h2>
                        <div v-if="message.data.hosting">
                            <div class="row">
                                <div class="col-md-6">Особиста інформація</div>
                                <div class="col-md-6">{{message.data.hosting.last_name+" "+ message.data.hosting.name}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">Домен</div>
                                <div class="col-md-6">{{message.data.hosting.site}}</div>
                            </div>
                        </div>

                        <div class="row" v-if="message.data.conds">
                            <div class="col-md-6">Послуга</div>
                            <div class="col-md-6">{{message.data.conds.name_ua}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Оплачено</div>
                            <div class="col-md-6">{{editShortDate(message.data.created_at)}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">До</div>
                            <div class="col-md-6">{{editShortDate(message.data.really_to)}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Сума </div>
                            <div class="col-md-6">{{message.data.amount}} {{message.data.currency.symbol}}</div>
                        </div>
                        <div class="calendar-btn-group">
                            <button class="btn btn-close" @click="openAccount(message.data.hosting_id)">Аккаунт</button>
                            <button class="btn btn-close" @click="showSalePopup">Оплатити</button>
                            <button class="btn btn-close" @click="closeMes">Закрити</button>

                        </div>
                    </div>

                </div>
            </div>
            <calendar-view
                    :events="events"
                    :show-date="showDate"
                    @click-event="onClickEvent"
                    :on-period-change="periodChanged"

                    class="theme-default holiday-us-traditional holiday-us-official">
                <calendar-view-header
                        slot="header"
                        slot-scope="t"
                        :header-props="t.headerProps"
                        @input="setShowDate" />
            </calendar-view>

            <div class="row">
                <div class="col-md-2">Аккаунт</div>
                <div class="col-md-2">Домен</div>
                <div class="col-md-2">Тип</div>
                <div class="col-md-1">Сума</div>
                <div class="col-md-2">Оплачено до</div>
                <div class="col-md-2">Дата оплати</div>
                <div class="col-md-1">Місяць/Рік</div>
            </div>
            <div class="row" v-for="finance in finances" v-if="transformDate(finance.created_at) == month_now">
                <!--v-if="transformDate(finance.created_at) == month_now"-->
                <div class="col-md-2"><a v-if="finance.hosting" :href="'/admin/hostings/account/'+ finance.hosting.id">{{finance.hosting.last_name + "  " + finance.hosting.name}}</a></div>
                <div class="col-md-2">{{finance.hosting.site}}</div>
                <div class="col-md-2">{{finance.conds.name_ua}}</div>
                <div class="col-md-1">{{finance.amount}} {{finance.currency.symbol}}</div>
                <div class="col-md-2">{{editShortDate(finance.really_to)}}</div>
                <div class="col-md-2">{{editShortDate(finance.created_at)}}</div>
                <div class="col-md-1">{{finance.type == 'm' ? 'Місяць' : 'Рік'}}</div>

            </div>

        </div>

    </div>





</template>

<script>
    import { CalendarView, CalendarViewHeader } from "vue-simple-calendar"
    import HostingSale from "./sale"
    require("vue-simple-calendar/static/css/default.css")
    require("vue-simple-calendar/static/css/holidays-us.css")

    export default {
        data: () => ({

            showDate: new Date(),
            showSale: false,
            events: [],
            showMes: false,
            message: {
                title: "",
                url: "",
                data: {},
            },
            month_now: "",
            condition: {
                'hosting': "хостинг",
                'cert': "сертифікат",
                'support': "підтримку",
                'domain': "домен",
            },
        }),

        components: {
            CalendarView,
            CalendarViewHeader,
            HostingSale,
        },
        props: ['finances', 'conds'],
        mounted: function(){
            let events = []
            this.finances.forEach(
                function (finance)  {
                    if(finance.hosting){

                        let event = {
                            id: finance.id,
                            data: finance,
                            startDate: finance.really_to,
                            title: "Час оплати " + finance.hosting.site +" за "+ finance.conds.name_ua+ " - "+finance.hosting.last_name + " " + finance.hosting.name,
                            url: "/admin/hostings/account/"+ finance.hosting.id,
                        }
                        events.push(event)
                        event = {
                            id: finance.id,
                            data: finance,
                            startDate: finance.created_at,
                            title: "Оплачено " + finance.hosting.site +" за "+ finance.conds.name_ua+ " - "+finance.hosting.last_name + " " + finance.hosting.name,
                            url: "/admin/hostings/account/"+ finance.hosting.id,
                            classes: "create",
                        }
                        events.push(event)

                    }

                }
            );

            this.events = events
        },

        methods: {
            openAccount(id){
                location.href = '/admin/hostings/account/'+id
            },
            showSalePopup(){
                this.showMes = false;
                this.showSale = true;
            },
            closeMes(){
                this.showMes = false

            },
            setShowDate(d) {
                this.showDate = d;
            },
            onClickEvent(e) {
                this.showMes = true
                this.message.title = `${e.title}`
                this.message.url = `${e.originalEvent.url}`
                this.message.classes = `${e.originalEvent.classes}`
                this.message.data = e.originalEvent.data


            },
            periodChanged(range) {
                let date = new Date(range.periodStart)

                this.month_now =  date.getMonth()+1
            },

            transformDate(date){
                let transform = new Date(date)
                let month = transform.getMonth()+1
                return month
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

        }

    };
    

</script>

<style>
    .error{
        color: red;
    }

    .calendar {
        font-family: 'Avenir', Helvetica, Arial, sans-serif;
        color: #2c3e50;
        margin-left: auto;
        margin-right: auto;
    }
    .cv-week {
        min-height: 10em;
    }

    .cv-event {
        cursor: pointer;
    }
    .cv-day-number::before{
        content: none !important;
    }
    .cv-day {
        background-color: white;
    }
    .theme-default .cv-day.outsideOfMonth{
        background-color: #b9b9b91a;
    }
    .outsideOfMonth>.cv-day-number{
        color: #8080809c;
    }

    .create{
        background-color: #ffe7d0 !important;
        border-color: #f7e0c7 !important;
    }
</style>