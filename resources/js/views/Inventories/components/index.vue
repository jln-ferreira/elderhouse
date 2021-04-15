<template>
    <div class="row">

        <!-- ---------------------- -->
        <!-- LIST INVENTORY -->
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
                            <tr v-for="product in filteredList" v-bind:key="product.id" :class="'product_' + product.id">
                                <td>{{product.id}}</td>
                                <td>{{product.name}}</td>
                                <td><input type="number" class="form-control" v-model="product.quantity" min="1" max="999" required></td>
                                <td>{{product.measurements_name}}</td>
                                <td>{{product.comment}}</td>
                                <td><span class="badge badge-primary ml-1" style="font-size: 1em;" v-for="category in product.categories" v-bind:key="category.id">{{category.category_name}}, </span></td>
                                <td>
                                    <button type="edit" class="btn btn-success" @click="editQuantity(product.id, product.quantity)"><i class="fas fa-save"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- END LIST INVENTORY -->

    </div>
</template>

<script>
    export default {

        data() {

            return {
                inventories: [],
                userId     : this.$userId,
                quantity   : "",

                search:'',
            }

        },


        created() {
            // Fetch all inventory
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

            // -----MODIFY QUANTITY-----
            editQuantity(product_id, quantity)
            {
                if(quantity == null) this.$toaster.error('Value cannot be null');
                else{
                    axios.post('/inventories/' + product_id, {
                    _method : 'PATCH',
                    quantity: quantity
                    })
                    .then(response => {
                        $(".product_" + response.data.id).fadeTo(100, 0.3, function() { $(this).fadeTo(500, 1.0); });
                        this.$toaster.success(response.data.name + ' edited.');
                    });
                }

            },


        }
    }

</script>
