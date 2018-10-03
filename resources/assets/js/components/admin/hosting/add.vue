<template>
    <div class="hosting-list">


        <div class="text-xs-left">
            <v-dialog v-model="dialog" width="500">
                <v-btn slot="activator" class="btn-yellow">
                    Додати
                    <v-icon
                        small
                        class="mr-2"
                        >
                    add
                    </v-icon>
                </v-btn>

                <v-card>
                    <v-card-title class="headline grey lighten-2" primary-title>
                        Додати новий аккаунт
                    </v-card-title>

                    <v-card-text>

                        <form>
                            <v-text-field
                                    v-model="last_name"
                                    :error-messages="lastNameErrors"
                                    label="Прізвище"
                                    required
                                    @input="$v.last_name.$touch()"
                                    @blur="$v.last_name.$touch()"
                            ></v-text-field>
                            <v-text-field
                                    v-model="name"
                                    :error-messages="nameErrors"
                                    label="Ім'я"
                                    required
                                    @input="$v.name.$touch()"
                                    @blur="$v.name.$touch()"
                            ></v-text-field>
                            <v-text-field
                                    v-model="second_name"
                                    :error-messages="secondNameErrors"
                                    label="По батькові"
                                    required
                                    @input="$v.second_name.$touch()"
                                    @blur="$v.second_name.$touch()"
                            ></v-text-field>
                            <v-text-field
                                    v-model="phone"
                                    :error-messages="phoneErrors"
                                    label="Номер телефону"
                                    required
                                    @input="$v.phone.$touch()"
                                    @blur="$v.phone.$touch()"
                            ></v-text-field>
                            <v-text-field
                                    v-model="site"
                                    :error-messages="siteErrors"
                                    label="Домен"
                                    required
                                    @input="$v.site.$touch()"
                                    @blur="$v.site.$touch()"
                            ></v-text-field>
                            <!--<v-select
                                    v-model="select"
                                    :items="roles"
                                    item-text="name"
                                    item-value="name"
                                    :error-messages="selectErrors"
                                    label="Item"
                                    required
                                    @change="$v.select.$touch()"
                                    @blur="$v.select.$touch()"
                            ></v-select>-->

                            <v-btn @click="submit()">Відправити</v-btn>
                            <v-btn @click="clear">Очистити</v-btn>
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
    import { required, maxLength, minLength, numeric } from 'vuelidate/lib/validators'
    import {Events} from '../../../vue'

    export default {
        mixins: [validationMixin],

        validations: {
            name: { required },
            last_name: { required },
            second_name: { required },
            phone: { required, numeric },
            site: { required },
        },

        data() {
            return {

                name: '',
                last_name: '',
                second_name: '',
                phone: '',
                site: '',

                newAcc: {
                    name: '',
                    last_name: '',
                    second_name: '',
                    phone: '',
                    site: '',
                },

                dialog: false,
                errors: '',
            }
        },
        computed: {
            /*selectErrors () {
                const errors = [];
                // this.$v.editedItem.select
                if (!this.$v.select.$dirty) return errors;
                !this.$v.select.required && errors.push('Item is required');
                return errors;
            },*/
            lastNameErrors () {
                const errors = [];
                if (!this.$v.last_name.$dirty) return errors;
                !this.$v.last_name.required && errors.push("Прізвище - обов'язково.");
                this.errors.last_name && errors.push(this.errors.last_name[0])
                return errors;
            },
            secondNameErrors () {
                const errors = [];
                if (!this.$v.second_name.$dirty) return errors;
                !this.$v.second_name.required && errors.push("По батькові - обов'язково.");
                this.errors.second_name && errors.push(this.errors.second_name[0])
                return errors;
            },
            nameErrors () {
                const errors = [];
                if (!this.$v.name.$dirty) return errors;
                !this.$v.name.required && errors.push("Ім'я - обов'язково.");
                this.errors.name && errors.push(this.errors.name[0])
                return errors;
            },
            phoneErrors () {
                const errors = [];
                if (!this.$v.phone.$dirty) return errors;
                !this.$v.phone.numeric && errors.push('Мають бути цифри або спецзнаки.');
                !this.$v.phone.required && errors.push("Телефон - обов'язково.");
                this.errors.phone && errors.push(this.errors.phone[0])

                return errors;
            },
            siteErrors () {
                const errors = [];
                if (!this.$v.site.$dirty) return errors;
                !this.$v.site.required && errors.push("Домен - обов'язково.");
                this.errors.site && errors.push(this.errors.site[0])
                return errors;
            }
        },
        methods: {
            submit () {
                this.$v.$touch();

                this.newAcc.name = this.name;
                this.newAcc.last_name = this.last_name;
                this.newAcc.second_name = this.second_name;
                this.newAcc.phone = this.phone;
                this.newAcc.site = this.site;
                let data = this.newAcc;

                // console.log(this.newAcc)
                this.$http.post('/admin/hostings/create', data).then(res => {
                    if (res.status === 201) {
                        this.dialog = false;
                        let account = res.data.data
                        Events.$emit('getListNewAcc', account);
                    }
                    else {
                        this.dialog = false;

                    }
                }, err => {
                    this.errors = err.data.errors
                })


            },
            clear () {
                this.$v.$reset();
                this.name = '';
                this.last_name = '';
                this.second_name = '';
                this.phone = '';
                this.site = '';
            }
        }
    };
</script>

<style>
    .v-dialog.v-dialog--active{
        background-color: white;
    }
    .v-messages__message {
        color: red;
    }
</style>