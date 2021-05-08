<template>
    <div>
        <div class="row">
            <div class="col-xl-5">

                <form method="post" @submit.prevent="onSubmit_Role">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="nameRole">Role Name</label>
                            <input type="text" class="form-control" id="nameRole" v-model="formMenuRoles.roleName">
                            <span class="invalid-feedback d-block" role="alert" v-if="formMenuRoles.errors.has('roleName')" v-text="formMenuRoles.errors.get('roleName')"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <div class="form-group col-md-3">
                                <div class="custom-control custom-switch" v-for='menu in menus' v-bind:key='menu.id'>
                                    <input type="checkbox" class="custom-control-input" :id="menu.name" v-model="formMenuRoles.menu" :value="menu.id">
                                    <label class="custom-control-label" :for="menu.name">{{ menu.name }}</label>
                                </div>
                            </div>
                            <span class="invalid-feedback d-block" role="alert" v-if="formMenuRoles.errors.has('menu')" v-text="formMenuRoles.errors.get('menu')"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <button type="save" class="btn btn-success" v-show="saveRole"><i class="fa fa-plus"></i> Add</button>
                            <a type="edit" class="btn btn-primary" v-show="!saveRole" @click="modifyRole"><i class="fas fa-user-edit"></i> Edit</a>
                            <a type="cancel" class="btn btn-warning text-white" v-show="!saveRole" @click="cancelRole"><i class="fa fa-times"></i> Cancel</a>
                        </div>
                    </div>
                </form>

            </div>
            <!-- [ALL DIAGNOSTIC] -->
            <div class="col-xl-7">
                <div class="card" style="min-height: 235px;">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">List Roles</h3>
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
                                <tr v-for="(menuRole, index) in menuRoles" v-bind:key="index">
                                    <td>{{menuRole.role_id}}</td>
                                    <td>{{menuRole.role_name}}</td>
                                    <td><span class="badge badge-primary ml-1 mt-1" style="font-size: 1em;" v-for="menuName in menuRole.menus" v-bind:key="menuName.id">{{menuName.menu_name}} </span></td>
                                    <td>
                                        <button type="edit" class="btn btn-primary" @click="editRole(index)"><i class="far fa-edit"></i></button>
                                        <a type="delete" class="btn btn-danger text-white" @click="deleteRole(index)"><i class="far fa-trash-alt"></i></a>
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

                saveRole : true,

                menuRoles: [],
                menus    : [],

                formMenuRoles: new Form({
                    'id'       : '',
                    'roleName' : '',
                    'menu'     : [],
                }),


            }

        },


        computed: {

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

            // ---=== NEW ROLE_MENU ===---
            onSubmit_Role()
            {
                this.formMenuRoles
                .post('/menuroles')
                    .then(response => {
                        console.log(response);

                        this.menuRoles.push(response[0]);

                        this.$toaster.success('Role added.');
                    })
            },


            // ---=== DELETE ROLE_MENU ===---
            deleteRole(index)
            {
                if(confirm("Do you really want to delete?"))
                {
                    let role_id = this.menuRoles[index].role_id;

                    axios.post('/roles/' + role_id, {
                    _method: 'DELETE'
                    })
                    .then(response => {
                        var count = 0
                        this.menuRoles.forEach(element => {
                            element.role_id == (response.data.id) ? this.menuRoles.splice(count,1) : count +=1;
                        });

                        //clean field
                        this.formMenuRoles.id       = '';
                        this.formMenuRoles.roleName = '';
                        this.formMenuRoles.menu     = [];

                        this.saveRole = true;

                        this.$toaster.success('Successful deleted');
                    });
                }
            },


            // ---=== EDIT ROLE_MENU ===---
            editRole(index)
            {
                console.log('menu',this.menuRoles[index].menus);

                this.saveRole = false;

                //populate field
                this.formMenuRoles.id       = this.menuRoles[index].role_id;
                this.formMenuRoles.roleName = this.menuRoles[index].role_name;
                this.formMenuRoles.menu     = [];

                // populate checkbox
                this.menuRoles[index].menus.forEach(element => {
                   this.formMenuRoles.menu.push(element.menu_id);
                });

            },


            // ---=== MODIFY ROLE_MENU ===---
            modifyRole()
            {
                this.formMenuRoles
                    .patch('/menuroles')
                    .then(response => {

                        var index = this.menuRoles.findIndex(x => x.role_id === response[0].role_id);

                        this.menuRoles[index].role_name = response[0].role_name;
                        this.menuRoles[index].menus     = response[0].menus;

                        this.saveRole = true;

                        this.$toaster.success('Role edited.');
                    });

            },


            // ---=== CANCEL ROLE_MENU ===---
            cancelRole()
            {
                //clean field
                this.formMenuRoles.id       = '';
                this.formMenuRoles.roleName = '';
                this.formMenuRoles.menu     = [];

                this.saveRole = true;

                this.$toaster.warning('Canceled');

            }

        },

    }


</script>
