<template>

    <div class="users">
        <v-toolbar flat color="white">
            <v-dialog v-model="dialog" max-width="500px">
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
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
                        <v-btn color="blue darken-1" flat @click.native="save">Save</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-toolbar>
        <div id="inspire" class="application theme--light">
            <v-data-table
                    :headers="headers"
                    :items="users"
                    hide-actions
                    class="elevation-1">
                <template slot="items" slot-scope="props">
                    <td><a :href="'/admin/user/'+props.item.id">{{ props.item.name }}</a></td>
                    <td>{{ props.item.email }}</td>
                    <td>{{ props.item.role }}</td>
                    <td class="justify-center layout px-0">
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
</style>