<template>
    <div class="add-user row justify-content-between align-items-center">
        <div class="col-2">
            <h2>Users</h2>
        </div>
        <div class="col-2 text-right">
            <v-dialog v-model="dialog" width="500">
                <v-btn slot="activator">
                    Add a new user +
                </v-btn>

                <v-card>
                    <v-card-title class="headline" primary-title>
                        Invite a new user

                        <a class="btn-close pull-right" @click="dialog = false">
                            X
                        </a>
                        <!--<v-card-actions>-->
                            <!--<v-btn color="primary" flat >-->
                                <!--X-->
                            <!--</v-btn>-->
                        <!--</v-card-actions>-->
                    </v-card-title>

                    <v-card-text>

                        <form>
                            <v-text-field
                                    v-model="name"
                                    :error-messages="nameErrors"
                                    :counter="1"
                                    label="Name"
                                    required
                                    @input="$v.name.$touch()"
                                    @blur="$v.name.$touch()"
                            ></v-text-field>
                            <v-text-field
                                    v-model="email"
                                    :error-messages="emailErrors"
                                    label="E-mail"
                                    required
                                    @input="$v.email.$touch()"
                                    @blur="$v.email.$touch()"
                            ></v-text-field>
                            <v-select
                                    v-model="select"
                                    :items="roles"
                                    item-text="name"
                                    item-value="name"
                                    :error-messages="selectErrors"
                                    label="Roles"
                                    required
                                    @change="$v.select.$touch()"
                                    @blur="$v.select.$touch()"
                            ></v-select>

                            <div class="row mb-0 justify-content-between">
                                <div class="col-6 text-left">
                                    <v-btn class="reset" @click="clear">Очистити</v-btn>
                                </div>
                                <div class="col-6 text-right">
                                    <v-btn class="add" @click="submit(name, email, select)">Відправити</v-btn>
                                </div>
                            </div>
                        </form>

                    </v-card-text>
                </v-card>
            </v-dialog>
        </div>
    </div>
</template>

<script>
    import { validationMixin } from 'vuelidate'
    import { required, maxLength, email } from 'vuelidate/lib/validators'

    export default {
        mixins: [validationMixin],

        validations: {
            name: { required, maxLength: maxLength(10) },
            email: { required, email },
            select: { required },
        },
        props: ['roles'],
        data() {
            return {

                name: '',
                email: '',
                select: null,

                newUser: {
                    name: '',
                    email: '',
                    select: '',
                },

                dialog: false,
            }
        },
        computed: {
            selectErrors () {
                const errors = [];
                // this.$v.editedItem.select
                if (!this.$v.select.$dirty) return errors;
                !this.$v.select.required && errors.push('Item is required');
                return errors;
            },
            nameErrors () {
                const errors = [];
                if (!this.$v.name.$dirty) return errors;
                !this.$v.name.maxLength && errors.push('Name must be at most 1 characters long');
                !this.$v.name.required && errors.push('Name is required.');
                return errors;
            },
            emailErrors () {
                const errors = [];
                if (!this.$v.email.$dirty) return errors;
                !this.$v.email.email && errors.push('Must be valid e-mail');
                !this.$v.email.required && errors.push('E-mail is required');
                return errors;
            }
        },
        methods: {
            submit (name, email, role) {
                this.$v.$touch();

                this.newUser.name = this.name;
                this.newUser.email = this.email;
                this.newUser.select = this.select;

                let data = this.newUser;
                axios.post('/admin/invite', {data})
                    .then();

                this.dialog = false;
            },
            clear () {
                this.$v.$reset();
                this.name = '';
                this.email = '';
                this.select = null;
            }
        }
    };
</script>

<style>
    h2 {
        font-family: UbuntuBold;
        font-size: 18px;
    }
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