<template>
    <div class="row">

        <!-- ---------------------- -->
        <!-- LIST INVENTORY -->
        <!-- ---------------------- -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <span class="badge badge-info ml-1" style="font-size: 1em;" v-for="category in categories" v-bind:key="category.id">{{category.name}}</span>

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
                            <th class="clickHeader" @click="sortBy('id')">ID</th>
                            <th class="clickHeader" @click="sortBy('name')">Name</th>
                            <th class="clickHeader" @click="sortBy('quantity')">Quantity</th>
                            <th class="clickHeader" @click="sortBy('measurements_name')">Measurement</th>
                            <th>Comments</th>
                            <th>Categories</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in filteredList" v-bind:key="product.id" :class="'product_' + product.id" :style="dangerQuantity(product.quantity)">
                                <td>{{product.id}}</td>
                                <td>{{product.name}}</td>
                                <td><input type="number" class="form-control" v-model="product.quantity" min="1" max="999" required></td>
                                <td>{{product.measurements_name}}</td>
                                <td>{{product.comment}}</td>
                                <td><span class="badge badge-primary ml-1" style="font-size: 1em;" v-for="category in product.categories" v-bind:key="category.id">{{category.category_name}} </span></td>
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

                categories: [],
                search:'',
                sort: {
                    key: '',
                    isAsc: 'asc'
                },
            }

        },


        created() {
            // Fetch all inventory
            axios.get('/inventories').then(response => this.inventories = response.data);
            // Fetch all categories
            axios.get('/categories').then(response => this.categories = response.data);
        },


        computed: {
            filteredList() {

                if(this.search){
                    return this.inventories.filter(post => {
                        return post.name.toLowerCase().includes(this.search.toLowerCase());
                    });
                }
                else if(this.sort.key) return _.orderBy(this.inventories, this.sort.key, this.sort.isAsc);
                else return this.inventories;

            },
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


            dangerQuantity(quantity){
                return (quantity <= 0) ? "background-color: #FFD6CE;" : "background-color: white;";
            },


            sortBy(key) {
                this.sort.isAsc = (this.sort.key == key) ? "desc" : "asc";
                this.sort.key = key;
            }

        }
    }

</script>

<style scoped>
    .clickHeader{
        transition: 0.8s;
        cursor: pointer;
    }
    .clickHeader:active{
        opacity: 0.7;
        padding-left: 3px;
    }
</style>
