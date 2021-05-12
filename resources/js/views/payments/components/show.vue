<template>
    <div>
        <!-- ---------------------- -->
        <!-- SHOW ITEMS -->
        <!-- ---------------------- -->
        <div class="col-lg-12">
            <transition name="block">

                <!-- <div class="card">
                    <div class="card-header">
                        Invoice:
                        <strong v-html="fixMonthYear(this.invoices[0].payment_date)"></strong>
                        <span class="float-right"> <strong>Status:</strong> <span :class="['badge', this.invoices[0].invoice_id ? 'badge-success' : 'badge-warning' ]" style="font-size: 1em;">{{ this.invoices[0].invoice_id ? 'Paid' : 'Pending' }}</span></span>
                    </div>
                    <div class="card-body">
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
                                    <strong>{{ this.invoices[0].client_name + ' ' + this.invoices[0].client_surname }}</strong>
                                </div>
                                <div>{{ this.invoices[0].street + ', ' + this.invoices[0].number }}</div>
                                <div>{{ this.invoices[0].city + ' - ' + this.invoices[0].state }}</div>
                                <div>Phone: {{ this.invoices[0].client_phonenumber }}</div>
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
                                    <tr v-for="(invoice, index) in this.invoices" v-bind:key="invoice.id">
                                        <td class="center">{{ index + 1 }}</td>
                                        <td class="center">{{ invoice.id }}</td>
                                        <td class="left strong">{{ invoice.precification_name }}</td>
                                        <td class="right">{{ invoice.precification_comment }}</td>
                                        <td class="center">{{ invoice.payment_date }}</td>
                                        <td class="right">${{ invoice.payment_value }}</td>
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
                                                <strong>${{ sumValue }}</strong>
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
                                <button class="btn btn-primary" @click="executePayment" v-show="!this.invoices[0].invoice_id"><i class="fas fa-dollar-sign"></i> Execute Payment</button>
                            </div>
                        </div>
                    </div>
                </div> -->

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
                    <b-table striped hover :items="this.invoices" :fields="fields" :filter="filter">
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
        data() {
            return {
                invoices: [],

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
            axios.get('/invoices').then(response => {this.invoices = response.data
            console.log(response)});

        },

        methods: {
            showInvoice(id)
            {
                console.log(id);
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
