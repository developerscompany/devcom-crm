<template>
    <div class="calendar">
        <div class="container-fluid">
            <div id="message" v-if="message" >
                <a  v-if="message.url" :href="message.url"> {{message.title}}</a>
                <div v-else> {{message.title}}</div>
            </div>
            <calendar-view
                    :events="events"
                    :show-date="showDate"
                    @click-event="onClickEvent"
                    class="theme-default holiday-us-traditional holiday-us-official">
                <calendar-view-header
                        slot="header"
                        slot-scope="t"
                        :header-props="t.headerProps"
                        @input="setShowDate" />
            </calendar-view>

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
</style>