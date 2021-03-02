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
                                                            <img v-if="formInformation.url == '' || formInformation.url == null" src="images/shadow.png" class="img-thumbnail">
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
                                            <div class="float-right" v-show="!information_save">
                                                <button type="save" v-show="address_save" class="btn btn-success"><i class="fa fa-plus"></i> Save</button>
                                                <button type="edit" v-show="!address_save" class="btn btn-primary"><i class="fas fa-user-edit"></i> Edit</button>
                                                <a type="cancel" @click="gotoClient" class="btn btn-warning text-white"><i class="fa fa-times"></i> Cancel</a>
                                            </div>
                                            <!-- END ADDRESS -->
                                        </form>
                                    </div>


                                    <!-- ----------------[ADD FAMILY]------------------ -->
                                    <!-- ============================================== -->
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="family">
                                        <div class="row">
                                            <div class="col-md-5">

                                                <form method="post" @submit.prevent="onSubmit_Family">
                                                    <div class="form-group">
                                                        <label for="familyName">Name</label>
                                                        <input type="text" class="form-control" id="familyName" v-model="formFamily.name" required>
                                                        <span class="invalid-feedback d-block" role="alert" v-if="formFamily.errors.has('name')" v-text="formFamily.errors.get('name')"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="familySurname">Surname</label>
                                                        <input type="text" class="form-control" id="familySurname" v-model="formFamily.surname" required>
                                                        <span class="invalid-feedback d-block" role="alert" v-if="formFamily.errors.has('surname')" v-text="formFamily.errors.get('surname')"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="family_list">Family</label>
                                                        <select id="family_list" class="form-control" v-model="formFamily.parent" required>
                                                            <option>Marido/ Dama</option>
                                                            <option>Filho(a)</option>
                                                            <option>Irmão(a)</option>
                                                            <option>Outros</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                            <input type="checkbox" class="custom-control-input" id="familyGender" v-model="formFamily.gender">
                                                            <label v-if="formFamily.gender == 0" class="custom-control-label" for="familyGender">Male</label>
                                                            <label v-else class="custom-control-label" for="familyGender">Female</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="familyPhonenumber">Phone Number</label>
                                                        <input type="number" class="form-control" id="familyPhonenumber" v-model="formFamily.phonenumber" required>
                                                        <span class="invalid-feedback d-block" role="alert" v-if="formFamily.errors.has('phonenumber')" v-text="formFamily.errors.get('phonenumber')"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="familyEmail">Email</label>
                                                        <input type="email" class="form-control" id="familyEmail" v-model="formFamily.email" required>
                                                        <span class="invalid-feedback d-block" role="alert" v-if="formFamily.errors.has('email')" v-text="formFamily.errors.get('email')"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-group col-md-3">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="responsable" v-model="formFamily.responsable">
                                                                <label class="custom-control-label" for="responsable">Responsable</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div v-show="!information_save">
                                                            <button type="save" v-show="!information_save && family_save" class="btn btn-success"><i class="fa fa-plus"></i> Add</button>
                                                            <a type="edit" v-show="!family_save" @click="modifyFamily" class="btn btn-primary"><i class="fas fa-user-edit"></i> Edit</a>
                                                            <a type="delete" v-show="!family_save" @click="deleteFamily" class="btn btn-danger text-white"><i class="far fa-trash-alt"></i> Delete</a>
                                                            <a type="cancel" v-show="!family_save" @click="cancelFamily" class="btn btn-warning text-white"><i class="fa fa-times"></i> Cancel</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- [ALL FAMILY] -->
                                            <div class="col-md-7 rounded-lg shadow-sm p-4">
                                                <h3 class="font-weight-bolder text-center">Family List:</h3>
                                                <hr/>
                                                <div class="row">
                                                    <div class="card col-lg-3 col-4" v-for="(family, index) in familyList" @click="editFamily(index)" v-bind:key="family.id" style="cursor:pointer;">
                                                        <div class="ribbon-wrapper" v-if="family.responsable == true">
                                                            <div class="ribbon bg-primary">responsable</div>
                                                        </div>
                                                        <img class="card-img-top" :src="'images/family/' + family.gender + '.png'" alt="Card image">
                                                        <div>
                                                            <p class="text-center mb-0"><b>{{ family.name }} {{ family.surname }}</b></p>
                                                            <p class="text-center mb-0">{{ family.parent }}</p>
                                                            <p class="text-center mb-0">{{ family.phonenumber }}</p>
                                                            <p class="text-center mb-0">{{ family.email }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->


                                    <!-- -------------[ADD DIAGNOSTIC]----------------- -->
                                    <!-- ============================================== -->
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="diagnostic">
                                        <div class="row">
                                            <div class="col-xl-5">

                                                <form method="post" @submit.prevent="onSubmit_Diagnostic">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="diagnostic">Diagnostic</label>
                                                            <select id="diagnostic" class="form-control" v-model="formDiagnostic.diagnostic_id" @change="getRank($event)" required>
                                                                <option v-for="diagnostic in diagnosticList" v-text='diagnostic.name' v-bind:key="diagnostic.id" :rank="diagnostic.rank" :value="diagnostic.id"></option>
                                                            </select>
                                                            <span class="invalid-feedback d-block" role="alert" v-if="formDiagnostic.errors.has('name')" v-text="formDiagnostic.errors.get('name')"></span>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="rank">Rank</label>
                                                            <input type="number" class="form-control" id="rank" v-model="formDiagnostic.rank" disabled>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="dateDiagnostic">Date</label>
                                                            <input type="date" class="form-control" id="dateDiagnostic" min="1" v-model="formDiagnostic.date" required>
                                                            <span class="invalid-feedback d-block" role="alert" v-if="formDiagnostic.errors.has('date')" v-text="formDiagnostic.errors.get('date')"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label for="comments">Comments</label>
                                                            <textarea class="form-control" id="comments" v-model="formDiagnostic.comments"></textarea>
                                                            <span class="invalid-feedback d-block" role="alert" v-if="formDiagnostic.errors.has('comments')" v-text="formDiagnostic.errors.get('comments')"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div v-show="!information_save">
                                                            <button type="save" v-show="diagnostic_save" class="btn btn-success"><i class="fa fa-plus"></i> Add</button>
                                                            <a type="edit" v-show="!diagnostic_save" @click="modifyDiagnostic" class="btn btn-primary"><i class="fas fa-user-edit"></i> Edit</a>
                                                            <a type="cancel" v-show="!diagnostic_save" @click="cancelDiagnostic" class="btn btn-warning text-white"><i class="fa fa-times"></i> Cancel</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- [ALL DIAGNOSTIC] -->
                                            <div class="col-xl-7">
                                                <div class="card" style="min-height: 235px;">
                                                    <div class="card-header">
                                                        <h3 class="card-title font-weight-bold">List Diagnostic</h3>

                                                        <div class="card-tools">
                                                            <div class="input-group input-group-sm" style="width: 150px;">
                                                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search" v-model="search">

                                                                <div class="input-group-append">
                                                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body table-responsive p-0">
                                                        <table class="table table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th>Diagnostic</th>
                                                                <th>Rank</th>
                                                                <th>Date</th>
                                                                <th>Comments</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="(diagnostic, index) in filtredListDiagnostic" v-bind:key="diagnostic.id">
                                                                    <td>{{diagnostic.name}}</td>
                                                                    <td>{{diagnostic.rank}}</td>
                                                                    <td>{{diagnostic.date}}</td>
                                                                    <td>{{diagnostic.comments}}</td>
                                                                    <td>
                                                                        <button type="edit" class="btn btn-primary" @click="editDiagnostic(index)"><i class="far fa-edit"></i></button>
                                                                        <a type="delete" class="btn btn-danger text-white" @click="deleteDiagnostic(diagnostic.id)"><i class="far fa-trash-alt"></i></a>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                                <!-- /.card -->
                                            </div>
                                        </div>
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
                address_save:     true,
                family_save:      true,
                diagnostic_save:  true,

                // Information
                formInformation: new Form({

                    //client
                    'id'         : '',
                    'name'       : '',
                    'surname'    : '',
                    'datastart'  : '',
                    'photo'      : '',
                    'photoName'  : '',
                    'databirth'  : '',
                    'phonenumber': '',
                    'appartament': '',
                    'url'        : '',

                    //information
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

                    'client_id':'',
                    'street'   :'',
                    'number'   : '',
                    'city'     : '',
                    'state'    : '',
                    'country'  : '',
                }),


                // family
                formFamily: new Form({

                    'id'         : '',
                    'client_id'  : '',
                    'name'       : '',
                    'surname'    : '',
                    'parent'     : '',
                    'gender'     : false,
                    'phonenumber': '',
                    'email'      : '',
                    'responsable': false,
                }),

                familyList: [],


                // diagnostic
                formDiagnostic: new Form({

                    'id'           : '',
                    'client_id'    : '',
                    'diagnostic_id': '',
                    'name'         : '',
                    'rank'         : '',
                    'date'         : '',
                    'comments'     : '',
                }),

                search              : '',
                diagnosticListClient: [],
                diagnosticList      : [],
            }

        },


        created() {
            // Fetch especific diagnostic
            axios.get('/diagnostics')
                .then(response => this.diagnosticList = response.data);
        },


        computed: {
            filtredListDiagnostic()
            {
                return this.diagnosticListClient.filter(post => {
                    return post.name.toLowerCase().includes(this.search.toLowerCase());
                });
            }
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

            // ----- ADD NEW CLIENT -----
            onSubmit_Information()
            {
                console.log(this.formInformation);
                 // PHOTO
                const data = new FormData();
                data.append('photo', this.formInformation.photo);
                data.append('description', this.formInformation.photoName);

                axios.post("/photoClient", data)
                .then(response =>{
                    this.formInformation.url = response.data

                    // ADD / EDIT USER
                    this.formInformation
                    .post('/clients')
                    .then(response => {

                        console.log(response);

                        //client
                        this.formInformation.id          = response.client.id;
                        this.formInformation.name        = response.client.name;
                        this.formInformation.surname     = response.client.surname;
                        this.formInformation.datastart   = response.client.datastart;
                        // this.formInformation.photoName   = response.client.photoName;
                        this.formInformation.databirth   = response.client.databirth;
                        this.formInformation.phonenumber = response.client.phonenumber;
                        this.formInformation.appartament = response.client.appartament;
                        this.formInformation.url         = response.client.url;

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

                        // use client_id into address | family | Diagnostic
                        this.formAddress.client_id    = this.formInformation.id;
                        this.formFamily.client_id     = this.formInformation.id;
                        this.formDiagnostic.client_id = this.formInformation.id;

                        this.information_save = false;
                        this.$toaster.success(this.formInformation.name + ' successful added.');
                    })

                });
            },


            // --------------------------- [ ADDRESS ] ---------------------------
            // ===================================================================

            // ----- ADD ADDRESS -----
            onSubmit_Address()
            {
                this.formAddress
                    .post('/clientAddress')
                    .then(response => {

                        // //address
                        this.formAddress.client_id = response.client_id;
                        this.formAddress.street    = response.street;
                        this.formAddress.number    = response.number;
                        this.formAddress.city      = response.city;
                        this.formAddress.state     = response.state;
                        this.formAddress.country   = response.country;

                        this.address_save = false;
                        this.$toaster.success('Address added.');
                    })
            },
            // END NEW ADDRESS


            // Go back to all clients
            gotoClient()
            {
                this.$router.push('/clients/');
            },


            // --------------------------- [ FAMILY ] ---------------------------
            // ==================================================================

            // ----- ADD FAMILY -----
            onSubmit_Family()
            {
                this.formFamily
                    .post('/family')
                    .then(response => {

                        let newFamily = new Object({
                            'id':          response.id,
                            'client_id':   response.client_id,
                            'name':        response.name,
                            'surname':     response.surname,
                            'parent':      response.parent,
                            'gender':      response.gender,
                            'phonenumber': response.phonenumber,
                            'email':       response.email,
                            'responsable': response.responsable,
                        });

                        this.familyList.push(newFamily);

                        // input information onto checkbox
                        this.formFamily.client_id   = response.client_id;
                        this.formFamily.gender      = false;
                        this.formFamily.responsable = false;

                        this.$toaster.success('Address added.');
                    })
            },


            // ----- EDIT FAMILY -----
            editFamily(index)
            {
                // Populate Inputs
                this.formFamily.id          = this.familyList[index].id;
                this.formFamily.client_id   = this.familyList[index].client_id;
                this.formFamily.name        = this.familyList[index].name;
                this.formFamily.surname     = this.familyList[index].surname;
                this.formFamily.parent      = this.familyList[index].parent;
                this.formFamily.gender      = this.familyList[index].gender;
                this.formFamily.phonenumber = this.familyList[index].phonenumber;
                this.formFamily.email       = this.familyList[index].email;
                this.formFamily.responsable = this.familyList[index].responsable;

                //edit button
                this.family_save = false;
            },


            // ----- MODIFY FAMILY -----
            modifyFamily(){

                this.formFamily
                    .patch('/family')
                    .then(response => {

                        var index = this.familyList.findIndex(x => x.id === response.id);

                        this.familyList[index].client_id   = response.client_id;
                        this.familyList[index].name        = response.name;
                        this.familyList[index].surname     = response.surname;
                        this.familyList[index].parent      = response.parent;
                        this.familyList[index].gender      = response.gender;
                        this.familyList[index].phonenumber = response.phonenumber;
                        this.familyList[index].email       = response.email;
                        this.familyList[index].responsable = response.responsable;

                        //edit button
                        this.family_save = true;

                        this.$toaster.success('Family edited.');
                    });
            },


             // ----- CANCEL FAMILY -----
            cancelFamily()
            {
                // Populate Inputs
                this.formFamily.id          = "";
                this.formFamily.name        = "";
                this.formFamily.surname     = "";
                this.formFamily.phonenumber = "";
                this.formFamily.email       = "";

                //edit button
                this.family_save = true;

                this.$toaster.warning('Canceled.');
            },


            deleteFamily()
            {
                this.formFamily
                .post('/deleteFamily')
                .then(response => {

                    var count = 0
                    this.familyList.forEach(element => {
                        element.id == (response.id) ? this.familyList.splice(count,1) : count +=1;
                    });

                    this.family_save = true;
                    this.$toaster.success('Successful Deleted.');
                });

            },


            // ------------------------- [ DIAGNOSTIC ] -------------------------
            // ==================================================================

            getRank(e)
            {
                if (e.target.options.selectedIndex > -1) {
                    const theTarget = e.target.options[e.target.options.selectedIndex];
                    this.formDiagnostic.rank = theTarget.getAttribute('rank');
                }

            },

            // ----- ADD DIAGNOSTIC -----
            onSubmit_Diagnostic()
            {
                this.formDiagnostic
                    .post('/diagnosticsClient')
                    .then(response => {

                        let newDiagnostic = new Object({

                            'id':            response[0].id,
                            'diagnostic_id': response[0].diagnostic_id,
                            'client_id':     response[0].client_id,
                            'name':          response[0].name,
                            'rank':          response[0].rank,
                            'date':          response[0].date,
                            'comments':      response[0].comments,

                        });

                        this.diagnosticListClient.push(newDiagnostic);

                        // input information onto current form
                        this.formDiagnostic.client_id   = response.client_id;

                        this.$toaster.success('Diagnostic added.');
                    })
            },


            // EDIT DIAGNOSTIC
            editDiagnostic(index)
            {
                this.formDiagnostic.id            = this.diagnosticListClient[index].id;
                this.formDiagnostic.client_id     = this.diagnosticListClient[index].client_id;
                this.formDiagnostic.diagnostic_id = this.diagnosticListClient[index].diagnostic_id;
                this.formDiagnostic.name          = this.diagnosticListClient[index].name;
                this.formDiagnostic.rank          = this.diagnosticListClient[index].rank;
                this.formDiagnostic.date          = this.diagnosticListClient[index].date;
                this.formDiagnostic.comments      = this.diagnosticListClient[index].comments;

                //edit button
                this.diagnostic_save = false;
            },


            // MODIFY DIAGNOSTIC
            modifyDiagnostic(){

                this.formDiagnostic
                    .patch('/diagnosticsClient')
                    .then(response => {

                        var index = this.diagnosticListClient.findIndex(x => x.id === response[0].id);

                        this.diagnosticListClient[index].diagnostic_id = response[0].diagnostic_id
                        this.diagnosticListClient[index].name          = response[0].name
                        this.diagnosticListClient[index].rank          = response[0].rank
                        this.diagnosticListClient[index].date          = response[0].date
                        this.diagnosticListClient[index].comments      = response[0].comments

                        //edit button
                        this.diagnostic_save = true;

                        this.$toaster.success('Diagnostic edited.');
                    });

            },


            // EDIT DIAGNOSTIC
            deleteDiagnostic(id)
            {
                axios.post('/diagnosticsClient/' + id, {
                _method: 'DELETE'
                })
                .then(response => {

                    var count = 0
                    this.diagnosticListClient.forEach(element => {
                        element.id == (response.data.id) ? this.diagnosticListClient.splice(count,1) : count +=1;
                    });

                    this.$toaster.success('Successful deleted');
                });

            },

            // CANCEL DIAGNOSTIC
            cancelDiagnostic()
            {
                this.formDiagnostic.id             = "";
                this.formDiagnostic.diagnostic_id  = "";
                this.formDiagnostic.name           = "";
                this.formDiagnostic.rank           = "";
                this.formDiagnostic.date           = "";
                this.formDiagnostic.comments       = "";

                this.diagnostic_save = true;

                this.$toaster.warning('Canceled');

            },


        }
    }

</script>

<style>


</style>
