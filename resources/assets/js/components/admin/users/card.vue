<template>

    <div class="users">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3" >
                    Проект
                </div>
                <div class="col-md-2" >
                    Статус
                </div>
                <div class="col-md-2" >
                    Створив
                </div>
                <div class="col-md-2" >
                    Виконавець
                </div>
            </div>
            <div class="row" v-for="project in projects">
                <div class="col-md-3" >
                    <a :href="'https://devcom.worksection.com'+project.page" :class="project.status">{{project.name}}</a>
                </div>
                <div class="col-md-2" >
                    <p>{{project.status}}</p>
                </div>
                <div class="col-md-2" >
                    <p>{{project.user_from.name}}</p>
                </div>
                <div class="col-md-2" >
                    <p>{{project.user_to.name}}</p>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

    export default {

        data(){
            return {


            }
        },

        props: ['projects'],
        mounted() {

        },

        methods: {


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