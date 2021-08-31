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
                            <b>{{ data.item.name + " " + data.item.surname }} <i v-show="data.item.rebate_id" type="rebate" class="fas fa-exclamation-triangle text-danger"></i></b>
                        </template>
                        <template #cell(actions)="data">
                            <button type="edit" class="btn btn-success" @click="checkMedicates($event, data.item.id)" data-toggle="modal" data-target="#modal"><i type="edit" class="fas fa-user-check"></i></button>
                            <button type="rebate" class="btn btn-danger" @click="checkMedicates($event, data.item.id)" data-toggle="modal" data-target="#modal"><i type="rebate" class="fas fa-exclamation-triangle"></i></button>
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
                    <h5 class="modal-title" v-html="form.ckeckMedicate ? 'Você realmente realizou o medicamento abaixo?' : 'Porque está realizando este Rebate, conte-me?'"></h5>
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

                    <!-- product what was missing to do the medication -->
                    <div class="form-row">
                        <div class="form-group col-md-12" v-show="!form.ckeckMedicate && productRebate">
                            <label for="precification">Product</label>
                            <select class="form-control" v-model="form.productId" id="precification" name="precification" required>
                                <option v-for="product in products" v-bind:key="product.id" :value="product.id">{{product.name}}</option>
                            </select>
                        </div>
                    </div>
                    <!-- --------------- -->

                    <!-- //coments  -->
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="name">Comment</label>
                            <input v-if="form.ckeckMedicate" type="text" class="form-control" id="comment" name="comment" v-model="form.comment">
                            <input v-else type="text" class="form-control" id="commentRebate" name="commentRebate" v-model="form.commentRebate">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div v-show="!form.ckeckMedicate">
                        <button type="button" class="btn btn-danger" @click="productRebate = !productRebate"><i class="fas fa-tablets"></i></button>
                    </div>
                    <div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i></button>
                        <button v-if="form.ckeckMedicate" type="button" class="btn btn-success" data-dismiss="modal" @click="confirmMedicate"><i class="fas fa-user-check"></i></button>
                        <button v-else :disabled="!form.ckeckMedicate && form.commentRebate.length < 3" type="button" class="btn btn-danger" data-dismiss="modal" @click="confirmMedicate"><i class="fas fa-exclamation-triangle"></i></button>
                    </div>
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
                products: [],

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
                    'commentRebate'    : '',

                    // medicate x rebate
                    'ckeckMedicate'    : true,
                }),
                clickedMedicate: '',
                productRebate: false, //drop down with all products
            }

        },


        created() {
            // Fetch all clientProducts
            axios.get('/scheduleMedicates').then(response => {
                console.log(response);
                this.clientProducts = response.data
            });

            // Fetch all products
            axios.get('/productMedic').then(response => this.products = response.data);
        },


        computed: {

        },


        methods: {
            checkMedicates(event, id)
            {
                //FIND MEDICATES WAS CLICKED
                this.clickedMedicate = this.clientProducts.find(element => element.id == id);
                this.form.client_product_id = this.clickedMedicate.id;
                this.form.productId = this.clickedMedicate.rebate_product_id;
                this.form.commentRebate = (this.clickedMedicate.rebate_comment == null) ? "" : this.clickedMedicate.rebate_comment;

                // Find if MEDICATE  X REBATE
                event.target.getAttribute('type') == "edit" ? this.form.ckeckMedicate = true : this.form.ckeckMedicate = false;


            },

            // ------MODAL------
            confirmMedicate()
            {
                this.form
                    .post('/medicatesOrRebate')
                    .then(response => {

                        //updates variables
                        this.form.userId = this.$userId;                            //update user ID
                        this.form.date   = new Date().toISOString().substr(0, 10);  //update date

                        //RETURN MEDICATES
                        if(response[0].medicate_id)
                        {
                            var count = 0
                            this.clientProducts.forEach(element => {
                                element.id == (response[0].id) ? this.clientProducts.splice(count,1) : count +=1;
                            });

                            this.$toaster.success('Successful Medicated.');
                        }
                        //REBATE
                        else{
                            let findClientProduct = this.clientProducts.find(element => element.id == response[0].client_product_id);
                            findClientProduct.rebate_product_id = response[0].product_id;
                            findClientProduct.rebate_id = response[0].rebate_id;
                            findClientProduct.rebate_comment = response[0].comment;

                            console.log(this.clientProducts);
                            this.$toaster.success('Successful Rebate.');
                        }
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
