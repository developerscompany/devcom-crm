<template>
    <div class="transactions">
        <v-dialog v-model="dialog" persistent max-width="500px">
            <v-btn slot="activator" color="primary" dark>- Витрати</v-btn>
            <v-card>
                <!--<v-card-title>-->
                    <!--<span class="headline">User Profile</span>-->
                <!--</v-card-title>-->
                <v-card-text>
                    <v-form lazy-validation>
                        <v-select
                                v-model="bankAcc"
                                label="Рахунок"
                                required
                        ></v-select>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" flat @click.native="dialog = false">Close</v-btn>
                    <v-btn color="blue darken-1" flat @click.native="dialog = false">Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>


    </div>
</template>

<script>
    export default {

        props: ['bank'],

        data(){
            return {
                dialog: false,

                bankAcc: [],
                bankAccounts: this.$props.bank,
            }
        },

        mounted() {

        },

        methods: {

        },

        watch: {

        },
    };
</script>

<style>

</style>