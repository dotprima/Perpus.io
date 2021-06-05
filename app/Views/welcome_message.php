<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>users List</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
</head>

<body>
    <div id="app">
        <v-app>
            <v-main>
                <v-container>
                    <!-- Table List users -->
                    <template>
                        <!-- Button Add New users -->
                        <template>
                            <v-btn color="primary" dark @click="modalAdd = true">Add New</v-btn>
                        </template>

                        <v-simple-table>
                            <template v-slot:default>
                                <thead>
                                    <tr>
                                        <th class="text-left">Nama User</th>
                                        <th class="text-left">Email</th>
                                        <th class="text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="users in userss" :key="users.id">
                                        <td>{{ users.name}}</td>
                                        <td>{{ users.email }}</td>
                                        <td>
                                            <template>
                                                <v-icon small class="mr-2" @click="editItem(users)">
                                                    mdi-pencil
                                                </v-icon>
                                                <v-icon small @click="deleteItem(users)">
                                                    mdi-delete
                                                </v-icon>
                                            </template>
                                        </td>
                                    </tr>
                                </tbody>
                            </template>
                        </v-simple-table>

                    </template>
                    <!-- End Table List users -->

                    <!-- Modal Save users -->
                    <template>
                        <v-dialog v-model="modalAdd" persistent max-width="600px">
                            <v-card>
                                <v-card-title>
                                    <span class="headline">Add New users</span>
                                </v-card-title>
                                <v-card-text>
                                    <v-container>
                                        <v-row>
                                            <v-col cols="12">
                                                <v-text-field label="users Name*" v-model="usersName" required>
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12">
                                                <v-text-field label="Price*" v-model="usersPrice" required>
                                                </v-text-field>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                    <small>*indicates required field</small>
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="blue darken-1" text @click="modalAdd = false">Close</v-btn>
                                    <v-btn color="blue darken-1" text @click="saveusers">Save</v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </template>
                    <!-- End Modal Save users -->

                    <!-- Modal Edit users -->
                    <template>
                        <v-dialog v-model="modalEdit" persistent max-width="600px">
                            <v-card>
                                <v-card-title>
                                    <span class="headline">Edit users</span>
                                </v-card-title>
                                <v-card-text>
                                    <v-container>
                                        <v-row>
                                            <v-col cols="12">
                                                <v-text-field label="users Name*" v-model="name" required>
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12">
                                                <v-text-field label="Price*" v-model="email" required>
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12">
                                                <v-text-field label="Price*" v-model="password" required>
                                                </v-text-field>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                    <small>*indicates required field</small>
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="blue darken-1" text @click="modalEdit = false">Close</v-btn>
                                    <v-btn color="blue darken-1" text @click="updateusers">Update</v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </template>
                    <!-- End Modal Edit users -->

                    <!-- Modal Delete users -->
                    <template>
                        <v-dialog v-model="modalDelete" persistent max-width="600px">
                            <v-card>
                                <v-card-title>
                                    <span class="headline"></span>
                                </v-card-title>
                                <v-card-text>
                                    <v-container>
                                        <v-row>
                                            <h3>Are sure want to delete <strong>"{{ usersNameDelete }}"</strong> ?
                                            </h3>
                                        </v-row>
                                    </v-container>
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="blue darken-1" text @click="modalDelete = false">No</v-btn>
                                    <v-btn color="info darken-1" text @click="deleteusers">Yes
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </template>
                    <!-- End Modal Delete users -->

                </v-container>
            </v-main>
        </v-app>
    </div>

    <script src="https://vuejs.org/js/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
    new Vue({
        el: '#app',
        vuetify: new Vuetify(),
        data: {
            userss: [],
            modalAdd: false,
            usersName: '',
            usersPrice: '',
            modalEdit: false,
            usersIdEdit: '',
            name: '',
            email: '',
            password: '',
            modalDelete: false,
            usersIdDelete: '',
            usersNameDelete: '',
        },
        created: function() {
            axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
            this.getuserss();
        },
        methods: {
            // Get users
            getuserss: function() {
                axios.get('/users')
                    .then(res => {
                        // handle success
                        this.userss = res.data;
                    })
                    .catch(err => {
                        // handle error
                        console.log(err);
                    })
            },
            // Save users
            saveusers: function() {
                axios.post('/users', {
                        users_name: this.usersName,
                        users_price: this.usersPrice
                    })
                    .then(res => {
                        // handle success
                        this.getuserss();
                        this.usersName = '';
                        this.usersPrice = '';
                        this.modalAdd = false;
                    })
                    .catch(err => {
                        // handle error
                        console.log(err);
                    })
            },

            // Get Item Edit users
            editItem: function(users) {
                this.modalEdit = true;
                this.usersIdEdit = users.users_id;
                this.name = users.users_name;
                this.email = users.users_price;
            },

            //Update users
            updateusers: function() {
                axios.put(`users/${this.usersIdEdit}`, {
                        users_name: this.name,
                        users_price: this.email
                    })
                    .then(res => {
                        // handle success
                        this.getuserss();
                        this.modalEdit = false;
                    })
                    .catch(err => {
                        // handle error
                        console.log(err);
                    })
            },

            // Get Item Delete users
            deleteItem: function(users) {
                this.modalDelete = true;
                this.usersIdDelete = users.id;
                this.usersNameDelete = users.name;
            },

            // Delete users
            deleteusers: function() {
                axios.delete(`users/${this.usersIdDelete}`)
                    .then(res => {
                        // handle success
                        this.getuserss();
                        this.modalDelete = false;
                    })
                    .catch(err => {
                        // handle error
                        console.log(err);
                    })
            }

        },

    })
    </script>
</body>

</html>