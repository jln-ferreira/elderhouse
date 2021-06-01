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
                            <button type="edit" class="btn btn-success" @click="checkMedicates($event, data.item.id)" data-toggle="modal" data-target="#modal"><i class="fas fa-user-check"></i></button>
                            <button type="delete" class="btn btn-danger" @click="checkRebate($event, data.item.id)" data-toggle="modal" data-target="#modal"><i class="fas fa-exclamation-triangle"></i></button>
                        </template>
                    </b-table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- END LIST INVENTORY -->



        <!-- ----------MODAL---------- -->
        <div class="modal fade" id="modal" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-html="ckeckMedicate ? 'Você realmente realizou o medicamento abaixo?' : 'Porque está realizando este Rebate, conte-me?'"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="list-group">
                        <span class="list-group-item list-group-item-action">
                            <i class="fas fa-user-alt"></i> <span>{{this.clickedMedicate.name}} {{this.clickedMedicate.surname}}</span>
                        </span>
                        <span class="list-group-item list-group-item-action">
                           <i class="fas fa-pills"></i> <span>{{this.clickedMedicate.productName}} - {{this.clickedMedicate.quantity}} {{this.clickedMedicate.measurementName}}</span>
                        </span>
                        <span class="list-group-item list-group-item-action">
                            <i class="fas fa-calendar-day"></i> <span>{{this.clickedMedicate.date}}</span>
                        </span>
                        <span class="list-group-item list-group-item-action">
                            <i class="fas fa-clock"></i> <span>{{this.clickedMedicate.time}}</span>
                        </span>
                        <span class="list-group-item list-group-item-action">
                            <i class="fas fa-comments"></i> <span>{{this.clickedMedicate.comment ? this.clickedMedicate.comment : 'No Comments'}}</span>
                        </span>
                    </div>

                    <br/>

                    <!-- //coments  -->
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="name">Comment</label>
                            <input type="text" class="form-control" id="comment" name="comment" v-model="form.comment">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i></button>
                    <button type="button" class="btn btn-success" data-dismiss="modal" @click="confirmMedicate"><i class="fas fa-user-check"></i></button>
                </div>
                </div>
            </div>
        </div>
        <!-- END MODAL -->

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

                // FORM
                form: new Form({
                    'id'               : '',
                    'userId'           : this.$userId,
                    'client_product_id': '',
                    'date'             : new Date().toISOString().substr(0, 10),
                    'comment'          : '',

                    // for rebate
                    'productId'        : '',
                }),
                clickedMedicate: '',
                ckeckMedicate: true,
            }

        },


        created() {
            // Fetch all clientProducts
            axios.get('/scheduleMedicates').then(response => {
                console.log(response);
                this.clientProducts = response.data
            });
        },


        computed: {

        },


        methods: {
            checkMedicates(event, id)
            {
                console.log(event.target.getAttribute('type'));
                // var options = event.target.options
                // if (options.selectedIndex > -1) this.form.value = options[options.selectedIndex].getAttribute('type');


                //FIND MEDICATES WAS CLICKED
                this.clickedMedicate = this.clientProducts.find(element => element.id == id);
                this.form.client_product_id = this.clickedMedicate.id;
            },

            // ------MODAL------
            confirmMedicate()
            {
                this.form
                    .post('/medicates')
                    .then(response => {

                        //updates variables
                        this.form.userId = this.$userId;                            //update user ID
                        this.form.date   = new Date().toISOString().substr(0, 10);  //update date

                        var count = 0
                        this.clientProducts.forEach(element => {
                            element.id == (response[0].id) ? this.clientProducts.splice(count,1) : count +=1;
                        });

                        this.$toaster.success('Successful Medicated.');
                    })
            },
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
