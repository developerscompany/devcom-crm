<template>
    <div class="bids">
        <div class="text-xs-left">
            <v-dialog v-model="dialog" width="500">
                <v-btn class="sbm-button" small slot="activator">
                    Добавити клієнта
                </v-btn>

                <v-card>
                    <v-card-title class="headline" primary-title>
                        Клієнт

                        <a class="btn-close pull-right" @click="dialog = false">
                            X
                        </a>
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
                                    v-model="select"
                                    :items="status"
                                    label="Status"
                                    required
                                    :error-messages="selectErrors"
                                    @change="$v.select.$touch()"
                                    @blur="$v.select.$touch()"
                            ></v-select>
                            <v-textarea
                                    v-model="info"
                                    auto-grow
                                    label="Info"
                                    required
                                    rows="2"
                                    @input="$v.info.$touch()"
                                    @blur="$v.info.$touch()"
                            ></v-textarea>

                            <div class="row mb-0 justify-content-between">
                                <div class="col-5 text-left">
                                    <v-btn class="reset" @click="clear">Очистити</v-btn>
                                </div>
                                <div class="col-7 text-right">
                                    <v-btn color="primary" flat @click="dialog = false">
                                        Закрити
                                    </v-btn>
                                    <v-btn class="add" @click="submit(name, country, select, info)">Відправити</v-btn>
                                </div>
                            </div>

                            <!--<v-btn @click="submit(name, country, info)">Відправити</v-btn>-->
                            <!--<v-btn @click="clear">Очистити</v-btn>-->
                        </form>

                    </v-card-text>

                    <!--<v-divider></v-divider>-->

                    <!--<v-card-actions>-->
                        <!--<v-spacer></v-spacer>-->
                        <!--<v-btn color="primary" flat @click="dialog = false">-->
                            <!--Закрити-->
                        <!--</v-btn>-->
                    <!--</v-card-actions>-->
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
                status: ['First time', 'Regular', 'Problematic'],
                select: '',

                customer: {
                    name: '',
                    country: '',
                    status: '',
                    info: '',
                },

                dialog: false,
            }
        },
        computed: {
            selectErrors () {
                const errors = [];
                if (!this.select.$dirty) return errors;
                !this.select.required && errors.push('Item is required');
                return errors;
            },
        },
        methods: {
            submit (name, country, select, info) {
                this.$v.$touch();

                this.customer.name = name;
                this.customer.country = country;
                this.customer.status = select;
                this.customer.info = info;

                let data = this.customer;
                axios.post('/user/add-customer', {data})
                    .then(
                        this.dialog = false,
                    );
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
    /*.customerAdd-form input {*/
        /*padding: 8px 0;;*/
    /*}*/
    button.v-btn {
        background: #f8dd3f;
        color: #404447;
        border: none;
        box-shadow: none !important;
        padding: 5px 20px;
        font-size: 14px;
        border-radius: 15px;
        text-transform: none;
    }
    button.v-btn:hover {
        background: #000;
    }
    button.v-btn:hover div {
        color: #fff !important;
    }
    .v-card__title {
        color: #f8dd3f !important;
    }
    .btn-close {
        position: absolute;
        top: 15px;
        right: 20px;
    }
    button.reset {
        background: none;
        padding: 0;
    }
    button.reset:before {
        background: none !important;
    }
    button.reset div {
        color: #a0a0a0 !important;
    }
    button.reset:hover {
        background: none !important;
    }
    button.reset:hover div {
        color: #000 !important;
    }
</style>