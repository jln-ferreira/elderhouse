<template>
  <div>
<!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Settings</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Settings</li>
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
                            <!-- <h3 class="card-title p-3" v-text="formInformation.name"></h3> -->
                            <ul class="nav nav-pills ml-auto p-2">
                                <li class="nav-item"><a class="nav-link active" href="#roles" data-toggle="tab">Roles</a></li>
                                <li class="nav-item"><a class="nav-link" href="#diagnostics" data-toggle="tab">Diagnostics</a></li>
                                <li class="nav-item"><a class="nav-link" href="#measurements" data-toggle="tab">Measurements</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">


                                <!-- --------=========== [ ROLES ] ===========-------- -->
                                <!-- --------------------------------------------------- -->
                                <div class="tab-pane active" id="roles">

                                    <roles/>

                                </div>
                                <!-- END ROLES -->

                                <!-- ------=========== [ DIAGNOSTICS ] ===========------- -->
                                <!-- --------------------------------------------------- -->
                                <div class="tab-pane" id="diagnostics">

                                    <diagnostics/>

                                </div>
                                <!-- END ROLES -->


                                <!-- ------=========== [ MEASUREMENTS ] ===========------- -->
                                <!-- --------------------------------------------------- -->
                                <div class="tab-pane" id="measurements">

                                    <measurements/>

                                </div>
                                <!-- END ROLES -->


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
import roles from './components/roles.vue'
import Diagnostics from './components/diagnostics.vue'
import Measurements from './components/measurements.vue'

export default {
    components: {
        roles,
        Diagnostics,
        Measurements
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
