<template>
    <div class="row">

         <!-- ---------------------- -->
        <!-- ADD NEW USER -->
        <!-- ---------------------- -->
        <div class="col-lg-12">

            <div class="card card-dark" style="cursor:pointer;">
                <div class="card-header" @click="newUserToggle">
                    <h3 class="card-title font-weight-bold">New User Form</h3> <i :class="[faChanging(), 'float-right']" aria-hidden="true"></i>
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
                                    <input type="text" class="form-control" id="email" placeholder="Email" v-model="form.email" :disabled="!newUser" required>
                                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="email">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Password" v-model="form.password" :required="newUser">
                                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('password')" v-text="form.errors.get('password')"></span>
                                </div>
                            </div>
                                <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="CPF">CPF</label>
                                    <input type="number" class="form-control" id="CPF" name="CPF" placeholder="422.332.445-34" v-model="form.CPF">
                                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('CPF')" v-text="form.errors.get('CPF')"></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="RG">RG</label>
                                    <input type="number" class="form-control" id="RG" name="RG" placeholder="43.456.34-2" v-model="form.RG">
                                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('RG')" v-text="form.errors.get('RG')"></span>
                                </div>
                            </div>

                            <hr>

                            <!-- ADDRESS -->
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="street">Street</label>
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

                                <div class="form-row">
                                    <div class="form-group">
                                        <div class="form-group col-md-3">
                                            <div class="custom-control custom-switch" v-for='role in roles' v-bind:key="role.id">
                                                <input type="checkbox" class="custom-control-input" :id="role.name" v-model="form.checkedRoles" :value="role.id">
                                                <label class="custom-control-label" :for="role.name">{{ role.name }}</label>
                                            </div>
                                        </div>
                                        <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('checkedRoles')" v-text="form.errors.get('checkedRoles')"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- END ROLE -->

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="save" v-show="this.newUser" class="btn btn-success"><i class="fa fa-plus"></i> Save</button>
                            <a type="edit" v-show="!this.newUser" class="btn btn-primary text-white"><i class="far fa-edit" @click="modifyUser"></i> Edit</a>
                            <a type="cancel" v-show="!this.newUser" class="btn btn-warning text-white" @click="cancelEdit"><i class="fa fa-times"></i> Cancel</a>
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
                        <!-- SEARCH BAR -->
                        <b-input-group size="sm">
                            <b-form-input id="filter-input" v-model="filter" type="search" placeholder="Type to Search"></b-form-input>
                            <b-input-group-append>
                                <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
                            </b-input-group-append>
                        </b-input-group>
                        <!-- ---------------- -->
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <!-- TABLE BOOTSTRAP VUE -->
                    <b-table striped hover :items="this.users" :fields="fields" :filter="filter">
                        <template #cell(actions)="data">
                            <button type="edit" class="btn btn-primary" @click="editUser(data.item.id)"><i class="far fa-edit"></i></button>
                            <a type="delete" class="btn btn-danger text-white" @click="deleteUser(data.item.id)"><i class="far fa-trash-alt"></i></a>
                        </template>
                    </b-table>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- END LIST USER -->

    </div>
</template>

<script>
    export default {

        data() {

            return {
                isShowing: false,
                newUser: true,
                // DATATABLE
                filter:'',
                fields: [
                    {key: 'id', sortable: true},
                    {key: 'name', sortable: true},
                    {key: 'email', sortable: true},
                    {key: 'actions', label: 'Actions'}
                ],
                //---------------

                roles: [],
                users: [],
                form: new Form({
                    'id'          : '',
                    'name'        : '',
                    'email'       : '',
                    'CPF'         : '',
                    'RG'          : '',
                    'password'    : '',
                    'street'      : '',
                    'number'      : '',
                    'city'        : '',
                    'state'       : '',
                    'country'     : '',
                    'checkedRoles': [],
                }),
            }

        },


        created() {
            // Fetch all Users
            axios.get('/users').then(response => this.users = response.data);
             // Fetch all roles
            axios.get('/roles').then(response => this.roles = response.data);
        },

        methods: {
            newUserToggle(){
                this.isShowing = !this.isShowing;
            },
            faChanging(){
                return (this.isShowing == true) ? "fa fa-minus" : "fa fa-plus";
            },
            cleanFields(){
                // clean form
                this.form.name         = '';
                this.form.email        = '';
                this.form.password     = '';
                this.form.CPF          = '';
                this.form.RG           = '';
                this.form.street       = '';
                this.form.number       = '';
                this.form.city         = '';
                this.form.state        = '';
                this.form.country      = '';
                this.form.checkedRoles = [];
            },


            // ----- ADD / MODIFY -----
            onSubmit(){
                this.form
                    .post('/users')
                    .then(user => {
                        console.log(user);
                        this.users.push(user);
                        this.isShowing = false;
                        this.newUser   = true;
                        this.$toaster.success('Successful added ' + user.name);
                    })
            },


            // -----DELETE-----
            deleteUser(id){
                axios.post('/users/' + id, {
                _method: 'DELETE'
                })
                .then(response => {
                    var count = 0
                    this.users.forEach(element => {
                        element.id == (response.data.id) ? this.users.splice(count,1) : count +=1;
                    });

                    this.isShowing = false;
                    this.newUser = true;
                    this.cleanFields();
                    this.$toaster.success('Successful deleted ' + response.data.name);
                });
            },


            // -----EDIT-----
            editUser(id){
                this.isShowing = true;          //open new user
                this.newUser   = false;         //button cancel and edit show

                var user = this.users.find(element => element.id === id);

                this.cleanFields();             //clean all fields

                //show values user
                this.form.id    = user.id;
                this.form.name  = user.name;
                this.form.email = user.email;
                this.form.CPF   = user.CPF;
                this.form.RG    = user.RG;


                // Fetch all address of the user
                axios.get('/getUserAddressRole/' + user.id)
                .then(response => {
                    console.log(response);
                    // show value address
                    this.form.street  = response.data.address.street;
                    this.form.number  = response.data.address.number;
                    this.form.city    = response.data.address.city;
                    this.form.state   = response.data.address.state;
                    this.form.country = response.data.address.country;

                    // show value roles
                    this.form.checkedRoles = [];
                    response.data.role.forEach(element => {
                        this.form.checkedRoles.push(element.role_id)
                    });

                });

            },
            modifyUser(){
                this.form
                    .patch('/users')
                    .then(response => {
                        this.users.find(user => user.id == response.id).name = response.name;
                        this.users.find(user => user.id == response.id).CPF = response.CPF;
                        this.users.find(user => user.id == response.id).RG = response.RG;
                        this.isShowing = false;
                        this.newUser   = true;
                        this.$toaster.success('Successful Updated ' + response.name);
                    });
            },


            cancelEdit(){
                this.newUser = true; //show button add User
                // clean form
                this.cleanFields();
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
