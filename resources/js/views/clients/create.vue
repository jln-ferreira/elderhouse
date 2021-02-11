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
                                    <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Tab 3</a></li>
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
                                                            <img :src="'images/shadow.png'" class="img-thumbnail" alt="">
                                                        </div>
                                                        <div class="col-12 mt-1">
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="exampleInputFile" @change="onFileChange">
                                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- INFORMATIONS -->
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
                                                                <input type="text" class="form-control" v-model="formInformation.phonenumber" id="phonenumber" placeholder="phonenumber" required>
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
                                                                    <option>Male</option>
                                                                    <option>Female</option>
                                                                    <option>Other</option>
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
                                                                    <option>Black</option>
                                                                    <option>White</option>
                                                                    <option>Pardo</option>
                                                                    <option>Other</option>
                                                                </select>
                                                                <span class="invalid-feedback d-block" role="alert" v-if="formInformation.errors.has('color')" v-text="formInformation.errors.get('color')"></span>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="religion">Religion</label>
                                                                <select class="form-control" v-model="formInformation.religion" id="religion" name="religion" required>
                                                                    <option>Christianity</option>
                                                                    <option>Judaism</option>
                                                                    <option>Islam</option>
                                                                    <option>Other</option>
                                                                    <option>None</option>
                                                                </select>
                                                                <span class="invalid-feedback d-block" role="alert" v-if="formInformation.errors.has('religion')" v-text="formInformation.errors.get('religion')"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-3">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input" v-model="formInformation.available" id="available">
                                                                    <label class="custom-control-label" for="available">Available</label>
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
                                                            <button type="save" v-show="information_save" class="btn btn-success"><i class="fa fa-plus"></i> Save</button>
                                                            <button type="edit" v-show="!information_save" class="btn btn-primary"><i class="fas fa-user-edit"></i> Edit</button>
                                                            <a type="cancel" @click="gotoClient" class="btn btn-warning text-white"><i class="fa fa-times"></i> Cancel</a>
                                                        </div>


                                                    </div>
                                                    <!-- END INFORMATION -->

                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                    <!-- END INFORMATION TAB -->



                                    <div class="tab-pane" id="address">
                                        <!-- ADDRESS -->
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="name">Street</label>
                                                <input type="text" class="form-control" id="street" name="street" autocomplete="street" autofocus placeholder="street">
                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="formInformation.errors.has('street')" v-text="formInformation.errors.get('street')"></span> -->
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="email">Number</label>
                                                <input type="text" class="form-control" id="number" placeholder="92">
                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="formInformation.errors.has('number')" v-text="formInformation.errors.get('number')"></span> -->
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="name">City</label>
                                                <input type="text" class="form-control" id="city" name="city" autocomplete="City" autofocus placeholder="City">
                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="formInformation.errors.has('city')" v-text="formInformation.errors.get('city')"></span> -->
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="name">State</label>
                                                <input type="text" class="form-control" id="state" name="state" autocomplete="State" autofocus placeholder="State">
                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="formInformation.errors.has('state')" v-text="formInformation.errors.get('state')"></span> -->
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="name">Country</label>
                                                <input type="text" class="form-control" id="country" name="country" autocomplete="Country" autofocus placeholder="Country">
                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="formInformation.errors.has('country')" v-text="formInformation.errors.get('country')"></span> -->
                                            </div>
                                        </div>
                                        <!-- END ADDRESS -->
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_3">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                        when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                        It has survived not only five centuries, but also the leap into electronic typesetting,
                                        remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                                        sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                                        like Aldus PageMaker including versions of Lorem Ipsum.
                                    </div>
                                    <!-- /.tab-pane -->
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
                information_save: true,

                // Information
                formInformation: new Form({

                    //client
                    'id':'',
                    'name': '',
                    'surname': '',
                    'datastart': '',
                    'photo': '',
                    'photoName': '',
                    'databirth': '',
                    'phonenumber': '',
                    'appartament': '',

                    //information
                    'CPF': '',
                    'RG': '',
                    'otherdoc': '',
                    'gender': '',
                    'height': '',
                    'color': '',
                    'religion': '',
                    'available': false,
                    'ocupation': '',
                })
            }

        },


        created() {



        },


        methods: {

            // Save information of the photo
            onFileChange(event)
            {
                this.formInformation.photo = event.target.files[0];
                this.formInformation.photoName = event.target.files[0].name;
            },


            // ----- ADD NEW CLIENT -----
            onSubmit_Information(){
                this.formInformation
                    .post('/clients')
                    .then(response => {

                        //client
                        this.formInformation.id          = response.client.id;
                        this.formInformation.name        = response.client.name;
                        this.formInformation.surname     = response.client.surname;
                        this.formInformation.datastart   = response.client.datastart;
                        this.formInformation.photo       = response.client.photo;
                        this.formInformation.photoName   = response.client.photoName;
                        this.formInformation.databirth   = response.client.databirth;
                        this.formInformation.phonenumber = response.client.phonenumber;
                        this.formInformation.appartament = response.client.appartament;

                        //information
                        this.formInformation.CPF       = response.specification.CPF;
                        this.formInformation.RG        = response.specification.RG;
                        this.formInformation.otherdoc  = response.specification.otherdoc;
                        this.formInformation.gender    = response.specification.gender;
                        this.formInformation.height    = response.specification.height;
                        this.formInformation.color     = response.specification.color;
                        this.formInformation.religion  = response.specification.religion;
                        this.formInformation.available = response.specification.available;
                        this.formInformation.ocupation = response.specification.ocupation;

                        console.log(response)
                        this.information_save = false;
                        this.$toaster.success('Successful added');
                    })
            },


            // Go back to all clients
            gotoClient(){
                this.$router.push('/clients/');
            },

        }
    }

</script>

<style>


</style>
