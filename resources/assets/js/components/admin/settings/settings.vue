<template>

    <div class="users">

        <div class="container-fluid">
            <h2>Хостинг.Послуги</h2>
            <div class="row">
                <div class="col-md-3">Назва(англ)</div>
                <div class="col-md-3">Назва(укр)</div>
                <div class="col-md-3">Класс(class)</div>
                <div class="col-md-3">Події</div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <input type="text" class="form-control" v-model="cond.name">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" v-model="cond.name_ua">
                </div>

                <div class="col-md-3">
                    <input type="text" class="form-control" v-model="cond.class">
                </div>

                <div class="col-md-3">

                    <button class="btn" @click="saveConditions">Зберегти</button>
                </div>

            </div>
            <div class="row" v-for="condition in conditions">
                <div class="col-md-3">{{condition.name}}</div>
                <div class="col-md-3">{{condition.name_ua}}</div>
                <div class="col-md-3">{{condition.class}}</div>
                <div class="col-md-3"></div>


            </div>
        </div>
    </div>

</template>

<script>

    export default {

        data(){
            return {

                cond: {}


            }
        },

        props: ['conditions'],


        mounted() {

        },

        methods: {
            saveConditions() {

                this.$http.post('/admin/settings/add', this.cond).then(res => {
                    location.href = '/admin/settings'
                }, err => {

                    console.log(err.data)
                })


            }

        },

        watch: {

        },
    };
</script>

<style>
    .active{
        color: green;
    }


</style>