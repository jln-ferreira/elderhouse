<template>
    <div class="row">

        <!-- ---------------------- -->
        <!-- LIST INVENTORY -->
        <!-- ---------------------- -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">

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
                    <b-table striped hover :items="this.clientProducts" :fields="fields" :filter="filter">
                        <template #cell(clientName)="data">
                            <b>{{ data.item.name + " " + data.item.surname }}</b>
                        </template>
                        <template #cell(actions)="data">
                            <button type="edit" class="btn btn-success" @click="checkMedicates(data.item.id)"><i class="fas fa-user-check"></i></button>
                            <a type="delete" class="btn btn-danger text-white" @click="deleteClientProduct(data.item.id)"><i class="fas fa-exclamation-triangle"></i></a>
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
                userId: this.$userId,

                clientProducts: [],

                // DATATABLE
                filter:'',
                fields: [
                    {key: 'id', sortable: true},
                    {key: 'clientName', label: 'Name', sortable: true},
                    {key: 'productName', label: 'Product', sortable: true},
                    {key: 'measurementName', label: 'Measurement', sortable: true},
                    {key: 'quantity', label: 'Quantity', sortable: true},
                    {key: 'date', label: 'Date', sortable: true},
                    {key: 'time', label: 'Time', sortable: true},
                    {key: 'comment',  sortable: false},
                    {key: 'actions', label: 'Actions' }
                ],
                //---------------

                categoryFilter : '',
                categoryClicked: ''
            }

        },


        created() {
            // Fetch all clientProducts
            axios.get('/scheduleMedicates').then(response => this.clientProducts = response.data);
        },


        computed: {

        },


        methods: {
            checkMedicates(id)
            {

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
