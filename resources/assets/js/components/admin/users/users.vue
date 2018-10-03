<template>

    <div class="users">
        <v-toolbar flat color="white">
            <v-dialog v-model="dialog" max-width="800px">
                <v-card>
                    <v-card-text>
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs12 sm6 md4>
                                    <v-text-field v-model="editedItem.name" label="Name"></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm6 md4>
                                    <v-text-field v-model="editedItem.email" label="Email"></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm6 md4>
                                    <v-select
                                            v-model="editedItem.role"
                                            :items="roles"
                                            label="Role"
                                            item-text="name"
                                            item-value="name"
                                    ></v-select>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2">
                                    <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
                                </div>
                                <div class="col-md-2">
                                    <v-btn color="blue darken-1" flat @click.native="save">Save</v-btn>
                                </div>
                            </div>
                        </div>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-toolbar>
        <div id="inspire" class="application">
            <v-data-table
                    :headers="headers"
                    :items="users"
                    hide-actions
                    class="elevation-1">
                <template slot="items" slot-scope="props">
                    <td class="my-2">
                        <a :href="'/admin/user/'+props.item.id">
                        <img class="img-fluid mr-2" src="/img/user.png">
                            {{ props.item.name }}
                        </a>
                    </td>
                    <td class="my-2">{{ props.item.email }}</td>
                    <td class="my-2">
                        <span :class="props.item.role" class="px-4 py-1 text-uppercase">
                            {{ props.item.role }}
                        </span>
                    </td>
                    <td class="justify-center layout px-0 my-2">
                        <v-icon
                                small
                                class="mr-2"
                                @click="editItem(props.item)">
                            edit
                        </v-icon>
                    </td>
                </template>
            </v-data-table>
        </div>
    </div>

</template>

<script>

    export default {

        props: ['users', 'roles'],

        data(){
            return {

                headers: [
                    { text: 'Name', value: 'name' },
                    { text: 'Email', value: 'email' },
                    { text: 'Role', value: 'role' },
                    { text: 'Edit', value: '', class: 'text-center' },
                ],
                dialog: false,
                editedIndex: -1,
                editedItem: {
                    name: '',
                    email: '',
                    role: '',
                },
                defaultItem: {
                    name: '',
                    email: '',
                    role: '',
                },
            }
        },

        mounted() {

        },

        methods: {

            editItem (item) {
                this.editedIndex = this.users.indexOf(item);
                this.editedItem = Object.assign({}, item);
                this.dialog = true;
            },

            close () {
                this.dialog = false;
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem);
                    this.editedIndex = -1;
                }, 300)
            },

            save () {
                if (this.editedIndex > -1) {
                    Object.assign(this.users[this.editedIndex], this.editedItem);

                    let data = this.editedItem;
                    axios.post('/admin/edit-roles', {data})
                        .then();

                } else {
                    this.users.push(this.editedItem)
                }
                this.close()
            }

        },

        watch: {
            dialog (val) {
                val || this.close()
            }
        },
    };
</script>

<style>
    .v-dialog {
        background: #fff;
        max-height: initial !important;
        overflow: unset;
    }
    #inspire .elevation-1 {
        box-shadow: none !important;
    }
    thead th {
        font-family: PoppinsMedium;
        font-size: 14px;
    }
    td span {
        color: #fff;
        border-radius: 5px;
    }
    td span.dev {
        background: #f7e16f; /* Old browsers */
        background: -moz-linear-gradient(left, #f7e16f 0%, #fdd725 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(left, #f7e16f 0%,#fdd725 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to right, #f7e16f 0%,#fdd725 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    }
    td span.sale {
        background: #72d5cb; /* Old browsers */
        background: -moz-linear-gradient(left, #72d5cb 0%, #15bda3 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(left, #72d5cb 0%,#15bda3 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to right, #72d5cb 0%,#15bda3 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    }
    td span.pm {
        background: #7dc0f6; /* Old browsers */
        background: -moz-linear-gradient(left, #7dc0f6 0%, #1587e2 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(left, #7dc0f6 0%,#1587e2 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to right, #7dc0f6 0%,#1587e2 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    }
</style>