<template>
    <div>
        <!-- ---------------------- -->
        <!-- ADD NEW MEASUREMENT -->
        <!-- ---------------------- -->
        <div class="col-lg-12">

            <div class="card card-dark" style="cursor:pointer;">
                <div class="card-header" @click="newMeasurementToggle">
                    <h3 class="card-title font-weight-bold">New Measurement Form</h3> <i :class="[faChanging(), 'float-right']" aria-hidden="true"></i>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <transition name="block">

                    <form class="form-horizontal" @submit.prevent="onSubmit" @keydown="form.errors.clear()" v-show="isShowing">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required placeholder="Kilogramas" v-model="form.name">
                                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="measurement">Measurement</label>
                                    <input type="text" class="form-control" id="measurement" name="measurement" required placeholder="kg" v-model="form.measurement">
                                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('measurement')" v-text="form.errors.get('measurement')"></span>
                                </div>
                                 <div class="form-group col-md-6">
                                    <label for="name">Comments</label>
                                    <input type="text" class="form-control" id="comment" name="comment" v-model="form.comment">
                                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('comment')" v-text="form.errors.get('comment')"></span>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="save" v-show="this.newMeasurement" class="btn btn-success"><i class="fa fa-plus"></i> Save</button>
                            <a type="edit" v-show="!this.newMeasurement" class="btn btn-primary text-white" @click="modifyDiagnostic"><i class="far fa-edit"></i> Edit</a>
                            <a type="cancel" v-show="!this.newMeasurement" class="btn btn-warning text-white" @click="cancelEdit"><i class="fa fa-times"></i> Cancel</a>
                        </div>
                        <!-- /.card-footer -->
                    </form>

                </transition>
            </div>

        </div>
        <!-- END ADD NEW measurement -->


        <!-- ---------------------- -->
        <!-- LIST MEASUREMENT -->
        <!-- ---------------------- -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">List Measurement</h3>

                    <div class="card-tools">
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
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <!-- TABLE BOOTSTRAP VUE -->
                    <b-table striped hover :items="this.measurements" :fields="fields" :filter="filter">
                        <template #cell(actions)="data">
                            <button type="edit" class="btn btn-primary" @click="editMeasurement(data.item.id)"><i class="far fa-edit"></i></button>
                            <a type="delete" class="btn btn-danger text-white" @click="deleteMeasurement(data.item.id)"><i class="far fa-trash-alt"></i></a>
                        </template>
                    </b-table>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- END LIST Measurement -->
    </div>
</template>

<script>

    export default {

        data() {

            return {
                isShowing: false,
                newMeasurement: true,

                // DATATABLE
                filter:'',
                fields: [
                    {key: 'id', sortable: true},
                    {key: 'name', sortable: true},
                    {key: 'measurement', sortable: true},
                    {key: 'comment', sortable: false},
                    {key: 'actions', label: 'Actions' }
                ],
                //---------------

                measurements: [],
                form: new Form({
                    'id'         : '',
                    'name'       : '',
                    'measurement': '',
                    'comment'    : '',
                })
            }

        },


        created()
        {
            // Fetch all measurements
            axios.get('/measurements')
                .then(response => this.measurements = response.data);

        },

        methods: {
            newMeasurementToggle()
            {
                this.isShowing = !this.isShowing;
            },
            faChanging(){
                return (this.isShowing == true) ? "fa fa-minus" : "fa fa-plus";
            },


            // ----- ADD  -----
            onSubmit()
            {
                this.form
                    .post('/measurements')
                    .then(response => {
                        this.measurements.push(response);
                        this.isShowing = false;
                        this.$toaster.success('Successful added ' + response.name);
                    })
            },


            // -----DELETE-----
            deleteMeasurement(id)
            {
                axios.post('/measurements/' + id, {
                _method: 'DELETE'
                })
                .then(response => {
                    var count = 0
                    this.measurements.forEach(element => {
                        element.id == (response.data.id) ? this.measurements.splice(count,1) : count +=1;
                    });

                    this.isShowing = false;
                    this.newMeasurement = true;
                    this.$toaster.success('Successful deleted ' + response.data.name);
                });
            },



            // -----EDIT-----
            editMeasurement(id)
            {
                this.isShowing = true;                    //open new measurement
                this.newMeasurement = false;              //button cancel and edit show

                var measurement = this.measurements.find(element => element.id === id);

                //show values measurement
                this.form.id          = measurement.id;
                this.form.name        = measurement.name;
                this.form.measurement = measurement.measurement;
                this.form.comment     = measurement.comment;

            },


            //-------- MODIFY --------
            modifyDiagnostic()
            {
               this.form
                    .patch('/measurements')
                    .then(response => {
                        this.measurements.find(measurement => measurement.id == response.id).name = response.name;
                        this.measurements.find(measurement => measurement.id == response.id).measurement = response.measurement;
                        this.measurements.find(measurement => measurement.id == response.id).comment = response.comment;
                        this.isShowing = false;
                        this.newMeasurement   = true;
                        this.$toaster.success('Successful Updated ' + response.name);
                    });
            },


            cancelEdit()
            {
                this.newMeasurement = true; //show button add diagnostic
                this.isShowing = false;

                // clean form
                this.form.id          = '';
                this.form.name        = '';
                this.form.measurement = '';
                this.form.comment     = '';
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
