<template>
    <div class="row">

        <!-- ---------------------- -->
        <!-- LIST PRODUCT -->
        <!-- ---------------------- -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">Inventory List</h3>

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
                            <th>Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(product, index) in filteredList" v-bind:key="product.id">
                                <td>{{product.id}}</td>
                                <td>{{product.name}}</td>
                                <td class="h6"><b>{{product.quantity}}</b></td>
                                <td>{{product.measurements_name}}</td>
                                <td>{{product.comment}}</td>
                                <td><span class="badge badge-primary ml-1" style="font-size: 1em;" v-for="category in product.categories" v-bind:key="category.id">{{category.category_name}}, </span></td>

                                <td>
                                    <button type="edit" class="btn btn-primary" @click="editProduct(index)"><i class="far fa-edit"></i></button>
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
        <!-- END LIST PRODUCT -->

    </div>
</template>

<script>
    export default {

        data() {

            return {
                inventories: [],
                userId     : this.$userId,

                search:'',
            }

        },


        created() {
            // Fetch all products
            axios.get('/inventories').then(response => this.inventories = response.data);
        },


        computed: {
            filteredList() {
                return this.inventories.filter(post => {
                    return post.name.toLowerCase().includes(this.search.toLowerCase());
                });
            }
        },


        methods: {

            // ----- ADD -----
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
