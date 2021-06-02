<template>
  <div>
<!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-tablets"></i> Medicates</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Medicates</li>
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
                                <li class="nav-item"><a class="nav-link active" href="#payments" data-toggle="tab"><i class="fas fa-tablets"></i> Medication Schedule</a></li>
                                <li class="nav-item"><a class="nav-link" href="#medicates" data-toggle="tab"><i class="fas fa-hand-holding-medical"></i> Medicates</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">


                                <!-- --------=========== [ INDEX ] ===========-------- -->
                                <!-- --------------------------------------------------- -->
                                <div class="tab-pane active" id="payments">

                                    <checkMedicates />

                                </div>
                                <!-- END CHECK MEDICATES -->


                                <!-- --------=========== [ MEDICATES ] ===========-------- -->
                                <!-- --------------------------------------------------- -->
                                <div class="tab-pane" id="medicates">

                                    <medicates />

                                </div>
                                <!-- END MEDICATES -->


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
    import checkMedicates from './components/index'
    import medicates from './components/show'


    export default {
        components: {
            checkMedicates,
            medicates,
        },

        data() {

            return {
            }
        }
    }
</script>


