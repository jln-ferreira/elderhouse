<template>
    <div class="row">

        <!-- ---------------------- -->
        <!-- LIST REBATES -->
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
                            <b>{{ data.item.name + " " + data.item.surname }} <i v-show="data.item.medicateComment" data-toggle="tooltip" :title="'id: ' + data.item.medicateId + ' - ' + data.item.medicateComment" type="medicate" class="fas fa-check-circle text-success"></i></b>
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
        <!-- END LIST REBATES -->

    </div>
</template>

<script>
    export default {
        props:{
            rebateUp: "", //after paid the invoice
        },
        data() {

            return {
                rebates      : [],
                rebatesFilter: '',

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
                    {key: 'rebateComment', label: 'Comment', sortable: false},
                ],
                //---------------
            }

        },


        created() {
            // Fetch all inventory
            axios.get('/getRebates').then(response => {
                this.rebates = response.data
                console.log('rebate');
                console.log('rebate', this.rebates);
                });
        },


        computed: {
            filteredList()
            {
                // Add new rebate here
                if(this.rebateUp != '') {
                    let findRebate = this.rebates.find(element => element.id == this.rebateUp.id );
                    findRebate.rebateComment = this.rebateUp.rebateComment
                    // this.rebates.push(this.rebateUp);
                }
                if(this.rebatesFilter != ''){                                                         //FILTER BY rebates
                    return this.rebates.filter(eachVal => {
                        return eachVal.rebates.some(({ medicate_id }) => medicate_id == this.rebatesFilter)
                    })
                }
                else return this.rebates;                                                               //ALL rebates
            },
        },


        methods: {


        }
    }

</script>

<style scoped>


</style>
