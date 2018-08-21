<template>
    <div>

        <h2>{{title}}</h2>

        <table class="hosting-table-column">
            <tr>
                <th>Прізвище</th>
                <td><input type="text" v-model="data.last_name"></td>
                <td class="error" v-if="errors.last_name">{{errors.last_name}}</td>
            </tr>
            <tr>
                <th>Ім'я</th>
                <td><input type="text" v-model="data.name"></td>
                <td class="error" v-if="errors.name">{{errors.name}}</td>

            </tr>
            <tr>
                <th>По батькові</th>
                <td><input type="text" v-model="data.second_name"></td>
                <td class="error" v-if="errors.second_name">{{errors.second_name}}</td>

            </tr>
            <tr>
                <th>Телефон</th>
                <td><input type="text" v-model="data.phone"></td>
                <td class="error" v-if="errors.phone">{{errors.phone}}</td>

            </tr>
            <div v-for="(cond, index) in data.conditions">
                <td class="error" v-if="errors.conditions">Не вірно введені дані про Послуги.</td>
                <tr>
                    <th>Послуга</th>
                    <td>
                        <select name="" v-model="cond.condition" id="">
                            <option value="hosting">Хостинг</option>
                            <option value="cert">Сертифікат</option>
                            <option value="support">Підтримка</option>
                        </select>
                    </td>



                </tr>
                <tr>
                    <th>Сумма</th>
                    <td><input type="number" v-model="cond.amount"></td>
                    <!--<td class="error">{{errors.conditions.[index].amount}}</td>-->

                </tr>

            </div>
            <td>
                <button @click="addCondition()">+</button>
            </td>
            <td>
                <button @click="remCondition()">-</button>
            </td>
        </table>
        <button @click="add()">Додати</button>
        <!--<p>{{data}}</p>-->

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
                                condition: '',
                                amount: 0
                            },
                        ]
                },
                errors: {},
            }
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
            add(){

                this.$http.post('/admin/hostings/create', this.data).then(res => {
                    if (res.status === 201) {
                        console.log(res.data)
                        location.href = '/admin/hostings'
                    }
                    else {
                        console.log('err')

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