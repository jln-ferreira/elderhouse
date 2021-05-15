<template>
    <div>
        <!-- ---------------------- -->
        <!-- SHOW ITEMS -->
        <!-- ---------------------- -->
        <div class="col-lg-12">
            <transition name="block">

                <div class="card" v-show="invoiceShow">
                    <div class="card-header">
                        Invoice:
                        <strong v-html="fixMonthYear(this.invoiceSelected.invoice_date)"></strong>
                        <span class="float-right" style="cursor: pointer;" @click="invoiceShow = false"><i class="fas fa-window-close"></i></span>
                    </div>
                    <div id="showInvoice" class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <h6 class="mb-3">De:</h6>
                                <div>
                                    <strong>Vivenda Quinta das Flores</strong>
                                </div>
                                <div>R. Luis Antonio Rodrigues, 816</div>
                                <div>Suru, Santana de Parnaíba - SP</div>
                                <div>Email: atendimento@vivendaquintadasflores.com.br</div>
                                <div>Phone: +55 11 4154-4273</div>
                            </div>
                            <div class="col-sm-6 text-right">
                                <h6 class="mb-3">Para:</h6>
                                <div>
                                    <strong>{{ this.invoiceSelected.client_name }}</strong>
                                </div>
                                <div>{{ this.invoiceSelected.street + ', ' + this.invoiceSelected.number }}</div>
                                <div>{{ this.invoiceSelected.city + ' - ' + this.invoiceSelected.state }}</div>
                                <div>Phone: {{ this.invoiceSelected.client_phonenumber }}</div>
                            </div>
                        </div>
                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th>Payment Id</th>
                                        <th>Item</th>
                                        <th class="right">Description</th>
                                        <th class="center">Date</th>
                                        <th class="right">Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(payment, index) in this.invoiceSelected.payments" v-bind:key="payment.id">
                                        <td class="center">{{ index + 1 }}</td>
                                        <td class="center">{{ payment.payment_id }}</td>
                                        <td class="left strong">{{ payment.precification_name }}</td>
                                        <td class="right">{{ payment.precification_comment }}</td>
                                        <td class="center">{{ payment.payment_date }}</td>
                                        <td class="right">${{ payment.payment_value }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5">
                            </div>
                            <div class="col-lg-4 col-sm-5 ml-auto">
                                <table class="table table-clear">
                                    <tbody>
                                        <tr class="text-right">
                                            <td class="left">
                                                <strong>Total</strong>
                                            </td>
                                            <td class="right">
                                                <strong>${{ this.invoiceSelected.invoice_value }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-6 text-left">
                                <button class="btn btn-sm btn-info" @click="printInvoice"> <i class="fa fa-print"></i> Print</button>
                            </div>
                            <div class="col-6 text-right">
                                <button class="btn btn-danger" @click="deleteInvoice(invoiceSelected.id)"><i class="fas fa-trash"></i> Delete Invoice</button>
                            </div>
                        </div>
                    </div>
                </div>

            </transition>
        </div>
        <!-- END SHOW ITEMS -->


        <!-- ---------------------- -->
        <!------- LIST INVOICE ------->
        <!-- ---------------------- -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">List Invoices</h3>

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
                    <b-table striped hover :items="updatePayments" :fields="fields" :filter="filter">
                        <template #cell(name)="data">
                            <b>{{ data.item.client_name + " " +  data.item.client_surname }}</b>
                        </template>
                        <template #cell(actions)="data">
                            <a type="delete" class="btn btn-primary text-white" @click="showInvoice(data.item.id)"><i class="fas fa-eye"></i></a>
                        </template>
                    </b-table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- END LIST INVOICE -->
    </div>
</template>

<script>

    export default {
        props:{
            invoiceUp: "", //after paid the invoice
        },
        data() {
            return {
                invoiceShow: false,
                invoices: [],
                invoiceSelected: {
                    id: '',
                    payment_date: '',
                    client_name: '',
                    street: '',
                    number: '',
                    city: '',
                    state: '',
                    client_phonenumber: '',
                    invoice_date: '',
                    invoice_value: '',
                    payDate: '',
                    payments: [
                        {
                            payment_id: '',
                            comment: '',
                            payment_date: '',
                            payment_value: '',
                            precification_comment: '',
                            precification_name: '',
                        }
                    ]

                },

                // DATATABLE
                filter:'',
                fields: [
                    {key: 'id', sortable: true},
                    {key: 'name', label: 'Name', sortable: true},
                    {key: 'date', label: 'Date', sortable: true},
                    {key: 'value',label: 'Value', sortable: true},
                    {key: 'payDate', label: 'Paid Date', sortable: true},
                    {key: 'actions', label: 'Actions' }
                ],
                //---------------
            }

        },

        created()
        {
            // Fetch all payments
            axios.get('/invoices').then(response => this.invoices = response.data);

        },
        computed:{
            updatePayments(){
                //CREATE
                //WHEN CREATE THE INVOICE, THIS PAGE MUST KNOW TO CHANGE THE PAYMENT STATUS
                if(this.invoiceUp != '')
                {
                    this.invoices.push(this.invoiceUp);
                    this.$emit('invoice-added', '')
                }
                return this.invoices;
            }
        },

        methods: {
            showInvoice(id)
            {
                axios.get('/invoice/' + id).then(response => {
                    this.invoiceSelected = response.data;
                    this.invoiceShow = true;
                });
            },

            // print invoice and only the invoice
            printInvoice()
            {
                var printwin = window.open("");
                printwin.document.write(document.getElementById("showInvoice").innerHTML);
                printwin.stop();
                printwin.print();
                printwin.close();
            },

            //delete invoice
            deleteInvoice(id)
            {
                if(confirm("Do you really want to delete?"))
                {
                    axios.post('/invoices/' + id, {
                    _method: 'DELETE'
                }).then(response => {
                        //close invoice
                        this.invoiceShow = false;

                        //remove invoice from list
                        var count = 0
                        this.invoices.forEach(element => {
                            element.id == (response.data.id) ? this.invoices.splice(count,1) : count +=1;
                        });
                        //send payment to parents
                        this.$emit('delete-payment', response.data)
                        this.$toaster.success('Successful deleted');
                    });
                }
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
