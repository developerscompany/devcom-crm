<template>
    <div class="add-user">
        <div class="text-xs-left">
            <v-dialog v-model="dialog" width="500">
                <v-btn slot="activator" color="red lighten-2" dark>
                    Добавить
                </v-btn>

                <v-card>
                    <v-card-title class="headline grey lighten-2" primary-title>
                        Запросити нового користувача
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
                                    :items="items"
                                    :error-messages="selectErrors"
                                    label="Item"
                                    required
                                    @change="$v.select.$touch()"
                                    @blur="$v.select.$touch()"
                            ></v-select>

                            <v-btn @click="submit">Відправити</v-btn>
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
    import { required, maxLength, email } from 'vuelidate/lib/validators'

    export default {
        mixins: [validationMixin],

        validations: {
            name: { required, maxLength: maxLength(10) },
            email: { required, email },
            select: { required },
        },
        data() {
            return {

                // editedItem: {
                    name: '',
                    email: '',
                    select: null,
                // },
                items: [
                    'Item 1',
                    'Item 2',
                    'Item 3',
                    'Item 4'
                ],
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
            submit () {
                this.$v.$touch();
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