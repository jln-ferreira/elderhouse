<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>New Client</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Clients</a></li>
                    <li class="breadcrumb-item active">New Clients</li>
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
                                <h3 class="card-title p-3">Tabs</h3>
                                <ul class="nav nav-pills ml-auto p-2">
                                    <li class="nav-item"><a class="nav-link active" href="#information" data-toggle="tab">Information</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#address" data-toggle="tab">Address</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#family" data-toggle="tab">Family</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#diagnostic" data-toggle="tab">Diagnostic</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">


                                    <!-- INFORMATION TAB -->
                                    <div class="tab-pane active" id="information">
                                        <form class="form-horizontal" @submit.prevent="onSubmit_Information">
                                            <div class="card-body">


                                                <div class="row">
                                                    <!-- PHOTO -->
                                                    <div class="col-md-4 text-center">
                                                        <div class="col-12">
                                                            <img v-if="formInformation.url == null" src="images/shadow.png" class="img-thumbnail">
                                                            <img v-else :src="'/storage/storage/uploads/images_clients/' + formInformation.url" class="img-thumbnail">
                                                        </div>
                                                        <div class="col-12 mt-1">
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="image-client" @change="onFileChange">
                                                                    <label v-if="formInformation.photoName == ''" class="custom-file-label" for="image-client">Choose file</label>
                                                                    <label v-else  class="custom-file-label" for="image-client">{{ formInformation.photoName }}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- [INFORMATIONS] -->
                                                    <div class="col-md-8">


                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label for="name">Name</label>
                                                                <input type="text" class="form-control" v-model="formInformation.name" id="name" name="name" placeholder="Name" required autofocus >
                                                                <span class="invalid-feedback d-block" role="alert" v-if="formInformation.errors.has('name')" v-text="formInformation.errors.get('name')"></span>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="surname">Surname</label>
                                                                <input type="text" class="form-control" v-model="formInformation.surname" id="surname" placeholder="Surname" required>
                                                                <span class="invalid-feedback d-block" role="alert" v-if="formInformation.errors.has('surname')" v-text="formInformation.errors.get('surname')"></span>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="datastart">Datastart</label>
                                                                <input type="date" class="form-control" v-model="formInformation.datastart" id="datastart" placeholder="datastart" required>
                                                                <span class="invalid-feedback d-block" role="alert" v-if="formInformation.errors.has('datastart')" v-text="formInformation.errors.get('datastart')"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label for="databirth">Databirth</label>
                                                                <input type="date" class="form-control" v-model="formInformation.databirth" id="databirth" placeholder="databirth" required>
                                                                <span class="invalid-feedback d-block" role="alert" v-if="formInformation.errors.has('databirth')" v-text="formInformation.errors.get('databirth')"></span>
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label for="phonenumber">Phone Number</label>
                                                                <input type="number" class="form-control" v-model="formInformation.phonenumber" id="phonenumber" placeholder="phonenumber" required>
                                                                <span class="invalid-feedback d-block" role="alert" v-if="formInformation.errors.has('phonenumber')" v-text="formInformation.errors.get('phonenumber')"></span>
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <label for="appartament">Appartament</label>
                                                                <input type="number" class="form-control" v-model="formInformation.appartament" id="appartament" placeholder="appartament" min="1">
                                                                <span class="invalid-feedback d-block" role="alert" v-if="formInformation.errors.has('appartament')" v-text="formInformation.errors.get('appartament')"></span>
                                                            </div>
                                                        </div>

                                                        <hr>

                                                        <!-- ESPECIFICATIONS -->
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label for="CPF">CPF</label>
                                                                <input type="text" class="form-control" v-model="formInformation.CPF" id="CPF" name="CPF" placeholder="421-110-223-27">
                                                                <span class="invalid-feedback d-block" role="alert" v-if="formInformation.errors.has('CPF')" v-text="formInformation.errors.get('CPF')"></span>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="RG">RG</label>
                                                                <input type="text" class="form-control" v-model="formInformation.RG" id="RG" placeholder="42.188.403-3">
                                                                <span class="invalid-feedback d-block" role="alert" v-if="formInformation.errors.has('RG')" v-text="formInformation.errors.get('RG')"></span>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="otherdoc">Other Document</label>
                                                                <input type="text" class="form-control" v-model="formInformation.otherdoc" id="otherdoc">
                                                                <span class="invalid-feedback d-block" role="alert" v-if="formInformation.errors.has('otherdoc')" v-text="formInformation.errors.get('otherdoc')"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-3">
                                                                <label for="gender">Gender</label>
                                                                <select class="form-control" v-model="formInformation.gender" id="gender" name="gender" required>
                                                                    <option :selected="formInformation.gender == 'Male'">Male</option>
                                                                    <option :selected="formInformation.gender == 'Female'">Female</option>
                                                                    <option :selected="formInformation.gender == 'Other'">Other</option>
                                                                </select>
                                                                <span class="invalid-feedback d-block" role="alert" v-if="formInformation.errors.has('gender')" v-text="formInformation.errors.get('gender')"></span>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="height">Height</label>
                                                                <input type="number" class="form-control" v-model="formInformation.height" id="height" name="height" placeholder="height" max="200" min="30">
                                                                <span class="invalid-feedback d-block" role="alert" v-if="formInformation.errors.has('height')" v-text="formInformation.errors.get('height')"></span>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="color">Color</label>
                                                                <select class="form-control" v-model="formInformation.color" id="color" name="color" required>
                                                                    <option :selected="formInformation.color == 'Black'">Black</option>
                                                                    <option :selected="formInformation.color == 'White'">White</option>
                                                                    <option :selected="formInformation.color == 'Pardo'">Pardo</option>
                                                                    <option :selected="formInformation.color == 'Other'">Other</option>
                                                                </select>
                                                                <span class="invalid-feedback d-block" role="alert" v-if="formInformation.errors.has('color')" v-text="formInformation.errors.get('color')"></span>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="religion">Religion</label>
                                                                <select class="form-control" v-model="formInformation.religion" id="religion" name="religion" required>
                                                                    <option :selected="formInformation.religion == 'Christianity'">Christianity</option>
                                                                    <option :selected="formInformation.religion == 'Judaism'">Judaism</option>
                                                                    <option :selected="formInformation.religion == 'Islam'">Islam</option>
                                                                    <option :selected="formInformation.religion == 'Other'">Other</option>
                                                                    <option :selected="formInformation.religion == 'None'">None</option>
                                                                </select>
                                                                <span class="invalid-feedback d-block" role="alert" v-if="formInformation.errors.has('religion')" v-text="formInformation.errors.get('religion')"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-3">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input" v-model="formInformation.available" id="available">
                                                                    <label class="custom-control-label" for="available" :checked="formInformation.available == 1">Available</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-9">
                                                                <label for="ocupation">Ocupation</label>
                                                                <input type="text" class="form-control" v-model="formInformation.ocupation" id="ocupation" name="ocupation" placeholder="Ocupation">
                                                                <span class="invalid-feedback d-block" role="alert" v-if="formInformation.errors.has('ocupation')" v-text="formInformation.errors.get('ocupation')"></span>
                                                            </div>
                                                        </div>
                                                        <!-- END ESPECIFICATIONS -->

                                                        <hr>
                                                        <div class="float-right">
                                                            <button type="edit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Edit</button>
                                                        </div>


                                                    </div>
                                                    <!-- END INFORMATION -->
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                    <!-- END INFORMATION TAB -->


                                    <!-- ---------------[ADD ADDRESS]------------------ -->
                                    <!-- ============================================== -->
                                    <div class="tab-pane" id="address">
                                        <form class="form-horizontal" @submit.prevent="onSubmit_Address">

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="name">Street</label>
                                                    <input type="text" class="form-control" id="street" name="street" autocomplete="street" placeholder="street"  v-model="formAddress.street">
                                                    <span class="invalid-feedback d-block" role="alert" v-if="formAddress.errors.has('street')" v-text="formAddress.errors.get('street')"></span>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="email">Number</label>
                                                    <input type="number" class="form-control" id="number" placeholder="92" min="1" v-model="formAddress.number">
                                                    <span class="invalid-feedback d-block" role="alert" v-if="formAddress.errors.has('number')" v-text="formAddress.errors.get('number')"></span>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="name">City</label>
                                                    <input type="text" class="form-control" id="city" name="city" autocomplete="City" placeholder="City" v-model="formAddress.city">
                                                    <span class="invalid-feedback d-block" role="alert" v-if="formAddress.errors.has('city')" v-text="formAddress.errors.get('city')"></span>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="name">State</label>
                                                    <input type="text" class="form-control" id="state" name="state" autocomplete="State" placeholder="State" v-model="formAddress.state">
                                                    <span class="invalid-feedback d-block" role="alert" v-if="formAddress.errors.has('state')" v-text="formAddress.errors.get('state')"></span>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="name">Country</label>
                                                    <input type="text" class="form-control" id="country" name="country" autocomplete="Country" placeholder="Country" v-model="formAddress.country">
                                                    <span class="invalid-feedback d-block" role="alert" v-if="formAddress.errors.has('country')" v-text="formAddress.errors.get('country')"></span>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="float-right">
                                                <button type="save" class="btn btn-success"><i class="fa fa-plus"></i> Save</button>
                                            </div>
                                            <!-- END ADDRESS -->
                                        </form>
                                    </div>

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

    export default {

        data() {
            return {
                clientId: this.$route.params.id,

                // Information
                formInformation: new Form({

                    //client
                    'clientId'   : '',
                    'name'       : '',
                    'surname'    : '',
                    'datastart'  : '',
                    'photo'      : '',
                    'photoName'  : '',
                    'databirth'  : '',
                    'phonenumber': '',
                    'appartament': '',
                    'url':'',

                    //information
                    'infoId'   : '',
                    'CPF'      : '',
                    'RG'       : '',
                    'otherdoc' : '',
                    'gender'   : '',
                    'height'   : '',
                    'color'    : '',
                    'religion' : '',
                    'available': false,
                    'ocupation': '',
                }),


                // address
                formAddress: new Form({
                    'id'       : '',
                    'client_id': this.$route.params.id,
                    'street'   : '',
                    'number'   : '',
                    'city'     : '',
                    'state'    : '',
                    'country'  : '',
                }),

            }
        },


        created() {
            // Fetch especific CLIENT
            axios.get('/clients/' + this.clientId)
                .then(response => {

                    // //client
                    this.formInformation.clientId    = response.data[0].client_id;
                    this.formInformation.name        = response.data[0].name;
                    this.formInformation.surname     = response.data[0].surname;
                    this.formInformation.datastart   = response.data[0].datastart;
                    this.formInformation.databirth   = response.data[0].databirth;
                    this.formInformation.phonenumber = response.data[0].phonenumber;
                    this.formInformation.appartament = response.data[0].appartament;
                    this.formInformation.url         = response.data[0].url;

                    //information
                    this.formInformation.infoId    = response.data[0].id;
                    this.formInformation.CPF       = response.data[0].CPF;
                    this.formInformation.RG        = response.data[0].RG;
                    this.formInformation.otherdoc  = response.data[0].otherdoc;
                    this.formInformation.gender    = response.data[0].gender;
                    this.formInformation.height    = response.data[0].height;
                    this.formInformation.color     = response.data[0].color;
                    this.formInformation.religion  = response.data[0].religion;
                    this.formInformation.available = response.data[0].available;
                    this.formInformation.ocupation = response.data[0].ocupation;

                });


            // Fetch especific ADDRESS
            axios.get('/address/' + this.clientId)
                .then(response => {

                    // //address
                    this.formAddress.id        = response.data.id;
                    this.formAddress.street    = response.data.street;
                    this.formAddress.number    = response.data.number;
                    this.formAddress.city      = response.data.city;
                    this.formAddress.state     = response.data.state;
                    this.formAddress.country   = response.data.country;

                });
        },


        methods: {


            // --------------------------- [ INFORMATION ] ---------------------------
            // =======================================================================

            // Save information of the photo
            onFileChange(event)
            {
                this.formInformation.photo = event.target.files[0];
                this.formInformation.photoName = event.target.files[0].name;

            },

            // ----- EDIT CLIENT -----
            onSubmit_Information()
            {

                // PHOTO
                const data = new FormData();
                data.append('photo', this.formInformation.photo);
                data.append('description', this.formInformation.photoName);

                axios.post("/photoClient", data)
                .then(response =>{
                    this.formInformation.url = response.data

                    // EDIT USER
                    this.formInformation
                    .patch('/clients')
                    .then(response => {

                        //client
                        this.formInformation.clientId    = response.client.id;
                        this.formInformation.name        = response.client.name;
                        this.formInformation.surname     = response.client.surname;
                        this.formInformation.datastart   = response.client.datastart;
                        this.formInformation.photoName   = response.client.photoName;
                        this.formInformation.databirth   = response.client.databirth;
                        this.formInformation.phonenumber = response.client.phonenumber;
                        this.formInformation.appartament = response.client.appartament;
                        this.formInformation.url         = response.client.url;

                        //information
                        this.formInformation.infoId    = response.specification.id;
                        this.formInformation.CPF       = response.specification.CPF;
                        this.formInformation.RG        = response.specification.RG;
                        this.formInformation.otherdoc  = response.specification.otherdoc;
                        this.formInformation.gender    = response.specification.gender;
                        this.formInformation.height    = response.specification.height;
                        this.formInformation.color     = response.specification.color;
                        this.formInformation.religion  = response.specification.religion;
                        this.formInformation.available = response.specification.available;
                        this.formInformation.ocupation = response.specification.ocupation;

                        this.$toaster.success(this.formInformation.name + ' successful edited.');
                    });

                })
                .catch(error => console.log(error));

            },


            // --------------------------- [ ADDRESS ] ---------------------------
            // ===================================================================

            // ----- ADD ADDRESS -----
            onSubmit_Address()
            {
                this.formAddress
                    .patch('/clientAddress')
                    .then(response => {

                        //address
                        this.formAddress.id        = response.id;
                        this.formAddress.client_id = response.client_id;
                        this.formAddress.street    = response.street;
                        this.formAddress.number    = response.number;
                        this.formAddress.city      = response.city;
                        this.formAddress.state     = response.state;
                        this.formAddress.country   = response.country;

                        this.$toaster.success('Address added.');
                    })
            },
            // END NEW ADDRESS


        }
    }

</script>
