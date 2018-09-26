<template>
    <div class="bids">
        <div class="text-xs-left">
            <v-dialog v-model="dialog" width="500">
                <v-btn class="sbm-button" small slot="activator">
                    Добавити клієнта
                </v-btn>

                <v-card>
                    <v-card-title class="headline grey lighten-2" primary-title>
                        Клієнт
                    </v-card-title>

                    <v-card-text>

                        <form class="customerAdd-form">
                            <v-text-field
                                    v-model="name"
                                    label="Name"
                                    required
                                    @input="$v.name.$touch()"
                                    @blur="$v.name.$touch()"
                            ></v-text-field>
                            <v-text-field
                                    v-model="country"
                                    label="Country"
                                    required
                                    @input="$v.country.$touch()"
                                    @blur="$v.country.$touch()"
                            ></v-text-field>
                            <v-select
                                    v-model="status"
                                    :items="select"
                                    label="Status"
                                    required
                                    @change="$v.status.$touch()"
                                    @blur="$v.status.$touch()"
                            ></v-select>
                            <v-textarea
                                    v-model="info"
                                    auto-grow
                                    label="Info"
                                    required
                                    rows="2"
                                    @change="$v.info.$touch()"
                                    @blur="$v.info.$touch()"
                            ></v-textarea>

                            <v-btn @click="submit(name, country, info)">Відправити</v-btn>
                            <!--<v-btn @click="clear">Очистити</v-btn>-->
                        </form>

                    </v-card-text>

                    <v-divider></v-divider>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" flat @click="dialog = false">
                            Закрити
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </div>
    </div>
</template>

<script>
    import { validationMixin } from 'vuelidate'
    import { required } from 'vuelidate/lib/validators'

    export default {
        mixins: [validationMixin],

        validations: {
            name: { required },
            country: { required },
            info: { required },
            select: { required },
        },
        data() {
            return {

                name: '',
                country: '',
                info: '',
                status: '',
                select: ['First time', 'Regular', 'Problematic'],

                customer: {
                    name: '',
                    country: '',
                    info: '',
                    status: '',
                },

                dialog: false,
            }
        },
        computed: {

        },
        methods: {
            submit (name, country, info) {
                this.$v.$touch();

                this.customer.name = this.name;
                this.customer.country = this.country;
                this.customer.info = this.info;
                this.customer.status = this.status;

                let data = this.customer;
                axios.post('/user/add-customer', {data})
                    .then();

                this.dialog = false;
            },
            clear () {
                this.$v.$reset();
                this.name = '';
                this.country = '';
                this.info = '';
                this.select = '';
            }
        }
    };
</script>

<style>
    .customerAdd-form input {
        padding: 8px 0;;
    }
</style>