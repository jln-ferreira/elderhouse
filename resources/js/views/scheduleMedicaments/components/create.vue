<template>
    <div>
        <!-- ---------------------- -->
        <!-- ADD NEW PAYMENTS -->
        <!-- ---------------------- -->
        <div class="col-lg-12">

            <div class="card card-dark" style="cursor:pointer;">
                <div class="card-header" @click="newPaymentToggle">
                    <h3 class="card-title font-weight-bold">New Schedule Form</h3> <i :class="[faChanging(), 'float-right']" aria-hidden="true"></i>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <transition name="block">

                    <form class="form-horizontal" @submit.prevent="onSubmit" @keydown="form.errors.clear()" v-show="isShowing">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="clientName">Client Name</label>
                                    <select class="form-control" v-model="form.clientId" id="clientName" name="clientName" required>
                                        <option v-for="client in clients" v-bind:key="client.id" :value="client.id">{{client.name + " " + client.surname}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="precification">Product</label>
                                    <select class="form-control" v-model="form.productId" id="precification" name="precification" required>
                                        <option v-for="product in products" v-bind:key="product.id" :value="product.id">{{product.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="measurement">Measurement</label>
                                    <select class="form-control" v-model="form.measurementId" id="measurement" name="measurement" required>
                                        <option v-for="measurement in measurements" v-bind:key="measurement.id" :value="measurement.id">{{measurement.measurement}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" class="form-control" name="quantity" v-model="form.quantity" min="0.01" max="9999" step="0.01" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-2" style="align-self: flex-end;">
                                    <a class="form-control btn btn-warning" @click="singleDateBtn()"><i class="fas fa-calendar-day"></i> Single Date</a>
                                </div>
                                <div class="form-group col-lg-2" style="align-self: flex-end;">
                                    <a :class="['form-control', 'btn', 'btn-warning', disableCustom ? 'block-custom' : 'abble-custom']" @click="customDateBtn()"><i class="fas fa-calendar-minus"></i> Custom Dates</a>
                                </div>
                            </div>

                            <hr>

                            <!-- SINGLE -->
                            <!-- INPUT TO SEND TO DB  -->
                            <div v-show="singleDate">

                                <h3 class="mb-4"><b>Single Date</b></h3>

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="date">Date</label>
                                        <input type="date" class="form-control" name="date" v-model="form.date" :min="this.minDate" :required="singleDate">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="time">Time</label>
                                        <input type="time" class="form-control" name="time" v-model="form.time" required>
                                    </div>
                                </div>

                            </div>
                            <!-- END SINGLE -->

                            <!-- CUSTOM -->
                            <!-- INPUT TO SEND TO DB  -->
                            <div v-show="!singleDate">

                                <h3 class="mb-4 "><b>Custom Dates</b></h3>

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Week Day</label>
                                        <div class="custom-control custom-switch" v-for='weekField in this.weekFields' v-bind:key='weekField.id'>
                                            <input type="checkbox" class="custom-control-input" :id="'week_' + weekField.id" v-model="form.week" :value="weekField.id">
                                            <label class="custom-control-label" :for="'week_' + weekField.id">{{ weekField.week }}</label>
                                        </div>
                                        <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('week')" v-text="form.errors.get('week')"></span>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="time">Time</label>
                                        <input type="time" class="form-control" name="time" v-model="form.time" required>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="repeat">Repetition</label>
                                        <input type="number" class="form-control" name="repeat" v-model="form.repeat" min="1" max="12" oninput="validity.valid||(value='');" :required="!singleDate">
                                    </div>
                                </div>

                            </div>
                            <!-- END CUSTOM -->


                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="name">Comment</label>
                                    <input type="text" class="form-control" id="comment" name="comment" v-model="form.comment">
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="save" v-show="this.newClientProduct" class="btn btn-success"><i class="fa fa-plus"></i> Save</button>
                            <a type="edit" v-show="!this.newClientProduct" class="btn btn-primary text-white" @click="modifyClientProduct"><i class="far fa-edit"></i> Edit</a>
                            <a type="cancel" v-show="!this.newClientProduct" class="btn btn-warning text-white" @click="cancelClientProduct"><i class="fa fa-times"></i> Cancel</a>
                        </div>
                        <!-- /.card-footer -->
                    </form>

                </transition>
            </div>

        </div>
        <!-- END ADD NEW SCHEDULE MEDICAMENTS -->


        <!-- ---------------------- -->
        <!------- LIST SCHEDULE MEDICAMENTS ------->
        <!-- ---------------------- -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">List Medicament Schedule</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm">
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

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <!-- TABLE BOOTSTRAP VUE -->
                    <b-table striped hover :items="this.clientProducts" :fields="fields" :filter="filter">
                        <template v-slot:cell(selected)="data">
                            <b-form-group>
                                <input type="checkbox" style="width: 30px; height: 30px;" v-model="deleteSelected" :value="data.item.id" />
                            </b-form-group>
                        </template>
                        <template #cell(clientName)="data">
                            <b>{{ data.item.name + " " + data.item.surname }}</b>
                        </template>
                        <template #cell(actions)="data">
                            <button type="edit" class="btn btn-primary" @click="editClientProduct(data.item.id)"><i class="far fa-edit"></i></button>
                            <a type="delete" class="btn btn-danger text-white" @click="deleteClientProduct(data.item.id)"><i class="far fa-trash-alt"></i></a>
                        </template>
                    </b-table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            {{new Date().toString().substr(4, )}}
        </div>
        <!-- END LIST SCHEDULE MEDICAMENTS -->
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isShowing: false,
                newClientProduct: true,

                clients       : [],
                products      : [],
                measurements  : [],
                clientProducts: [],

                weekFields: [
                    {id: 1, week: 'Segunda-Feira'},
                    {id: 2, week: 'Terça-Feira'},
                    {id: 3, week: 'Quarta-Feira'},
                    {id: 4, week: 'Quinta-Feira'},
                    {id: 5, week: 'Sexta-Feira'},
                    {id: 6, week: 'Sabado'},
                    {id: 7, week: 'Domingo'},
                ],

                singleDate: true,
                minDate: '',


                form: new Form({
                    'id'           : '',
                    'clientId'     : '',
                    'productId'    : '',
                    'userId'       : this.$userId,
                    'measurementId': '',
                    'quantity'     : '',
                    'date'         : '',
                    'time'         : '',
                    'comment'      : '',

                    'repeat'       : '',
                    'week'         : [],
                }),

                deleteSelected: [],
                disableCustom: false,

                // DATATABLE
                filter:'',
                fields: [
                    {key: 'selected', label: '', sortable: false},
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
            }

        },

        created()
        {
            // Fetch all clientProducts
            axios.get('/clientProducts').then(response => this.clientProducts = response.data);
            // Fetch all clients
            axios.get('/clients').then(response => this.clients = response.data);
            // Fetch all products
            axios.get('/productMedic').then(response => this.products = response.data);
            // Fetch all Measurement
            axios.get('/measurements').then(response => this.measurements = response.data);

            //min date fill
            this.minDate = new Date().toISOString().substr(0, 10);
        },

        computed: {

        },

        methods: {
            newPaymentToggle()
            {
                this.isShowing = !this.isShowing;
            },
            faChanging(){
                return (this.isShowing == true) ? "fa fa-minus" : "fa fa-plus";
            },

            cleanFields(){
                    this.form.id            = '';
                    this.form.clientId      = '';
                    this.form.productId     = '';
                    this.form.userId        = this.$userId;
                    this.form.measurementId = '';
                    this.form.quantity      = '';
                    this.form.date          = '';
                    this.form.time          = '';
                    this.form.comment       = '';
                    this.form.repeat        = '';
                    this.form.week          = [];
            },

            //Change Single to Custom BTN
            singleDateBtn()
            {
                this.singleDate = true;
                this.form.week = [];

            },
            customDateBtn()
            {
                this.singleDate = false;
                this.form.date = '';
            },
            // ---------------------

            // ----- ADD  -----
            onSubmit()
            {
                this.form
                    .post('/clientProducts')
                    .then(response => {

                        this.form.week = [];

                        response.forEach(element => this.clientProducts.push(element));
                        this.isShowing  = false;
                        this.form.userId = this.$userId;
                        this.$toaster.success('Successful added');
                    })
            },

            //----- DELETE ------
            deleteClientProduct(id)
            {
                if(this.deleteSelected.length == 0)
                {
                    //SINGLE DELETE
                    if(confirm("Do you really want to delete?"))
                    {
                        axios.post('/clientProducts/' + id, {
                            _method: 'DELETE'
                        })
                        .then(response => {
                            var count = 0
                            this.clientProducts.forEach(element => {
                                element.id == (response.data.id) ? this.clientProducts.splice(count,1) : count +=1;
                            });

                            this.isShowing = false;
                            this.newClientProduct = true;
                            this.form.userId = this.$userId;
                            this.$toaster.success('Successful deleted');
                        });
                    }
                }
                // BULK DELETE
                else
                {
                    //SINGLE DELETE
                    if(confirm("Do you really want to delete all these schedule?"))
                    {
                        axios.post('/clientProductsBulkDelete/', {
                            deleteSelected: this.deleteSelected
                        })
                        .then(response => {
                            response.data.forEach(id => {
                                var count = 0
                                this.clientProducts.forEach(element => {
                                    element.id == (id) ? this.clientProducts.splice(count,1) : count +=1;
                                });
                            });

                            this.isShowing = false;
                            this.newClientProduct = true;
                            this.form.userId = this.$userId;
                            this.$toaster.success('Successful deleted');
                        });
                    }
                }
            },

            editClientProduct(id)
            {
                this.isShowing  = true;          //open new ClientProduct
                this.newClientProduct = false;   //button cancel and edit show
                this.disableCustom = true;      //desable button custom

                let ClientProduct = this.clientProducts.find(element => element.id === id);

                this.cleanFields();                  //clean all fields
                this.singleDate = true;              //Change for single date

                //show values product
                    this.form.id            = ClientProduct.id;
                    this.form.clientId      = ClientProduct.client_id;
                    this.form.productId     = ClientProduct.productId;
                    this.form.userId        = this.$userId;
                    this.form.measurementId = ClientProduct.measurement_id;
                    this.form.quantity      = ClientProduct.quantity;
                    this.form.date          = ClientProduct.date;
                    this.form.time          = ClientProduct.time;
                    this.form.comment       = ClientProduct.comment;
            },
            modifyClientProduct()
            {
                this.form
                    .patch('/clientProducts')
                    .then(response => {
                        var index = this.clientProducts.findIndex(element => element.id === response[0].id);

                        this.clientProducts[index].client_id       = response[0].client_id;
                        this.clientProducts[index].name            = response[0].name;
                        this.clientProducts[index].surname         = response[0].surname;
                        this.clientProducts[index].productId       = response[0].productId;
                        this.clientProducts[index].productName     = response[0].productName;
                        this.clientProducts[index].measurement_id  = response[0].measurement_id;
                        this.clientProducts[index].measurementName = response[0].measurementName;
                        this.clientProducts[index].quantity        = response[0].quantity;
                        this.clientProducts[index].date            = response[0].date;
                        this.clientProducts[index].time            = response[0].time;
                        this.clientProducts[index].comment         = response[0].comment;

                        this.singleDate = true;              //Change for single date
                        this.isShowing  = false;             //open new ClientProduct
                        this.newClientProduct = true;        //button cancel and edit show
                        this.disableCustom = false;          //enable button custom

                        this.form.userId  = this.$userId;
                        this.$toaster.success('Schedule edited.');
                    });
            },

            cancelClientProduct()
            {
                this.cleanFields();                  //clean all fields
                this.isShowing  = false;             //open new ClientProduct
                this.disableCustom = false;
                this.singleDate = true;              //Change for single date
                this.newClientProduct = true;        //button cancel and edit show
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

    /* BLOCK THE BUTTON CUSTOM */
    .block-custom {
        opacity: 0.7;
        cursor: not-allowed;
        pointer-events: none;
    }
    .abble-custom {
        opacity: 1;
        cursor: pointer;
        pointer-events: auto;
    }


</style>
