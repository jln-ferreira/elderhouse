<template>
    <div class="row">

        <!-- ---------------------- -->
        <!-- LIST MEDICATES -->
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
                    <b-table striped hover :items="filteredList" :fields="fields" :filter="filter">
                        <template #cell(clientName)="data">
                            <b>{{ data.item.name + " " + data.item.surname }} <i v-show="data.item.rebateComment" data-toggle="tooltip" :title="'id: ' + data.item.rebateId + ' - ' + data.item.rebateComment" type="rebate" class="fas fa-exclamation-triangle text-danger"></i></b>
                        </template>
                        <!-- <template #cell(quantity)="data">
                            <input type="number" class="form-control" v-model="data.item.quantity" min="1" max="999" :style="dangerQuantity(data.item.quantity)" required>
                        </template> -->
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
                medicates      : [],
                medicatesFilter: '',

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
                    {key: 'userName', label: 'User Name', sortable: true},
                    {key: 'medicateComment', label: 'Comment', sortable: false},
                ],
                //---------------
            }

        },


        created() {
            // Fetch all inventory
            axios.get('/getMedicates').then(response => {
                this.medicates = response.data
                console.log(this.medicates);
                });
        },


        computed: {
            filteredList()
            {
                if(this.medicatesFilter != ''){                                                         //FILTER BY medicates
                    return this.medicates.filter(eachVal => {
                        return eachVal.medicates.some(({ medicate_id }) => medicate_id == this.medicatesFilter)
                    })
                }
                else return this.medicates;                                                               //ALL MEDICATES
            },
        },


        methods: {

        }
    }

</script>

<style scoped>


</style>
