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
                                :items="bank"
                                item-text="title"
                                item-value="title"
                                label="Рахунок"
                                required
                        ></v-select>
                        <v-select
                                v-model="costType"
                                :items="type"
                                item-text="title"
                                item-value="title"
                                label="Стаття"
                                required
                        ></v-select>

                        <v-select
                                v-if="costType === 'зарплата'"
                                v-model="user"
                                :items="users"
                                item-text="name"
                                item-value="name"
                                label="Робітник"
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

        props: ['bank', 'type', 'users'],

        data(){
            return {
                dialog: false,

                bankAcc: [],
                costType: [],
                user: [],


                // costType: this.$props.type,
                // bankAccounts: this.$props.bank,



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
    .v-dialog {
        overflow: initial;
    }
</style>