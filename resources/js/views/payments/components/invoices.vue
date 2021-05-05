<template>
    <div>
        <!-- ---------------------- -->
        <!-- SHOW INVOICES -->
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
                                    <select class="form-control" v-model="form.clientId" name="clientName"  @change="getDates($event)" required>
                                        <option v-for="client in clients" v-bind:key="client.id" :value="client.id">{{client.name + " " + client.surname}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="date">Date</label>
                                    <select class="form-control" v-model="form.date" name="date" required>
                                        <option v-for="paymentDate in paymentDates" v-bind:key="paymentDate.date" :value="paymentDate.date">{{paymentDate.date}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="save" class="btn btn-success"><i class="fas fa-file-invoice-dollar"></i> Generate</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>

                </transition>

            </div>

            <!-- INVOICE -->
            <div class="container" v-show="showInvoice">
                <div class="card">
                    <div class="card-header">
                        Invoice:
                        <strong v-html="this.invoices[0].payment_date"></strong>
                        <span class="float-right"> <strong>Status:</strong> Pending</span>
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
                                                <strong>$7.477,36</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- END ADD NEW PAYMENT -->



    </div>
</template>

<script>
    export default {

        data() {
            return {
                isShowing  : true,
                newPayment : true,
                showInvoice: false,

                clients     : [],
                paymentDates: [],
                invoices    : [
                    {
                        "id"                   : 1,
                        "client_id"            : 1,
                        "client_name"          : "John",
                        "client_surname"       : "Doe",
                        "client_phonenumber"   : 1192201922,
                        "street"               : "Example",
                        "number"               : 303,
                        "city"                 : "Barueri",
                        "state"                : "Sao Paulo",
                        "country"              : "Brasil",
                        "precification_name"   : "Mensalidade",
                        "precification_comment": "Mensalidade da estadia",
                        "payment_value"        : 2000,
                        "payment_date"         : "2021-01-01",
                        "comment"              : "pagamento de Janeiro"
                    }
                ],
                form: new Form({
                    'clientId': '',
                    'date'    : '',
                })
            }

        },


        created()
        {
            // Fetch all clients
            axios.get('/clients').then(response => this.clients = response.data);
        },

        methods: {
            newPaymentToggle()
            {
                this.isShowing = !this.isShowing;
            },
            faChanging(){
                return (this.isShowing == true) ? "fa fa-minus" : "fa fa-plus";
            },

            getDates(event)
            {
                var clientId = event.target.value;

                // Fetch all payment dates
                axios.get('/paymentDates/' + clientId)
                .then(response => this.paymentDates = response.data);
            },

            // SHOW INVOICE
            onSubmit()
            {
                this.form
                    .post('/invoice')
                    .then(response => {
                        console.log(response);
                        // show invoice
                        this.showInvoice = true;
                        this.invoices = response;
                        this.$toaster.success('Successful added');
                    })
            },

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
