<template>
    <div>
        <!-- ---------------------- -->
        <!-- ADD NEW PRECIFICATION -->
        <!-- ---------------------- -->
        <div class="col-lg-12">

            <div class="card card-dark" style="cursor:pointer;">
                <div class="card-header" @click="newPrecificationToggle">
                    <h3 class="card-title font-weight-bold">New Precification Form</h3> <i :class="[faChanging(), 'float-right']" aria-hidden="true"></i>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <transition name="block">

                    <form class="form-horizontal" @submit.prevent="onSubmit" @keydown="form.errors.clear()" v-show="isShowing">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required placeholder="Mensalidade" v-model="form.name">
                                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" id="price" name="price" required placeholder="2050,40" v-model="form.price">
                                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('price')" v-text="form.errors.get('price')"></span>
                                </div>
                                 <div class="form-group col-md-6">
                                    <label for="name">Comment</label>
                                    <input type="text" class="form-control" id="comment" name="comment" v-model="form.comment">
                                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('comment')" v-text="form.errors.get('comment')"></span>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="save" v-show="this.newPrecification" class="btn btn-success"><i class="fa fa-plus"></i> Save</button>
                            <a type="edit" v-show="!this.newPrecification" class="btn btn-primary text-white" @click="modifyPrecification"><i class="far fa-edit"></i> Edit</a>
                            <a type="cancel" v-show="!this.newPrecification" class="btn btn-warning text-white" @click="cancelEdit"><i class="fa fa-times"></i> Cancel</a>
                        </div>
                        <!-- /.card-footer -->
                    </form>

                </transition>
            </div>

        </div>
        <!-- END ADD NEW Precification -->


        <!-- ---------------------- -->
        <!-- LIST PRECIFICATION -->
        <!-- ---------------------- -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">List Precification</h3>

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
                    <b-table striped hover :items="this.precifications" :fields="fields" :filter="filter">
                        <template #cell(actions)="data">
                            <button type="edit" class="btn btn-primary" @click="editPrecification(data.item.id)"><i class="far fa-edit"></i></button>
                            <a type="delete" class="btn btn-danger text-white" @click="deletePrecification(data.item.id)"><i class="far fa-trash-alt"></i></a>
                        </template>
                    </b-table>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- END LIST PRECIFICATION -->
    </div>
</template>

<script>

    export default {

        data() {

            return {
                isShowing: false,
                newPrecification: true,
                // DATATABLE
                filter:'',
                fields: [
                    {key: 'id', sortable: true},
                    {key: 'name', sortable: true},
                    {key: 'price', sortable: true},
                    {key: 'comment', sortable: false},
                    {key: 'actions', label: 'Actions' }
                ],
                //---------------

                precifications: [],
                form: new Form({
                    'id'     : '',
                    'name'   : '',
                    'price'  : '',
                    'comment': '',
                })
            }

        },


        created()
        {
            // Fetch all precification
            axios.get('/precifications').then(response => this.precifications = response.data);
        },

        methods: {
            newPrecificationToggle()
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
                    .post('/precifications')
                    .then(response => {
                        this.precifications.push(response);
                        this.isShowing = false;
                        this.$toaster.success('Successful added ' + response.name);
                    })
            },


            // -----DELETE-----
            deletePrecification(id)
            {
                axios.post('/precifications/' + id, {
                _method: 'DELETE'
                })
                .then(response => {
                    var count = 0
                    this.precifications.forEach(element => {
                        element.id == (response.data.id) ? this.precifications.splice(count,1) : count +=1;
                    });

                    this.isShowing = false;
                    this.newPrecification = true;
                    this.$toaster.success('Successful deleted ' + response.data.name);
                });
            },



            // -----EDIT-----
            editPrecification(id)
            {
                this.isShowing = true;                    //open new precifications
                this.newPrecification = false;              //button cancel and edit show

                var precifications = this.precifications.find(element => element.id === id);

                //show values precifications
                this.form.id      = precifications.id;
                this.form.name    = precifications.name;
                this.form.price   = precifications.price;
                this.form.comment = precifications.comment;
            },


            //-------- MODIFY --------
            modifyPrecification()
            {
               this.form
                    .patch('/precifications')
                    .then(response => {
                        this.precifications.find(precification => precification.id == response.id).name = response.name;
                        this.precifications.find(precification => precification.id == response.id).price = response.price;
                        this.precifications.find(precification => precification.id == response.id).comment = response.comment;
                        this.isShowing = false;
                        this.newPrecification   = true;
                        this.$toaster.success('Successful Updated ' + response.name);
                    });
            },


            cancelEdit()
            {
                this.newPrecification = true; //show button add precifications
                this.isShowing = false;

                // clean form
                this.form.id      = '';
                this.form.name    = '';
                this.form.price   = '';
                this.form.comment = '';
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
