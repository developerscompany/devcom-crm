<template>
    <div class="hosting-add">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <label class="label-column">Дата оплати <b>*</b></label>

                    <datepicker  input-class="form-control" :value="data.created_at"  @selected="selectCreated"></datepicker>


                </div>
                <div class="col-lg-4 col-md-12">

                    <label class="label-column">Послуга <b>*</b></label>
                    <span class="error" v-if="errors.condition">{{errors.condition[0]}}</span>
                    <select class="form-control" @change="change" v-model="condition">
                        <option v-for="condition in hosting.conditions" :value="condition" selected>
                            <div v-if=" condition.condition == 'hosting'">Хостинг</div>
                            <div v-else-if="condition.condition == 'cert'">Сертифікат</div>
                            <div v-else-if="condition.condition == 'support'">Пдтримка</div>
                            <div v-else-if="condition.condition == 'domain'">Домен</div>
                        </option>
                    </select>

                    <label class="label-column">Тип <b>*</b></label>
                    <span class="error" v-if="errors.type">{{errors.type[0]}}</span>

                    <select class="form-control"  @change="change" v-model="data.type">
                        <option value="m">За місяць</option>
                        <option value="y">За рік</option>
                    </select>
                    <input type="number" class="form-control" @change="change" @keyup="change"  v-model="number" placeholder="Кількість">

                    <label class="label-column">Сума <b>*</b></label>
                    <span class="error" v-if="errors.amount">{{errors.amount[0]}}</span>

                    <input type="number"  class="form-control" v-model="data.amount">

                    <button class="btn-create" @click="test">Оплатити</button>

                </div>
                <div class="col-lg-4 col-md-12">

                    <label class="label-column">Дійсно до <b>*</b></label>

                    <datepicker  input-class="form-control" :value="really_to"  @selected="selectReally"></datepicker>

                </div>
                
            </div>
        </div>


    </div>
</template>

<script>
    import Datepicker from "vuejs-datepicker"
    export default {

        data() {
            return {
                title: "Hostings",
                number: 0,
                condition: '',
                really_to: '',
                data: {
                    condition: "",
                    amount: "",
                    really_to: "",
                    type: "m",
                    created_at: "",
                },
                errors: {},
                condError: false,
            }
        },

        components: {
            Datepicker,
        },

        updated(){
            if(this.data.type){
                if(this.data.type == 'm'){

                    this.data.amount = this.number * this.condition.amount
                }

                if(this.data.type == 'y'){

                    this.data.amount = this.number * this.condition.amount_year
                }
            }




        },
        created() {
            if(this.data.type == 'm'){
                let really2 = new Date(Date.now())
                this.really_to = really2.getFullYear() + '-' + (really2.getMonth() + this.number + 1) + '-' + really2.getDate();
                // this.data.really_to = new Date(really.getFullYear(), (really.getMonth() + this.number) , really.getDate());
                // console.log(new Date(really.getFullYear(), (really.getMonth() + this.number) , really.getDate()));
            }

            if(this.data.type == 'y'){

                let really2 = new Date(Date.now())
                this.really_to = (really2.getFullYear() + parseInt(this.number)) + '-' + (really2.getMonth() + parseInt(1)) + '-' + really2.getDate();

            }
            let really0 = new Date(Date.now())
            this.data.created_at = really0.getFullYear() + '-' + (really0.getMonth() + 1) + '-' + really0.getDate()


        },
        props: ['hosting'],

        methods: {

            selectReally(date){
                if(date){
                    this.data.really_to = date.getFullYear()+'-'+(date.getMonth()+ parseInt(1))+'-'+date.getDate()
                    this.really_to = date.getFullYear()+'-'+(date.getMonth() + parseInt(1))+'-'+date.getDate()

                }
            },

            selectCreated(date){
                if(date){
                    this.data.created_at = date.getFullYear()+'-'+(date.getMonth()+ parseInt(1))+'-'+date.getDate()

                }
            },

            change(){
                if(this.condition){
                    if(this.condition.finance){
                        if(this.data.type == 'm'){
                            let really = new Date(this.condition.finance.really_to)

                            if(parseInt(really.getMonth(),10)+parseInt(this.number,10) <= 11){
                                this.really_to = really.getFullYear() + '-' + (parseInt(really.getMonth(), 10) + parseInt(this.number,10) + parseInt(1, 10)) + '-' + really.getDate();
                            }
                            else{
                                let year = (parseInt(really.getMonth(),10)+parseInt(this.number,10))/12;
                                year = parseInt(year, 10)
                                let month = (parseInt(really.getMonth(),10)+parseInt(this.number,10))%12;
                                month = parseInt(month, 10)
                                this.really_to = (parseInt(really.getFullYear(),10) + year) + '-' + (parseInt(month,10) + parseInt(1, 10)) + '-' + really.getDate();

                            }
                            // this.data.really_to = new Date(really.getFullYear(), (really.getMonth() + this.number) , really.getDate());
                            // console.log(new Date(really.getFullYear(), (really.getMonth() + this.number) , really.getDate()));
                        }

                        if(this.data.type == 'y'){

                            let really = new Date(this.condition.finance.really_to)
                            this.really_to = (really.getFullYear() + parseInt(this.number)) + '-' + (really.getMonth() + parseInt(1)) + '-' + really.getDate();

                        }


                    }
                    else {

                        if(this.data.type == 'm'){
                            let really1 =  new Date(Date.now())
                            if(parseInt(really1.getMonth(),10)+parseInt(this.number,10) <= 11){
                                this.really_to = really1.getFullYear() + '-' + (parseInt(really1.getMonth(), 10) + parseInt(this.number,10) + parseInt(1, 10)) + '-' + really1.getDate();
                            }
                            else{
                                let year = (parseInt(really1.getMonth(),10)+parseInt(this.number,10))/12;
                                year = parseInt(year, 10)
                                let month = (parseInt(really1.getMonth(),10)+parseInt(this.number,10))%12;
                                month = parseInt(month, 10)
                                this.really_to = (parseInt(really1.getFullYear(),10) + year) + '-' + (parseInt(month,10) + parseInt(1, 10)) + '-' + really1.getDate();

                            }
                            // console.log(parseInt(really1.getMonth(), 10) + parseInt(this.number,10) + parseInt(1, 10))

                            // this.data.really_to = new Date(really.getFullYear(), (really.getMonth() + this.number) , really.getDate());
                            // console.log(new Date(really.getFullYear(), (really.getMonth() + this.number) , really.getDate()));
                        }

                        if(this.data.type == 'y'){

                            let really1 =  new Date(Date.now())
                            this.really_to = (really1.getFullYear() + parseInt(this.number)) + '-' + (really1.getMonth() + parseInt(1)) + '-' + really1.getDate();

                        }


                    }
                }
                else {
                    if(this.data.type == 'm'){
                        let really3 = new Date(Date.now())
                        if(parseInt(really3.getMonth(),10)+parseInt(this.number,10) <= 11){
                            this.really_to = really3.getFullYear() + '-' + (parseInt(really3.getMonth(), 10) + parseInt(this.number,10) + parseInt(1, 10)) + '-' + really3.getDate();
                        }
                        else{
                            let year = (parseInt(really3.getMonth(),10)+parseInt(this.number,10))/12;
                            year = parseInt(year, 10)
                            let month = (parseInt(really3.getMonth(),10)+parseInt(this.number,10))%12;
                            month = parseInt(month, 10)
                            this.really_to = (parseInt(really3.getFullYear(),10) + year) + '-' + (parseInt(month,10) + parseInt(1, 10)) + '-' + really3.getDate();

                        }
                    }

                    if(this.data.type == 'y'){

                        let really3 = new Date(Date.now())
                        this.really_to = (really3.getFullYear() + parseInt(this.number)) + '-' + (really3.getMonth() + parseInt(1)) + '-' + really3.getDate();

                    }


                }


            },

            test(){
                if(!this.data.condition){
                    this.data.condition = this.condition.condition
                }
                if(!this.data.really_to && this.really_to){
                    this.data.really_to = this.really_to
                }
                console.log(this.data)
                this.$http.post('/admin/hostings/account/' + this.hosting.id + '/sale', this.data).then(res => {
                    if (res.status === 201) {
                        // console.log(res.data)
                        location.href = '/admin/hostings/account/' + this.hosting.id
                    }
                    else {

                    }
                }, err => {
                    console.log(err.data)
                    this.errors = err.data.errors
                })
            }


        }

    };
</script>

<style>
    .error{
        color: red;
    }
</style>