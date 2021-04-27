<template>
    <div class="row">

        <!-- ---------------------- -->
        <!-- LIST INVENTORY -->
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
                        <template #cell(quantity)="data">
                            <input type="number" class="form-control" v-model="data.item.quantity" min="1" max="999" :style="dangerQuantity(data.item.quantity)" required>
                        </template>
                        <template #cell(categories)="data">
                            <span class="badge badge-primary ml-1" style="font-size: 1em;" v-for="category in data.item.categories" v-bind:key="category.id">{{category.category_name}} </span>
                        </template>
                        <template #cell(actions)="data">
                            <button type="edit" class="btn btn-success" @click="editQuantity(data.item.id, data.item.quantity)"><i class="fas fa-save"></i></button>
                        </template>
                    </b-table>

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
                // DATATABLE
                filter:'',
                fields: [
                    {key: 'id', sortable: true},
                    {key: 'name', label: 'Name', sortable: true},
                    {key: 'measurements_name', label: 'Measurement', sortable: true},
                    {key: 'quantity', label: 'Quantity', sortable: true},
                    {key: 'comment', sortable: false},
                    {key: 'categories', label: 'Categories'},
                    {key: 'actions', label: 'Actions' }
                ],
                //---------------

                categoryFilter : '',
                categoryClicked: ''
            }

        },


        created() {
            // Fetch all inventory
            axios.get('/inventories').then(response => this.inventories = response.data);
            // Fetch all categories
            axios.get('/categories').then(response => this.categories = response.data);
        },


        computed: {
            filteredList()
            {
                if(this.categoryFilter != ''){                                                         //FILTER BY CATEGORY
                    return this.inventories.filter(eachVal => {
                        return eachVal.categories.some(({ category_id }) => category_id == this.categoryFilter)
                    })
                }

                else return this.inventories;                                                               //ALL PRODUCTS
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

            //------------------------------------------------------
            //----style----
            dangerQuantity(quantity)
            {
                return (quantity <= 0) ? "border-color: coral;" : "border-color: #ced4da;";
            },
            categoryBtn(categoryId)
            {
                return (this.categoryClicked == categoryId) ? "background-color: #007bff;" : "background-color: #6c757d;";
            },
            //-------------

            catFilter(categoryId)
            {
                (this.categoryClicked == categoryId) ? this.categoryClicked = '' : this.categoryClicked = categoryId;                    //color button
                this.categoryFilter = (this.categoryFilter == categoryId) ? this.categoryFilter = '' : this.categoryFilter = categoryId; //filter
            }

        }
    }

</script>

<style scoped>
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
