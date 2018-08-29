<template>
    <div class="hosting-add">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label class="label-column">Прізвище <b>*</b></label>
                    <span class="error" v-if="errors.last_name">{{errors.last_name[0]}}</span>
                    <input type="text" class="form-control" v-model="data.last_name">

                    <label class="label-column">Ім'я <b>*</b></label>
                    <span class="error" v-if="errors.name">{{errors.name[0]}}</span>
                    <input type="text" class="form-control" v-model="data.name">

                    <label class="label-column">По батькові <b>*</b></label>
                    <span class="error" v-if="errors.second_name">{{errors.second_name[0]}}</span>
                    <input type="text" class="form-control" v-model="data.second_name">

                    <label class="label-column">Телефон <b>*</b></label>
                    <span class="error" v-if="errors.phone">{{errors.phone[0]}}</span>
                    <input type="text" class="form-control" v-model="data.phone">

                    <div v-for="(cond, index) in data.conditions" class="conditions-block">
                        <span class="error" v-if="errors.conditions">Не вірно введені дані про Послуги.</span>
                            <label class="label-column">Послуга <b>*</b></label>

                                <select name="" class="form-control" v-model="cond.condition" id="">
                                    <option value="hosting">Хостинг</option>
                                    <option value="cert">Сертифікат</option>
                                    <option value="support">Підтримка</option>
                                    <option value="domain">Домен</option>

                                </select>




                            <label class="label-column">Сумма за місяць</label>

                        <input  type="number" class="form-control" v-model="cond.amount">

                        <label class="label-column">Сумма за рік</label>

                        <input  type="number" class="form-control" v-model="cond.amount_year">

                    </div>
                    <span class="error" v-show="condError == true">Виберіть послугу або видаліть поле! <br></span>

                    <button @click="addCondition()" class="btn-add">+</button>
                    <button @click="remCondition()" class="btn-del"><div>-</div></button>
                    <button @click="edit()" class="btn-create">Змінити</button>

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
                data: {
                    name: '',
                    last_name: '',
                    second_name: '',
                    phone: '',
                    conditions:
                        [
                            {
                                id: '',
                                condition: '',
                                amount: 0,
                                amount_year: 0,
                            },
                        ]
                },
                errors: {},
                condError: false,
            }
        },
        props: ['hosting'],
        mounted () {
          this.data = this.hosting
        },
        methods: {
            addCondition() {
                this.data.conditions.push({
                    condition: '',
                    amount: 0
                })
            },
            remCondition(){
                let number = this.data.conditions.length--;
                this.$delete(this.data.conditions, number);
            },
            edit(){
                let valid = true
                $.each(this.data.conditions, function (key, value) {
                    if(value.condition === ""){
                        valid = false
                    }
                })

                if(valid === true){
                    this.condError = false
                    this.$http.post('/admin/hostings/account/' + this.hosting.id + '/update', this.data).then(res => {
                        if (res.status === 201) {
                            location.href = '/admin/hostings/account/' + this.hosting.id
                        }
                        else {

                        }
                    }, err => {
                        this.errors = err.data.errors
                    })

                }
                else {
                    this.condError = true
                }



            }

        }

    };
</script>

<style>
    .error{
        color: red;
    }
</style>