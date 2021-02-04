<template>

    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Users</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">

            <div class="container-fluid">

                <div class="row">

                    <!-- ---------------------- -->
                    <!-- ADD NEW USER -->
                    <!-- ---------------------- -->
                    <div class="col-lg-12">

                        <div class="card card-dark">
                            <div class="card-header" @click="newUserToggle">
                                <h3 class="card-title font-weight-bold">New User Form</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <transition name="block">

                                <form class="form-horizontal" @submit.prevent="onSubmit" @keydown="form.errors.clear()" v-show="isShowing">
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" required autocomplete="name" autofocus placeholder="Name" v-model="form.name">
                                                <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" id="email" placeholder="Email" v-model="form.email" required>
                                                <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></span>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="email">Password</label>
                                                <input type="password" class="form-control" id="password" placeholder="Password" v-model="form.password" required>
                                                <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('password')" v-text="form.errors.get('password')"></span>
                                            </div>
                                        </div>

                                        <hr>

                                        <!-- ADDRESS -->
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="name">Street</label>
                                                <input type="text" class="form-control" id="street" name="street" autocomplete="street" autofocus placeholder="street" v-model="form.street">
                                                <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('street')" v-text="form.errors.get('street')"></span>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="email">Number</label>
                                                <input type="text" class="form-control" id="number" v-model="form.number" placeholder="92">
                                                <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('number')" v-text="form.errors.get('number')"></span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="name">City</label>
                                                <input type="text" class="form-control" id="city" name="city" autocomplete="City" autofocus placeholder="City" v-model="form.city">
                                                <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('city')" v-text="form.errors.get('city')"></span>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="name">State</label>
                                                <input type="text" class="form-control" id="state" name="state" autocomplete="State" autofocus placeholder="State" v-model="form.state">
                                                <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('state')" v-text="form.errors.get('state')"></span>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="name">Country</label>
                                                <input type="text" class="form-control" id="country" name="country" autocomplete="Country" autofocus placeholder="Country" v-model="form.country">
                                                <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('country')" v-text="form.errors.get('country')"></span>
                                            </div>
                                        </div>
                                        <!-- END ADDRESS -->

                                        <hr>

                                        <!-- ROLE -->
                                        <div class="form-group row">
                                            <label class="col-lg-2">
                                                <!-- Roles: -->
                                            </label>
                                            <div class="col-lg-9">
                                                <label class="col-lg-3" v-for='role in roles' v-bind:key="role.id">
                                                    <label>
                                                        <input type="checkbox" :value="role.id" v-model="form.checkedRoles">
                                                            {{role.name}}
                                                        <span></span>
                                                    </label>
                                                </label>
                                            </div>
                                            <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('checkedRoles')" v-text="form.errors.get('checkedRoles')"></span>
                                        </div>
                                        <!-- END ROLE -->

                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success ">Add User</button>
                                    </div>
                                    <!-- /.card-footer -->
                                </form>

                            </transition>
                        </div>

                    </div>
                    <!-- END ADD NEW USER -->


                    <!-- ---------------------- -->
                    <!-- LIST USER -->
                    <!-- ---------------------- -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title font-weight-bold">List Users</h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="user in users" v-bind:key="user.id">
                                            <td>{{user.id}}</td>
                                            <td>{{user.name}}</td>
                                            <td>{{user.email}}</td>
                                            <td>
                                                <button type="edit" class="btn btn-primary"><i class="far fa-edit"></i></button>
                                                <a type="delete" class="btn btn-danger text-white" @click="deleteUser(user.id)"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- END LIST USER -->

                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /.content -->

    </div>

</template>

<script>

    export default {

        data() {

            return {
                isShowing: false,

                roles: [],

                users: [],
                form: new Form({
                    'name': '',
                    'email': '',
                    'password': '',
                    'street': '',
                    'number': '',
                    'city': '',
                    'state': '',
                    'country': '',
                    'checkedRoles': [],
                })
            }

        },


        created() {
            // Fetch all Users
            axios.get('/users')
                .then(response => this.users = response.data);

             // Fetch all roles
            axios.get('/roles')
            .then(response => this.roles = response.data);
        },

        methods: {
            newUserToggle(){
                this.isShowing = !this.isShowing;
            },

            // -----ADD-----
            onSubmit(){
                this.form
                    .post('/users')
                    .then(user => {
                        this.users.push(user)
                        this.$toaster.success('Succeful added ' + user.name);
                    });
            },

            // -----DELETE-----
            deleteUser(id){
                axios.post('/users/' + id, {
                _method: 'DELETE'
                })
                .then(response => {
                    console.log(response);
                    this.$toaster.success('Succeful deleted ' + response.data.name);
                })
            }

        }
    }

</script>

<style>
    .block-enter {
        Opacity: 0;
    }
    .block-enter-active {
            transition : opacity 0.7s;
    }
    .block-leave-active {
             transition : opacity 0.3s;
            Opacity: 0;
    }
</style>
