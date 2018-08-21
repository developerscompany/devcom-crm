<template>
    <div>

        <h2>{{title}}</h2>

        <p>{{hosting.last_name}} {{hosting.name}} {{hosting.second_name}}</p>
        <p>{{hosting.phone}}</p>
        <p>Послуги:</p>
        <p v-for="condition in hosting.conditions">{{condition.condition}} - {{condition.amount}}</p>

        <br>

        <textarea name="comment" id="" cols="50" rows="10" style="background: white"></textarea>
        <br>

        <button>Відправити</button>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                title: "Hostings",

            }
        },
        props: ['hosting'],
        methods: {


        }

    };
</script>