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
                                        <form class="form-horizontal">
                                            <div class="card-body">


                                                <div class="row">
                                                    <!-- PHOTO -->
                                                    <div class="col-md-4">

                                                    </div>

                                                    <!-- INFORMATIONS -->
                                                    <div class="col-md-8">


                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label for="name">Name</label>
                                                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required autofocus >
                                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span> -->
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="surname">Surname</label>
                                                                <input type="text" class="form-control" id="surname" placeholder="Surname" required>
                                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('surname')" v-text="form.errors.get('surname')"></span> -->
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="datastart">Datastart</label>
                                                                <input type="date" class="form-control" id="datastart" placeholder="datastart" required>
                                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('datastart')" v-text="form.errors.get('datastart')"></span> -->
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label for="databirth">Databirth</label>
                                                                <input type="data" class="form-control" id="databirth" placeholder="databirth" required>
                                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('databirth')" v-text="form.errors.get('databirth')"></span> -->
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <label for="age">Age</label>
                                                                <input type="text" class="form-control" id="age" placeholder="age" disabled>
                                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('age')" v-text="form.errors.get('age')"></span> -->
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="phonenumber">Phone Number</label>
                                                                <input type="text" class="form-control" id="phonenumber" placeholder="phonenumber" required>
                                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('phonenumber')" v-text="form.errors.get('phonenumber')"></span> -->
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <label for="appartament">Appartament</label>
                                                                <input type="number" class="form-control" id="appartament" placeholder="appartament">
                                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('appartament')" v-text="form.errors.get('appartament')"></span> -->
                                                            </div>
                                                        </div>

                                                        <hr>

                                                        <!-- ESPECIFICATIONS -->
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label for="CPF">CPF</label>
                                                                <input type="text" class="form-control" id="CPF" name="CPF" placeholder="421-110-223-27" required>
                                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('CPF')" v-text="form.errors.get('CPF')"></span> -->
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="RG">RG</label>
                                                                <input type="text" class="form-control" id="RG" placeholder="42.188.403-3" required>
                                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('RG')" v-text="form.errors.get('RG')"></span> -->
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="other_doc">Other Document</label>
                                                                <input type="text" class="form-control" id="other_doc">
                                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('other_doc')" v-text="form.errors.get('other_doc')"></span> -->
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-3">
                                                                <label for="gender">Gender</label>
                                                                <input type="text" class="form-control" id="gender" name="gender" placeholder="Gender">
                                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('city')" v-text="form.errors.get('city')"></span> -->
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="height">Height</label>
                                                                <input type="text" class="form-control" id="height" name="height" placeholder="height">
                                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('state')" v-text="form.errors.get('state')"></span> -->
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="color">Color</label>
                                                                <input type="text" class="form-control" id="color" name="color" placeholder="Color">
                                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('state')" v-text="form.errors.get('state')"></span> -->
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="religion">Religion</label>
                                                                <input type="text" class="form-control" id="religion" name="religion" placeholder="religion">
                                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('country')" v-text="form.errors.get('country')"></span> -->
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-3">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input" id="available">
                                                                    <label class="custom-control-label" for="available">Available</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-9">
                                                                <label for="ocupation">Ocupation</label>
                                                                <input type="text" class="form-control" id="ocupation" name="ocupation" placeholder="Ocupation">
                                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('country')" v-text="form.errors.get('country')"></span> -->
                                                            </div>
                                                        </div>
                                                        <!-- END ESPECIFICATIONS -->

                                                        <hr>

                                                        <!-- ROLE -->
                                                        <div class="form-group row">
                                                            <label class="col-lg-2">
                                                                <!-- Roles: -->
                                                            </label>
                                                            <!-- <div class="col-lg-9">
                                                                <label class="col-lg-3" v-for='role in roles' v-bind:key="role.id">
                                                                    <label>
                                                                        <input type="checkbox" :value="role.id" v-model="form.checkedRoles">
                                                                            {{role.name}}
                                                                        <span></span>
                                                                    </label>
                                                                </label>
                                                            </div> -->
                                                            <!-- <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('checkedRoles')" v-text="form.errors.get('checkedRoles')"></span> -->
                                                        </div>
                                                        <!-- END ROLE -->


                                                    </div>
                                                    <!-- END INFORMATION -->

                                                </div>

                                            </div>
                                            <!-- /.card-body -->
                                            <div class="card-footer">
                                                <!-- <button type="save" v-show="this.newUser" class="btn btn-success"><i class="fa fa-plus"></i> Save</button>
                                                <button type="edit" v-show="!this.newUser" class="btn btn-primary"><i class="far fa-edit"></i> Edit</button>
                                                <a type="cancel" v-show="!this.newUser" class="btn btn-warning text-white" @click="cancelEdit"><i class="fa fa-times"></i> Cancel</a> -->
                                            </div>
                                            <!-- /.card-footer -->
                                        </form>
                                    </div>
                                    <!-- END INFORMATION TAB -->



                                    <div class="tab-pane" id="address">
                                        <!-- ADDRESS -->
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="name">Street</label>
                                                <input type="text" class="form-control" id="street" name="street" autocomplete="street" autofocus placeholder="street">
                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('street')" v-text="form.errors.get('street')"></span> -->
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="email">Number</label>
                                                <input type="text" class="form-control" id="number" placeholder="92">
                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('number')" v-text="form.errors.get('number')"></span> -->
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="name">City</label>
                                                <input type="text" class="form-control" id="city" name="city" autocomplete="City" autofocus placeholder="City">
                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('city')" v-text="form.errors.get('city')"></span> -->
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="name">State</label>
                                                <input type="text" class="form-control" id="state" name="state" autocomplete="State" autofocus placeholder="State">
                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('state')" v-text="form.errors.get('state')"></span> -->
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="name">Country</label>
                                                <input type="text" class="form-control" id="country" name="country" autocomplete="Country" autofocus placeholder="Country">
                                                <!-- <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('country')" v-text="form.errors.get('country')"></span> -->
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
                clients: "",
            }

        },


        created() {



        },


        methods: {


        }
    }

</script>

<style>


</style>
