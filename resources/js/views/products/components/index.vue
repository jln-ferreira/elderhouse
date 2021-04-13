<template>
    <div class="row">

         <!-- ---------------------- -->
        <!-- ADD NEW PRODUCT -->
        <!-- ---------------------- -->
        <div class="col-lg-12">

            <div class="card card-dark" style="cursor:pointer;">
                <div class="card-header" @click="newProductToggle">
                    <h3 class="card-title font-weight-bold">New Product Form</h3> <i :class="[faChanging(), 'float-right']" aria-hidden="true"></i>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <transition name="block">

                    <form class="form-horizontal" @submit.prevent="onSubmit" @keydown="form.errors.clear()" v-show="isShowing">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required autocomplete="name" placeholder="Name" v-model="form.name">
                                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="measurement">Measurement</label>
                                    <select class="form-control" v-model="form.measurement" id="measurement" name="measurement" required>
                                        <option v-for="measurement in measurements" v-bind:key="measurement.id" :value="measurement.id">{{measurement.measurement}}</option>
                                    </select>
                                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('measurement')" v-text="form.errors.get('measurement')"></span>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="comment">Comments</label>
                                    <input type="comment" class="form-control" id="comment" placeholder="comment" v-model="form.comment">
                                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('comment')" v-text="form.errors.get('comment')"></span>
                                </div>
                            </div>

                            <hr>

                            <!-- CATEGORY -->
                            <div class="form-group row">
                                <label class="col-lg-2">
                                    <!-- CATEGORIES: -->
                                </label>

                                <div class="form-row">
                                    <div class="form-group">
                                        <div class="form-group col-md-3">
                                            <div class="custom-control custom-switch" v-for='category in categories' v-bind:key="category.id">
                                                <input type="checkbox" class="custom-control-input" :id="category.name" v-model="form.checkedCategories" :value="category.id">
                                                <label class="custom-control-label" :for="category.name">{{ category.name }}</label>
                                            </div>
                                        </div>
                                        <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('checkedRoles')" v-text="form.errors.get('checkedRoles')"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- END CATEGORY -->

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="save"  class="btn btn-success" v-show="this.newProduct"><i class="fa fa-plus"></i> Save</button>
                            <a class="btn btn-primary text-white" v-show="!this.newProduct" @click="modifyProduct"><i class="far fa-edit"></i> Edit</a>
                            <a type="cancel" class="btn btn-warning text-white" v-show="!this.newProduct" @click="cancelEdit"><i class="fa fa-times"></i> Cancel</a>
                        </div>
                        <!-- /.card-footer -->
                    </form>

                </transition>
            </div>

        </div>
        <!-- END ADD NEW PRODUCT -->


        <!-- ---------------------- -->
        <!-- LIST PRODUCT -->
        <!-- ---------------------- -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">List Products</h3>

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
                            <th>Name</th>
                            <th>Measurement</th>
                            <th>Comment</th>
                            <th>Categories</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(product, index) in filteredList" v-bind:key="product.id">
                                <td>{{product.id}}</td>
                                <td>{{product.name}}</td>
                                <td>{{product.measurements_name}}</td>
                                <td>{{product.comment}}</td>
                                <td><span class="badge badge-primary ml-1" style="font-size: 1em;" v-for="category in product.categories" v-bind:key="category.id">{{category.category_name}}, </span></td>
                                <td>
                                    <button type="edit" class="btn btn-primary" @click="editProduct(index)"><i class="far fa-edit"></i></button>
                                    <a type="delete" class="btn btn-danger text-white" @click="deleteProduct(product.id)"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- END LIST PRODUCT -->

    </div>
</template>

<script>
    export default {

        data() {

            return {
                isShowing: false,
                newProduct: true,
                search:'',

                categories:        [],
                products:          [],
                measurements:      [],

                form: new Form({
                    'id'               : '',
                    'name'             : '',
                    'measurement'      : '',
                    'comment'          : '',
                    'userId'           : this.$userId,
                    'checkedCategories': [],
                }),
            }

        },


        created() {
            // Fetch all Users
            axios.get('/products').then(response => this.products = response.data);

             // Fetch all categories
            axios.get('/categories').then(response => this.categories = response.data);

            // Fetch all Measurement
            axios.get('/measurements').then(response => this.measurements = response.data);
        },


        computed: {
            filteredList() {
                return this.products.filter(post => {
                    return post.name.toLowerCase().includes(this.search.toLowerCase());
                });
            }
        },


        methods: {
            newProductToggle(){
                this.isShowing = !this.isShowing;
            },
            faChanging(){
                return (this.isShowing == true) ? "fa fa-minus" : "fa fa-plus";
            },
            cleanFields(){
                // clean form
                this.form.id                = '';
                this.form.name              = '';
                this.form.measurement       = '';
                this.form.comment           = '';
                this.form.checkedCategories = [];
            },


            // ----- ADD / MODIFY -----
            onSubmit(){

                this.form
                    .post('/products')
                    .then(response => {
                        this.products.push(response[0]);
                        this.isShowing  = false;
                        this.newProduct = true;
                        this.$toaster.success('Successful added ' + response.name);
                    })
            },


            // -----DELETE-----
            deleteProduct(id){
                axios.post('/products/' + id, {
                _method: 'DELETE'
                })
                .then(response => {
                    var count = 0
                    this.products.forEach(element => {
                        element.id == (response.data.id) ? this.products.splice(count,1) : count +=1;
                    });

                    this.isShowing = false;
                    this.newProduct = true;
                    this.cleanFields();
                    this.$toaster.success('Successful deleted ' + response.data.name);
                });
            },


            // -----EDIT-----
            editProduct(index){
                this.isShowing  = true;          //open new product
                this.newProduct = false;         //button cancel and edit show

                let product = this.products[index];  //user clicked

                this.cleanFields();                  //clean all fields

                //show values product
                this.form.id                = product.id;
                this.form.name              = product.name;
                this.form.measurement       = product.measurement_id;
                this.form.comment           = product.comment;
                this.form.checkedCategories = [];

                // populate checkbox
                product.categories.forEach(element => {
                   this.form.checkedCategories.push(element.category_id);
                });

            },


            // -----MODIFY-----
            modifyProduct()
            {
                this.form
                    .patch('/products')
                    .then(response => {

                        var index = this.products.findIndex(x => x.id === response[0].id);

                        this.products[index].name             = response[0].name;
                        this.products[index].measurement_name = response[0].measurement_name;
                        this.products[index].comment          = response[0].comment;
                        this.products[index].categories       = response[0].categories;

                        this.newProduct = true;

                        this.$toaster.success('Product edited.');
                    });

            },


            cancelEdit(){
                this.newProduct = true; //show button add User
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
