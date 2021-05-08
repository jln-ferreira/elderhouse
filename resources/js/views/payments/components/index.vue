<template>
    <div>
        <!-- ---------------------- -->
        <!-- ADD NEW PAYMENTS -->
        <!-- ---------------------- -->
        <div class="col-lg-12">

            <div class="card card-dark" style="cursor:pointer;">
                <div class="card-header" @click="newPaymentToggle">
                    <h3 class="card-title font-weight-bold">New Payment Form</h3> <i :class="[faChanging(), 'float-right']" aria-hidden="true"></i>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <transition name="block">

                    <form class="form-horizontal" @submit.prevent="onSubmit" @keydown="form.errors.clear()" v-show="isShowing">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="clientName">Client Name</label>
                                    <select class="form-control" v-model="form.clientId" id="clientName" name="clientName" required>
                                        <option v-for="client in clients" v-bind:key="client.id" :value="client.id">{{client.name + " " + client.surname}}</option>
                                    </select>
                                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('clientName')" v-text="form.errors.get('clientName')"></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="precification">Product</label>
                                    <select class="form-control" v-model="form.precificationId" id="precification" name="precification" @change="onChange($event)" required>
                                        <option v-for="precification in precifications" v-bind:key="precification.id" :price="precification.price" :value="precification.id">{{precification.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="value">Value</label>
                                    <input type="number" class="form-control" id="value" name="value" placeholder="2050,40" min="1" v-model="form.value" required>
                                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('value')" v-text="form.errors.get('value')"></span>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control" name="date" v-model="form.date" required>
                                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('date')" v-text="form.errors.get('date')"></span>
                                </div>
                            </div>
                            <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="name">Comment</label>
                                    <input type="text" class="form-control" id="comment" name="comment" v-model="form.comment">
                                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('comment')" v-text="form.errors.get('comment')"></span>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="save" v-show="this.newPayment" class="btn btn-success"><i class="fa fa-plus"></i> Save</button>
                            <a type="edit" v-show="!this.newPayment" class="btn btn-primary text-white" @click="modifyPayment"><i class="far fa-edit"></i> Edit</a>
                            <a type="cancel" v-show="!this.newPayment" class="btn btn-warning text-white" @click="cancelEdit"><i class="fa fa-times"></i> Cancel</a>
                        </div>
                        <!-- /.card-footer -->
                    </form>

                </transition>
            </div>

        </div>
        <!-- END ADD NEW PAYMENT -->


        <!-- ---------------------- -->
        <!------- LIST PAYMENT ------->
        <!-- ---------------------- -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">List Precification</h3>

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
                    <b-table striped hover :items="payments" :fields="fields" :filter="filter">
                        <template #cell(clientName)="data">
                            <b>{{ data.item.clientName + " " + data.item.clientSurname }}</b>
                        </template>
                        <template #cell(invoice_id)="data">
                            <b><span :class="['badge', data.item.invoice_id ? 'badge-success' : 'badge-warning' ]" style="font-size: 1em;">{{ data.item.invoice_id ? 'Paid' : 'Pending' }}</span></b>
                        </template>
                        <template #cell(actions)="data">
                            <button type="edit" class="btn btn-primary" @click="editPayment(data.item.id)"><i class="far fa-edit"></i></button>
                            <a type="delete" class="btn btn-danger text-white" @click="deletePayment(data.item.id)"><i class="far fa-trash-alt"></i></a>
                        </template>
                    </b-table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- END LIST PAYMENT -->
    </div>
</template>

<script>

    export default {

        data() {

            return {
                isShowing: false,
                newPayment: true,

                // DATATABLE
                filter:'',
                fields: [
                    {key: 'id', sortable: true},
                    {key: 'clientName', label: 'Name', sortable: true},
                    {key: 'precificationName', label: 'Product', sortable: true},
                    {key: 'value', sortable: true},
                    {key: 'date', sortable: true},
                    {key: 'comment', sortable: false},
                    {key: 'invoice_id', label: 'Situation', sortable: true},
                    {key: 'actions', label: 'Actions' }
                ],
                //---------------

                precifications: [],
                clients       : [],
                payments      : [],
                form: new Form({
                    'id'                : '',
                    'clientId'          : '',
                    'precificationId'   : '',
                    'value'             : '',
                    'date'              : '',
                    'comment'           : '',
                })
            }

        },


        created()
        {
            // Fetch all payments
            axios.get('/payments')
                .then(response => this.payments = response.data);
            // Fetch all precification
            axios.get('/precifications')
                .then(response => this.precifications = response.data);
            // Fetch all clients
            axios.get('/clients')
                .then(response => this.clients = response.data);

        },

        methods: {
            newPaymentToggle()
            {
                this.isShowing = !this.isShowing;
            },
            faChanging(){
                return (this.isShowing == true) ? "fa fa-minus" : "fa fa-plus";
            },

            onChange(event) {
                var options = event.target.options
                if (options.selectedIndex > -1) this.form.value = options[options.selectedIndex].getAttribute('price');
            },

            // ----- ADD  -----
            onSubmit()
            {
                this.form
                    .post('/payments')
                    .then(response => {
                        this.payments.push(response[0]);
                        this.isShowing = false;
                        this.$toaster.success('Successful added');
                    })
            },


            // -----DELETE-----
            deletePayment(id)
            {
                axios.post('/payments/' + id, {
                _method: 'DELETE'
                })
                .then(response => {
                    var count = 0
                    this.payments.forEach(element => {
                        element.id == (response.data.id) ? this.payments.splice(count,1) : count +=1;
                    });

                    this.isShowing = false;
                    this.newPayment = true;
                    this.$toaster.success('Successful deleted');
                });
            },



            // -----EDIT-----
            editPayment(id)
            {
                this.isShowing = true;                //open new payments
                this.newPayment = false;              //button cancel and edit show

                let payments = this.payments.find(element => element.id === id);

                //show values payments
                this.form.id               = payments.id;
                this.form.clientId         = payments.clientId;
                this.form.precificationId  = payments.precificationId;
                this.form.value            = payments.value;
                this.form.date             = payments.date;
                this.form.comment          = payments.comment;
            },


            //-------- MODIFY --------
            modifyPayment()
            {
                this.form
                    .patch('/payments')
                    .then(response => {

                        var index = this.payments.findIndex(x => x.id === response.id);

                        this.payments[index].clientId             = response.client_id;
                        this.payments[index].precificationId = response.precification_id;
                        this.payments[index].value          = response.value;
                        this.payments[index].date       = response.date;
                        this.payments[index].comment       = response.comment;

                        this.newPayment = true;
                        this.isShowing = false;

                        this.$toaster.success('Product edited.');
                    });
            },


            cancelEdit()
            {
                this.newPayment = true; //show button add precifications
                this.isShowing = false;

                // clean form
                this.form.id      = '';
                this.form.name    = '';
                this.form.price   = '';
                this.form.comment = '';
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

</style>
