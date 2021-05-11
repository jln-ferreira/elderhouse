<template>
  <div>
<!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="far fa-credit-card"></i> Payment</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Payment</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>

        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <!-- Custom Tabs -->
                    <div class="card">
                        <div class="card-header d-flex p-0">
                            <ul class="nav nav-pills ml-auto p-2">
                                <li class="nav-item"><a class="nav-link active" href="#payments" data-toggle="tab"><i class="fas fa-coins"></i> Payments</a></li>
                                <li class="nav-item"><a class="nav-link" href="#invoices" data-toggle="tab"><i class="fas fa-file-invoice-dollar"></i> invoices</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">


                                <!-- --------=========== [ PAYMENTS ] ===========-------- -->
                                <!-- --------------------------------------------------- -->
                                <div class="tab-pane active" id="payments">

                                    <index :invoiceUp='invoiceUp' />

                                </div>
                                <!-- END PAYMENTS -->


                                <!-- --------=========== [ INVOICES ] ===========-------- -->
                                <!-- --------------------------------------------------- -->
                                <div class="tab-pane" id="invoices">

                                    <invoices  @update-payment="updatePayment"/>

                                </div>
                                <!-- END INVOICES -->


                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- ./card -->
                </div>
            <!-- /.col -->
            </div>

        </div>

    </div>
</template>

<script>

// imports
import index from './components/index.vue'
import invoices from './components/invoices.vue'

export default {
    components: {
        index,
        invoices
    },
    data(){
        return{
            invoiceUp: '',
        }
    },
    methods:{
        updatePayment(e) {
            // console.log(e);
            this.invoiceUp = e;
        },
    },
}
</script>

<style scoped>



</style>
