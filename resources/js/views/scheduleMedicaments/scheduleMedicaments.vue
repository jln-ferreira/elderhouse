<template>
  <div>
<!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-calendar-alt"></i> Schedule Medicaments</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">ScheduleMedicaments</li>
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
                                <li class="nav-item"><a class="nav-link active" href="#index" data-toggle="tab"><i class="fas fa-calendar-alt"></i> Schedules</a></li>
                                <li class="nav-item"><a class="nav-link" href="#create" data-toggle="tab"><i class="far fa-edit"></i> Create Schedule</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">


                                <!-- ---========== [ SCHEDULE SHOW ] ==========--- -->
                                <!-- ---------------------------------------------------- -->
                                <div class="tab-pane active" id="index">

                                    <index />

                                </div>
                                <!-- END SCHEDULE SHOW -->


                                 <!-- ---========== [ SCHEDULE MEDICAMENTS ] ==========--- -->
                                <!-- ---------------------------------------------------- -->
                                <div class="tab-pane active" id="create">

                                    <create />

                                </div>
                                <!-- END SCHEDULE MEDICAMENTS -->


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
import create from './components/create.vue'

export default {
    components: {
        index,
        create,
    },
    data(){
        return{

        }
    },
    methods:{

    },
}
</script>

<style scoped>



</style>
