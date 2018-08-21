<template>
    <div>

        <h2>{{title}}</h2>
        <div align="right">
            <a href="/admin/hostings/add"><button >Add</button></a>
        </div>

        <table class="hosting-table-column">
            <b>
                <tr>
                    <td class="filter-cell">ПІБ</td>
                    <td class="filter-cell">Телефон</td>
                    <td>Послуги</td>
                    <td>Сумма</td>
                </tr>
                <tr v-for="list in lists">


                        <td><a :href="'hostings/account/'+ list.id">{{list.last_name}} {{list.name}} {{list.second_name}}</a></td>
                        <td>{{list.phone}}</td>
                        <td><i v-for="condition in list.conditions">{{condition.condition}},</i>

                        </td>
                        <td>{{list.amount_all}}</td>


                </tr>
            </b>
        </table>

    </div>
</template>

<script>
    export default {

        data(){
            return {
                title: "Hostings",
            }
        },
        props: ['lists'],

    };
</script>