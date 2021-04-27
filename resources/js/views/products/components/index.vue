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
                    <span class="badge badge-info ml-1 categoriesBtn" style="font-size: 1em;" v-for="category in categories" v-bind:key="category.id" @click="catFilter(category.id)" :style="categoryBtn(category.id)">{{category.name}}</span>

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
                    <b-table striped hover :items="filteredList" :fields="fields" :filter="filter">
                        <template #cell(categories)="data">
                            <span class="badge badge-primary ml-1" style="font-size: 1em;" v-for="category in data.item.categories" v-bind:key="category.id">{{category.category_name}} </span>
                        </template>
                        <template #cell(actions)="data">
                            <button type="edit" class="btn btn-primary" @click="editProduct(data.item.id)"><i class="far fa-edit"></i></button>
                            <a type="delete" class="btn btn-danger text-white" @click="deleteProduct(data.item.id)"><i class="far fa-trash-alt"></i></a>
                        </template>
                    </b-table>

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

                // DATATABLE
                filter:'',
                fields: [
                    {key: 'id', sortable: true},
                    {key: 'name', label: 'Name', sortable: true},
                    {key: 'measurements_name', label: 'Measurement', sortable: true},
                    {key: 'comment', sortable: false},
                    {key: 'categories', label: 'Categories'},
                    {key: 'actions', label: 'Actions' }
                ],
                //---------------

                categoryFilter : '',
                categoryClicked: '',

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

                if(this.categoryFilter != ''){                                                         //FILTER BY CATEGORY
                    return this.products.filter(eachVal => {
                        return eachVal.categories.some(({ category_id }) => category_id == this.categoryFilter)
                    })
                }

                else return this.products;                                                               //ALL PRODUCTS
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
            editProduct(id){
                this.isShowing  = true;          //open new product
                this.newProduct = false;         //button cancel and edit show

                let product = this.products.find(element => element.id === id);

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


            cancelEdit()
            {
                this.newProduct = true; //show button add User
                // clean form
                this.cleanFields();
            },
            //----------------------------
            categoryBtn(categoryId)
            {
                return (this.categoryClicked == categoryId) ? "background-color: #007bff;" : "background-color: #6c757d;";
            },

            catFilter(categoryId)
            {
                (this.categoryClicked == categoryId) ? this.categoryClicked = '' : this.categoryClicked = categoryId;                    //color button
                this.categoryFilter = (this.categoryFilter == categoryId) ? this.categoryFilter = '' : this.categoryFilter = categoryId; //filter
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


    /* table */
    .clickHeader{
        transition: 0.5s;
        cursor: pointer;
    }
    .clickHeader:active{
        opacity: 0.3;
        font-size: 10%;
    }
    /* ----- */


    /* categories - filter */
    .categoriesBtn{
        cursor: pointer;
    }
</style>
