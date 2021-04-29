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
                                    <select class="form-control" v-model="form.date" id="date" name="date" required>
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
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        Invoice
                        <strong>01/01/01/2018</strong>
                        <span class="float-right"> <strong>Status:</strong> Pending</span>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <h6 class="mb-3">From:</h6>
                                <div>
                                    <strong>Webz Poland</strong>
                                </div>
                                <div>Madalinskiego 8</div>
                                <div>71-101 Szczecin, Poland</div>
                                <div>Email: info@webz.com.pl</div>
                                <div>Phone: +48 444 666 3333</div>
                            </div>
                            <div class="col-sm-6">
                                <h6 class="mb-3">To:</h6>
                                <div>
                                    <strong>Bob Mart</strong>
                                </div>
                                <div>Attn: Daniel Marek</div>
                                <div>43-190 Mikolow, Poland</div>
                                <div>Email: marek@daniel.com</div>
                                <div>Phone: +48 123 456 789</div>
                            </div>
                        </div>
                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th>Item</th>
                                        <th>Description</th>
                                        <th class="right">Unit Cost</th>
                                        <th class="center">Qty</th>
                                        <th class="right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="center">1</td>
                                        <td class="left strong">Origin License</td>
                                        <td class="left">Extended License</td>
                                        <td class="right">$999,00</td>
                                        <td class="center">1</td>
                                        <td class="right">$999,00</td>
                                    </tr>
                                    <tr>
                                        <td class="center">2</td>
                                        <td class="left">Custom Services</td>
                                        <td class="left">Instalation and Customization (cost per hour)</td>
                                        <td class="right">$150,00</td>
                                        <td class="center">20</td>
                                        <td class="right">$3.000,00</td>
                                    </tr>
                                    <tr>
                                        <td class="center">3</td>
                                        <td class="left">Hosting</td>
                                        <td class="left">1 year subcription</td>
                                        <td class="right">$499,00</td>
                                        <td class="center">1</td>
                                        <td class="right">$499,00</td>
                                    </tr>
                                    <tr>
                                        <td class="center">4</td>
                                        <td class="left">Platinum Support</td>
                                        <td class="left">1 year subcription 24/7</td>
                                        <td class="right">$3.999,00</td>
                                        <td class="center">1</td>
                                        <td class="right">$3.999,00</td>
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
                                        <tr>
                                            <td class="left">
                                                <strong>Subtotal</strong>
                                            </td>
                                            <td class="right">$8.497,00</td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong>Discount (20%)</strong>
                                            </td>
                                            <td class="right">$1,699,40</td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong>VAT (10%)</strong>
                                            </td>
                                            <td class="right">$679,76</td>
                                        </tr>
                                        <tr>
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
                isShowing: true,
                newPayment: true,

                clients     : [],
                paymentDates: [],
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
                    .post('/payments')
                    .then(response => {
                        this.payments.push(response[0]);
                        this.isShowing = false;
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
