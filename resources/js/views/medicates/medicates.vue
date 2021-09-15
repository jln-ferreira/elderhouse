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
                                <li class="nav-item"><a class="nav-link active" href="#medicateSchedule" data-toggle="tab"><i class="fas fa-tablets"></i> Medication Schedule</a></li>
                                <li class="nav-item"><a class="nav-link" href="#medicates" data-toggle="tab"><i class="fas fa-hand-holding-medical"></i> Medicates</a></li>
                                <li class="nav-item"><a class="nav-link" href="#rebates" data-toggle="tab"><i class="fab fa-affiliatetheme"></i> Rebates</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">


                                <!-- --------=========== [ INDEX ] ===========-------- -->
                                <!-- --------------------------------------------------- -->
                                <div class="tab-pane active" id="medicateSchedule">

                                    <checkMedicates @new-Medicate="newMedicate"/>

                                </div>
                                <!-- END CHECK MEDICATES -->


                                <!-- --------=========== [ SHOW MEDICATES ] ===========-------- -->
                                <!-- --------------------------------------------------- -->
                                <div class="tab-pane" id="medicates">

                                    <medicates :madicateUp='madicateUp' />

                                </div>
                                <!-- END MEDICATES -->


                                <!-- --------=========== [ SHOW REBATES ] ===========-------- -->
                                <!-- --------------------------------------------------- -->
                                <div class="tab-pane" id="rebates">

                                    <rebates />

                                </div>
                                <!-- END REBATES -->


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
    import medicates from './components/showMedicates'
    import rebates from './components/showRebates'


    export default {
        components: {
            checkMedicates,
            medicates,
            rebates,
        },

        data(){
            return{
                madicateUp : '',
            }
        },
        methods:{
            newMedicate(e){
            this.madicateUp = e
            console.log('medicate', e);
            },
        },
    }
</script>


