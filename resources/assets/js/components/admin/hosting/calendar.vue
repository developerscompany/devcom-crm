<template>
    <div class="calendar">
        <div class="container-fluid">
            <div id="message" v-if="message" :class="{ create : message.classes == 'create'}">
                <a  v-if="message.url" :href="message.url"> {{message.title}}</a>
                <div v-else> {{message.title}}</div>
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
                <div class="col-md-2"><a :href="'/admin/hostings/account/'+ finance.hosting.id">{{finance.hosting.last_name + "  " + finance.hosting.name}}</a></div>
                <div class="col-md-2">{{finance.hosting.site}}</div>
                <div class="col-md-2">{{condition[finance.condition]}}</div>
                <div class="col-md-1">{{finance.amount}}</div>
                <div class="col-md-2">{{editShortDate(finance.really_to)}}</div>
                <div class="col-md-2">{{editShortDate(finance.created_at)}}</div>
                <div class="col-md-1">{{finance.type == 'm' ? 'Місяць' : 'Рік'}}</div>

            </div>

        </div>

    </div>





</template>

<script>
    import { CalendarView, CalendarViewHeader } from "vue-simple-calendar"

    require("vue-simple-calendar/static/css/default.css")
    require("vue-simple-calendar/static/css/holidays-us.css")

    export default {
        data: () => ({

            showDate: new Date(),
            events: [],
            message: {
                title: "",
                url: "",
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
        },
        props: ['finances'],
        mounted: function(){
            let events = []
            let condition =this.condition
            this.finances.forEach(
                function (finance) {
                    let event = {
                        id: finance.id,
                        startDate: finance.really_to,
                        title: "Оплата  за " +condition[finance.condition]+ " - "+finance.hosting.last_name + " " + finance.hosting.name + " " + finance.hosting.second_name,
                        url: "/admin/hostings/account/"+ finance.hosting.id,
                    }
                    events.push(event)
                    event = {
                        id: finance.id,
                        startDate: finance.created_at,
                        title: "Оплата  за " +condition[finance.condition]+ " - "+finance.hosting.last_name + " " + finance.hosting.name + " " + finance.hosting.second_name,
                        url: "/admin/hostings/account/"+ finance.hosting.id,
                        classes: "create",
                    }
                    events.push(event)

                }
            );

            this.events = events
        },

        methods: {
            setShowDate(d) {
                this.showDate = d;
            },
            onClickEvent(e) {
                this.message.title = `${e.title}`
                this.message.url = `${e.originalEvent.url}`
                this.message.classes = `${e.originalEvent.classes}`
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