<template>
    <div class="calendar">
        <div class="container-fluid">
            <div class="row">


                <div class="col-md-4"></div>
                <div class="col-md-4">

                    <v-calendar v-model="selectedValue"  :attributes='attrs' @dayclick="getAlert()"
                    >
                    </v-calendar>

                </div>
                <div class="col-md-4"></div>

            </div>



        </div>


    </div>
</template>

<script>

    export default {

        data() {
            return {
                title: "Hostings",
                selectedValue: new Date(),
                condition: {
                    'hosting': "Хостинг",
                    'cert': "Сертифікат",
                    'support': "Підтримку",
                    'domain': "Домен",
                },
                data: {

                },

            }
        },
        props: ['finances'],
        computed: {
            attrs: function () {
                let dates = []
                let cond = this.condition
                this.finances.forEach(
                    function (elem) {
                        let mas = {
                            key: elem.id,
                            dates: new Date(elem.really_to),
                            highlight: {
                                backgroundColor: '#ee2a82',
                            },
                            // Just use a normal style
                            contentStyle: {
                                color: '#fafafa',
                            },
                            // Our new popover here
                            popover: {
                                label: 'Виплата за '+ cond[elem.condition] + " - " + elem.hosting.last_name + ' ' + elem.hosting.name + ' ' + elem.hosting.second_name + "",
                                visibility: 'focus',
                                isInteractive: true
                            }
                        }

                        dates[elem.id] = mas
                    }
                )
                return dates




            }
        },
        components: {
        },
        methods: {

            getAlert(day){
                console.log(this)
            }
        },

    };
    
    $(".c-title-popover").onclick(function () {
        console.log("true")
    });
</script>

<style>
    .error{
        color: red;
    }

    .calendar {
        font-family: 'Avenir', Helvetica, Arial, sans-serif;
        color: #2c3e50;
        height: 67vh;
        width: 90vw;
        margin-left: auto;
        margin-right: auto;
    }
</style>