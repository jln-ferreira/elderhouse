<template>
    <div>
        <div class="row">
            <div class="col-xl-5">

                <form method="post">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="nameRole">Role Name</label>
                            <input type="text" class="form-control" id="nameRole">
                            <!-- <span class="invalid-feedback d-block" role="alert" v-if="formDiagnostic.errors.has('nameRole')" v-text="formDiagnostic.errors.get('nameRole')"></span> -->
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <div class="form-group col-md-3">
                                <div class="custom-control custom-switch" v-for='menu in menus' v-bind:key='menu.id'>
                                    <input type="checkbox" class="custom-control-input" :id="menu.name" v-model="formMenuRoles.Responsable" :value="menu.id">
                                    <label class="custom-control-label" :for="menu.name">{{ menu.name }}</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <button type="save" class="btn btn-success"><i class="fa fa-plus"></i> Add</button>
                            <a type="edit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Edit</a>
                            <a type="delete" class="btn btn-danger text-white"><i class="far fa-trash-alt"></i> Delete</a>
                            <a type="cancel" class="btn btn-warning text-white"><i class="fa fa-times"></i> Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- [ALL DIAGNOSTIC] -->
            <div class="col-xl-7">
                <div class="card" style="min-height: 235px;">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">List Roles</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search" v-model="search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive text-center p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Menus</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="menuRole in menuRoles" v-bind:key="menuRole.id">
                                    <td>{{menuRole.role_id}}</td>
                                    <td>{{menuRole.role_name}}</td>
                                    <td><span v-for="menuName in menuRole.menus" v-bind:key="menuName">{{menuName.menu_name}}, </span></td>
                                    <td>
                                        <button type="edit" class="btn btn-primary"><i class="far fa-edit"></i></button>
                                        <a type="delete" class="btn btn-danger text-white"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</template>

<script>

    export default {

        data() {

            return {

                menuRoles: [],
                menus    : [],

                formMenuRoles: new Form({
                    'id'          : '',
                    'roleName'    : '',
                    'Responsable' : [],
                }),


            }

        },


        created() {
            // Fetch Menus
            axios.get('/menus')
                .then(response => {
                    console.log(response.data);
                    this.menus = response.data
                });


            // Fetch roles
            axios.get('/menuRoleSettings')
                .then(response => {
                    console.log(response.data);
                    this.menuRoles = response.data
                });
        },


        methods: {

            },

    }


</script>
