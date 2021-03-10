<template>
    <div>
        <!-- ---------------------- -->
        <!-- ADD NEW DIAGNOSTIC -->
        <!-- ---------------------- -->
        <div class="col-lg-12">

            <div class="card card-dark" style="cursor:pointer;">
                <div class="card-header" @click="newDiagnosticToggle">
                    <h3 class="card-title font-weight-bold">New Diagnostic Form</h3> <i :class="[faChanging(), 'float-right']" aria-hidden="true"></i>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <transition name="block">

                    <form class="form-horizontal" @submit.prevent="onSubmit" @keydown="form.errors.clear()" v-show="isShowing">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Diagnostic Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required autocomplete="name" autofocus placeholder="Name" v-model="form.name">
                                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="rank">Rank</label>
                                    <input type="number" class="form-control" id="rank" v-model="form.rank" min="1" max="10" required>
                                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('rank')" v-text="form.errors.get('rank')"></span>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="save" v-show="this.newDiagnostic" class="btn btn-success"><i class="fa fa-plus"></i> Save</button>
                            <a type="edit" v-show="!this.newDiagnostic" class="btn btn-primary text-white" @click="modifyDiagnostic"><i class="far fa-edit"></i> Edit</a>
                            <a type="cancel" v-show="!this.newDiagnostic" class="btn btn-warning text-white" @click="cancelEdit"><i class="fa fa-times"></i> Cancel</a>
                        </div>
                        <!-- /.card-footer -->
                    </form>

                </transition>
            </div>

        </div>
        <!-- END ADD NEW diagnostic -->


        <!-- ---------------------- -->
        <!-- LIST DIAGNOSTIC -->
        <!-- ---------------------- -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">List Diagnostic</h3>

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
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-center">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Diagnostic Name</th>
                            <th>Rank</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(diagnostic, index) in filteredList" v-bind:key="diagnostic.id">
                                <td>{{diagnostic.id}}</td>
                                <td>{{diagnostic.name}}</td>
                                <td>{{diagnostic.rank}}</td>
                                <td>
                                    <button type="edit" class="btn btn-primary" @click="editDiagnostic(index)"><i class="far fa-edit"></i></button>
                                    <a type="delete" class="btn btn-danger text-white" @click="deleteDiagnostic(diagnostic.id)"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- END LIST diagnostic -->
    </div>
</template>

<script>

    export default {

        data() {

            return {
                isShowing: false,
                newDiagnostic: true,
                search:'',

                diagnostics: [],
                form: new Form({
                    'id'  : '',
                    'name': '',
                    'rank': '',
                })
            }

        },


        created()
        {
            // Fetch all diagnostics
            axios.get('/diagnostics')
                .then(response => this.diagnostics = response.data);

        },


        computed: {
            filteredList()
            {
                return this.diagnostics.filter(post => {
                    return post.name.toLowerCase().includes(this.search.toLowerCase());
                });
            }
        },


        methods: {
            newDiagnosticToggle()
            {
                this.isShowing = !this.isShowing;
            },
            faChanging(){
                return (this.isShowing == true) ? "fa fa-minus" : "fa fa-plus";
            },


            // ----- ADD  -----
            onSubmit()
            {
                this.form
                    .post('/diagnostics')
                    .then(diagnostic => {
                        this.diagnostics.push(diagnostic);
                        this.isShowing = false;
                        this.$toaster.success('Successful added ' + diagnostic.name);
                    })
            },


            // -----DELETE-----
            deleteDiagnostic(id)
            {
                axios.post('/diagnostics/' + id, {
                _method: 'DELETE'
                })
                .then(response => {
                    var count = 0
                    this.diagnostics.forEach(element => {
                        element.id == (response.data.id) ? this.diagnostics.splice(count,1) : count +=1;
                    });

                    this.isShowing = false;
                    this.newDiagnostic = true;
                    this.$toaster.success('Successful deleted ' + response.data.name);
                });
            },



            // -----EDIT-----
            editDiagnostic(index)
            {
                this.isShowing = true;                     //open new diagnostic
                this.newDiagnostic   = false;              //button cancel and edit show

                let diagnostic = this.diagnostics[index];  //diagnostic clicked

                //show values diagnostic
                this.form.id   = diagnostic.id;
                this.form.name = diagnostic.name;
                this.form.rank = diagnostic.rank;

            },


            //-------- MODIFY --------
            modifyDiagnostic()
            {
               this.form
                    .patch('/diagnostics')
                    .then(response => {
                        this.diagnostics.find(diagnostic => diagnostic.id == response.id).name = response.name;
                        this.diagnostics.find(diagnostic => diagnostic.id == response.id).rank = response.rank;
                        this.isShowing = false;
                        this.newDiagnostic   = true;
                        this.$toaster.success('Successful Updated ' + response.name);
                    });
            },


            cancelEdit()
            {
                this.newDiagnostic = true; //show button add diagnostic
                this.isShowing = false;

                // clean form
                this.form.id   = '';
                this.form.name = '';
                this.form.rank = '';
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
