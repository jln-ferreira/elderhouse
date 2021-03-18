<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Client</h1>
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
                                <h3 class="card-title p-3" v-text="formInformation.name"></h3>
                                <ul class="nav nav-pills ml-auto p-2">
                                    <li class="nav-item"><a class="nav-link active" href="#information" data-toggle="tab">Information</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#address" data-toggle="tab">Address</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#family" data-toggle="tab">Family</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#diagnostic" data-toggle="tab">Diagnostic</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#creditcard" data-toggle="tab">Credit Card</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#contract" data-toggle="tab">Contract</a></li>
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
                                                                <input type="text" class="form-control" v-model="formInformation.name" id="name" name="name" placeholder="Name" required>
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
                                                        <label for="familyCPF">CPF</label>
                                                        <input type="number" class="form-control" v-model="formFamily.CPF" id="familyCPF" name="familyCPF" placeholder="421-110-223-27">
                                                        <span class="invalid-feedback d-block" role="alert" v-if="formFamily.errors.has('CPF')" v-text="formFamily.errors.get('CPF')"></span>
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
                                                        <div>
                                                            <button type="save" v-show="family_save" class="btn btn-success"><i class="fa fa-plus"></i> Add</button>
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
                                                        <div class="ribbon-wrapper" v-if="family.responsable == 1">
                                                            <div class="ribbon bg-primary">responsable</div>
                                                        </div>
                                                        <img class="card-img-top" v-if="family.gender == 1" src="images/family/true.png" alt="Card image">
                                                        <img class="card-img-top" v-else src="images/family/false.png" alt="Card image">
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
                                                        <div>
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


                                    <!-- ---------------[ADD CREDIT CARD]------------------ -->
                                    <!-- ============================================== -->
                                    <div class="tab-pane" id="creditcard">

                                        <div class="row">
                                            <div class="col-lg-7 mx-auto">
                                                <div class="bg-white rounded-lg shadow p-5">

                                                    <!-- Credit card form content -->
                                                    <div class="tab-content">
                                                        <!-- credit card info-->
                                                        <div id="nav-tab-card" class="tab-pane fade show active">
                                                            <form method="post" @submit.prevent="onSubmit_CreditCard">
                                                                <div class="form-group">
                                                                    <label for="nameCard">Full name (on the card)</label>
                                                                    <input type="text" name="nameCard" placeholder="Jason Doe" v-model="formCreditCard.nameCard" required class="form-control">
                                                                    <span class="invalid-feedback d-block" role="alert" v-if="formCreditCard.errors.has('nameCard')" v-text="formCreditCard.errors.get('nameCard')"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="numberCard">Card number</label>
                                                                    <div class="input-group">
                                                                        <input type="text" name="numberCard" placeholder="Your card number"  v-model="formCreditCard.numberCard" class="form-control" required>
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text text-muted">
                                                                                <i class="fas fa-credit-card"></i>
                                                                            </span>
                                                                        </div>
                                                                        <span class="invalid-feedback d-block" role="alert" v-if="formCreditCard.errors.has('numberCard')" v-text="formCreditCard.errors.get('numberCard')"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-8">
                                                                        <div class="form-group">
                                                                            <label><span class="hidden-xs">Expiration</span></label>
                                                                            <div class="input-group">
                                                                                <input type="number" placeholder="MM" min="1" max="12" id="expirationMonth" v-model="formCreditCard.expirationMonth" class="form-control" required>
                                                                                <input type="number" placeholder="YY" min="22" max="27" id="expirationYear" v-model="formCreditCard.expirationYear" class="form-control" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group mb-4">
                                                                            <label data-toggle="tooltip" title="Three-digits code on the back of your card">CVV
                                                                                <i class="fa fa-question-circle"></i>
                                                                            </label>
                                                                            <input type="number" required class="form-control" max="999" v-model="formCreditCard.expirationCVV">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button type="submit" class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> <b>Confirm </b> </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- End -->

                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                     <!-- CONTRACT TAB -->
                                    <div class="tab-pane" id="contract">


                                        <!-- //ALL CONTRACTS -->
                                        <div class="row">

                                            <div class="col-lg-2 col-md-3 col-4"  v-for=" contract in allContracts" v-bind:key="contract.id">
                                                <div class="card">
                                                    <!-- <div class="card-header bg-success" v-text="contract.date"></div> -->
                                                    <div class="card-body">
                                                        <img src="images/pdf.png" class="img-thumbnail">
                                                        <p class="mb-0 text-center font-weight-bold" v-text="contract.date"></p>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="text-right">
                                                            <a class="btn btn-sm btn-primary text-white" >
                                                                <i class="fas fa-user"></i> View
                                                            </a>
                                                            <a class="btn btn-sm bg-danger">
                                                                <i class="fas fa-times"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- END ALL CONTRACTS -->


                                        <!-- CONTRACT SHOW -->
                                        <div class="row justify-content-center" id="printMe">
                                            <div class="card col-md-10 col-12">
                                                <div class="card-header d-flex p-0">
                                                    <h3 class="card-title p-3">CONTRATO DE PRESTAÇÃO DE SERVIÇOS DE IDOSO CAPAZ</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="tab-content">
                                                        <p>Pelo presente instrumento particular, por um lado: </p><br>
                                                        <p>Sr(a)<b> {{formInformation.name}} {{formInformation.surname}}</b>, CPF <b>{{formInformation.CPF}}</b>, doravante denominada (a) simplesmente <b>CONTRATANTE</b>;
                                                            e a Sr(a) <select v-model="formContract.familyId" @change="onChangeContractFamily($event)"><option v-for='(family, index) in familyList' v-bind:key='index' :value="family.id" v-html="family.name"></option></select>, portador(a)  do CPF/MF sob o nr <b>{{formContract.CPF}}</b> que
                                                            assina este Contrato como interveniente anuente e em caráter solidário ao <b>CONTRATANTE</b>,
                                                            doravante denominado simplesmente <b>RESPONSÁVEL SOLIDÁRIO</b>;</p>
                                                        <p>e por outro:</p>
                                                        <p>A Vivenda Quinta das Flores, com sede Santana de Parnaíba, na Rua Luís Antônio Rodrigues,
                                                            816 - Santana de Parnaíba – SP - CEP 06503-112 , inscrita no CNPJ sob o nº 19.808.311/0001-00,
                                                            neste ato representada nos termos do estatuto por <b>{{user.name}}</b>, portador da cédula de identidade nº <b>{{user.RG}}</b>,
                                                            inscrito no CPF/MF sob o nº <b>{{user.CPF}}</b> doravante denominada simplesmente <b>CONTRATADA</b>. </p>
                                                        <p>As partes acima identificadas têm, entre si, justo e acertado este Contrato de Prestação de Serviços (“Contrato”),
                                                            conforme determina o artigo 35 da Lei nº 10.741, de 1º de outubro de 2003 – Estatuto do Idoso e demais legislação aplicável à espécie,
                                                            que se regerá pelas cláusulas seguintes e pelas condições dispostas nas normativas a seguir descritas:</p>

                                                        <h4>1. DO OBJETO</h4>
                                                        <p>1.1	A <b>CONTRATADA</b> disponibiliza alojamentos para pessoas acima de 60 anos, oferecendo infra-estrutura e recursos humanos adequados,
                                                            hospedagem e atenção à saúde, dentro da legislação vigente. A <b>CONTRATADA</b> tem disponível em suas dependências dormitórios com diferentes
                                                            números de leitos, de forma que a acomodação objeto deste Contrato está especificada na cláusula 1.3. abaixo.</p>
                                                        <p>1.2 Ciente o <b>CONTRATANTE</b> e o <b>RESPONSÁVEL SOLIDÁRIO</b> das condições que a <b>CONTRATADA</b> oferece e do Regimento Interno que integra este Contrato,
                                                            neste ato o <b>CONTRATANTE</b> é admitido para residir no Residencial da <b>CONTRATADA</b>, no endereço indicado no preâmbulo deste Contrato,
                                                            no seguinte tipo de acomodação:</p>
                                                        <p>1.3	Apartamento  08    com 02 leitos.</p>

                                                        <h4>2. OBRIGAÇÕES DA CONTRATADA</h4>
                                                        <p>2.1 Em atenção à sua saúde, abordando aspectos de promoção, proteção e prevenção e objetivando a preservação dos vínculos familiares,
                                                            a <b>CONTRATADA</b> disponibilizará para o <b>CONTRATANTE</b>:</p>
                                                        <p>2.1.1 Serviços de hospedagem, nas condições descritas acima e que permita o adequado recebimento de visitas;</p>
                                                        <p>2.1.2 Alimentação, por meio de seis refeições diárias balanceadas e em quantidades compatíveis com suas necessidades energéticas e nutricionais;</p>
                                                        <p>2.1.3 Lavagem de suas roupas, limitado a 90 peças por mês.</p>
                                                        <p>2.1.4 Auxílio na realização do seu asseio e higiene pessoal, na medida das suas necessidades e capacidades;</p>
                                                        <p>2.1.5 Serviços contínuos de enfermagem;</p>
                                                        <p>2.1.6 Acompanhamento médico, </p>
                                                        <p>2.1.7 Promoção de atividades educacionais, esportivas, culturais e de lazer, promovendo, ainda, assistência religiosa aos idosos que assim desejarem;</p>
                                                        <p>2.1.8 Convivência comunitária; e</p>
                                                        <p>2.1.9 Atendimento psicossocial ao <b>CONTRATANTE</b> e à sua família e <b>RESPONSÁVEL SOLIDÁRIO</b>.</p>
                                                        <p>2.2 Dependendo das necessidades do <b>CONTRATANTE</b>, de acordo a avaliação médica inicial, abaixo prevista, realizada pelo médico geriatra da <b>CONTRATADA</b>, serviços extras de atenção à saúde poderão ser prestados pela <b>CONTRATADA</b>, que incluem, mas não se limitam a:</p>
                                                        <ul>
                                                            <li>Serviços de acompanhante exclusivo;</li>
                                                            <li>Fornecimento de medicamentos, materiais e produtos de higiene pessoal, como sabonetes, fraldas e cremes; </li>
                                                            <li>Fornecimento de serviços especiais, conforme Tabela anexa, cujos preços sofrem ajustes periódicos, de acordo com o mercado; e</li>
                                                            <li>Outros serviços solicitados pelo <b>CONTRATANTE</b> ou <b>RESPONSÁVEL SOLIDÁRIO</b>, desde que não infrinjam o Regimento Interno ou não sejam objetados pela equipe médica da <b>CONTRATADA</b>.</li>
                                                        </ul>
                                                        <p>2.3 Os serviços extras e respectivas despesas administrativas serão sempre objeto de cobrança/reembolso, na forma da cláusula abaixo, que trata de REMUNERAÇÃO, REAJUSTES E INADIMPLEMENTO.</p>
                                                        <p>2.4 Os serviços extras somente poderão ser prestados mediante autorização expressa do <b>CONTRATANTE</b>, sendo facultada a livre prestação dos serviços extras por terceiros</p>
                                                        <p>2.5 Na hipótese de <b>CONTRATANTE</b> capaz, sua saída ou recebimento de visitas não prescinde de autorização da <b>CONTRATADA</b>, devendo, em qualquer caso, serem observadas as regras do Regimento Interno da <b>CONTRATADA</b>.</p>
                                                        <p>2.6 Para fins deste Contrato, a <b>CONTRATADA</b> compromete-se a observar as regras da Resolução RDC 283/05 ou da legislação que vier a substituí-la.</p>
                                                        <p>2.7 A <b>CONTRATADA</b> compromete-se, ainda, a:</p>
                                                        <p>2.7.1 Comunicar à autoridade competente de saúde toda ocorrência de <b>CONTRATANTE</b> portador de doenças infecto-contagiosas;</p>
                                                        <p>2.7.2 Informar e solicitar ao Ministério Público que requisite os documentos necessários ao exercício da cidadania àqueles CONTRANTES que não os possuírem, na forma da lei;</p>
                                                        <p>2.7.3 Manter banco de dados constando a data e circunstâncias do atendimento, nome do <b>CONTRATANTE</b>, <b>RESPONSÁVEL SOLIDÁRIO</b>, parentes, endereços, cidade, relação de seus pertences, e demais dados que possibilitem sua identificação e a individualização do atendimento; e</p>
                                                        <p>2.7.4 Comunicar ao Ministério Público, para as providências cabíveis, a situação de abandono moral ou material por parte dos familiares e <b>RESPONSÁVEL SOLIDÁRIO</b>.</p>

                                                        <h4>3. OBRIGAÇÕES DO CONTRATANTE E DO RESPONSÁVEL SOLIDÁRIO</h4>
                                                        <p>3.1 O CONTRANTE e/ou <b>RESPONSÁVEL SOLIDÁRIO</b> comprometem-se a:</p>
                                                        <p>3.1.1 Pagar pontualmente as mensalidades e todos os serviços extras;</p>
                                                        <p>3.1.2 Respeitar o Regimento Interno; e</p>
                                                        <p>3.1.3 Manter o alojamento do <b>CONTRATANTE</b> em ordem e em condições de habitabilidade.</p>
                                                        <p>3.2 O <b>RESPONSÁVEL SOLIDÁRIO</b> compromete-se a realizar visitas periódicas ao <b>CONTRATANTE</b>, no mínimo duas vezes ao mês na modalidade de serviço residente, para verificar seu estado geral, receber informações a seu respeito e verificar o respeito e cumprimento do Regimento Interno, tanto pelo <b>CONTRATANTE</b> como por suas visitas.</p>
                                                        <p>3.3 O <b>RESPONSÁVEL SOLIDÁRIO</b> compromete-se a acompanhar o <b>CONTRATANTE</b> nos exames laboratoriais e nas internações hospitalares, assumindo a responsabilidade pelo <b>CONTRATANTE</b> perante àquelas instituições de saúde.</p>
                                                        <p>3.4 Em caso de internação, o <b>RESPONSÁVEL SOLIDÁRIO</b> compromete-se a acompanhar o <b>CONTRATANTE</b> no tratamento e procedimentos a serem adotados.</p>
                                                        <p>3.5 No ato de alta hospitalar o <b>CONTRATANTE</b> ou o <b>RESPONSÁVEL SOLIDÁRIO</b> comprometem-se a avisar previamente a gerência do Residencial, para que a equipe multidisciplinar avalie o estado geral do <b>CONTRATANTE</b> e as necessidades de atendimento especializado.</p>
                                                        <p>3.6 O <b>CONTRATANTE</b> ou o <b>RESPONSÁVEL SOLIDÁRIO</b> comprometem-se a obter e enviar relatório médico à <b>CONTRATADA</b>, descrevendo o estado geral de saúde do <b>CONTRATANTE</b>, os procedimentos realizados e os cuidados a serem adotados.</p>
                                                        <p>3.7 No início da vigência deste Contrato, e adicionalmente, a cada alteração clínica constatada, o <b>RESPONSÁVEL SOLIDÁRIO</b> compromete-se a informar a <b>CONTRATADA</b> a respeito das seguintes situações:</p>
                                                        <p>3.7.1 Estado de Saúde e quadro clínico do <b>CONTRATANTE</b>: </p>
                                                        <ul>
                                                            <li>Doenças pré-existentes;</li>
                                                            <li>Fraturas consolidadas ou em consolidação;</li>
                                                            <li>Tratamentos realizados e em curso;</li>
                                                            <li>Cirurgias realizadas;</li>
                                                            <li>Alterações cognitivas e de comportamento;</li>
                                                            <li>Surtos e outras atitudes esporádicas não compatíveis com a normalidade.</li>
                                                        </ul>
                                                        <p>3.7.2 Convênio médico do <b>CONTRATANTE</b>;</p>
                                                        <p>3.7.3 Orientações referentes à dieta ou quaisquer outras de origem médica do <b>CONTRATANTE</b>;</p>
                                                        <p>3.7.4 Os procedimentos a serem adotados em caso falecimento do <b>CONTRATANTE</b>; e</p>
                                                        <p>3.7.5 Entregar para análise e aprovação da <b>CONTRATADA</b>, a lista de bens pessoais do <b>CONTRATANTE</b>, que serão deixados para uso durante a vigência do Contrato. </p>
                                                        <p>3.8 Caso as avaliações médicas mensais indiquem alteração no estado de saúde do <b>CONTRATANTE</b>, o <b>RESPONSÁVEL SOLIDÁRIO</b> compromete-se a oferecer imediatamente um atendimento médico especializado adequado, na forma de convênio médico ou outro tipo de atendimento.</p>
                                                        <p>3.9 O <b>RESPONSÁVEL SOLIDÁRIO</b> compromete-se a providenciar a mudança do <b>CONTRATANTE</b> e de seus pertences no prazo de 5 dias a contar do término do Contrato por qualquer razão.</p>

                                                        <h4>4. VIGÊNCIA, RENOVAÇÃO E TÉRMINO </h4>
                                                        <p>4.1 O prazo deste Contrato é indeterminado, podendo ser renovado automaticamente havendo interesse entre as partes. Também pode ser rescindido a qualquer tempo, por qualquer das partes após comunicação por escrito da outra parte, com antecedência de 30 dias corridos.</p>
                                                        <p>4.2 O Contrato também poderá ser rescindido de pleno direito pela <b>CONTRATADA</b> caso o <b>CONTRATANTE</b> deixe de pagar duas mensalidades consecutivas, independentemente de aviso, notificação ou interpelação prévia.</p>
                                                        <p>4.3 O Contrato será rescindido em função do agravamento do estado físico e/ou mental do <b>CONTRATANTE</b> para além da capacidade de prestação de serviços adequados ao caso pelo <b>CONTRATADA</b>, observadas as regras da Resolução RDC 283/05 ou da legislação que vier a substituí-la.</p>
                                                        <p>4.4 Na hipótese de término do Contrato no curso do mês, a <b>CONTRATADA</b> compromete-se a reembolsar o <b>CONTRATANTE</b> dos dias pagos e não utilizados, de forma proporcional, abatida a taxa de 10% incidente sobre a parcela mensal.</p>

                                                        <h4>5. REMUNERAÇÃO, REAJUSTES E MORA</h4>
                                                        <p>5.1 O valor  dos serviços objeto do Contrato é de R$6.500,00 (seis mil e quinhentos Reais) por mes, a ser pago antecipadamente até o dia 10 de cada mês.    </p>
                                                        <p>5.1.1 Neste ato, a <b>CONTRATANTE</b> expressa sua decisão de contratar os serviços objeto deste Contrato pela modalidade marcada acima. </p>
                                                        <p>5.1.2 Na hipótese de contratação de materiais, medicamentos e serviços extras, nos termos das Cláusulas 2.2., 2.3 e 2.4, esses deverão ser reembolsados pelo <b>CONTRATANTE</b> no mês imediatamente seguinte, de acordo com romaneio descritivo que deverá acompanhar a respectiva nota fiscal, com o acréscimo da taxa administrativa definida no Regimento Interno.</p>
                                                        <p>5.2 O Contrato será reajustado anualmente, todo o mês de junho, com base no índice do IGP-M da FGV, ou pelo índice que vier a substituí-lo. Na hipótese de contratos com vigência por menos de 1 ano, o reajuste será proporcional.</p>
                                                        <p>5.3 O atraso no pagamento da parcela mensal acarretará a aplicação de:</p>
                                                        <ul>
                                                            <li>Multa de 10% (dez por cento);</li>
                                                            <li>Atualização monetária pelo índice IGP-M da FGV, ou qualquer outro que venha a substituí-lo; e</li>
                                                            <li>Juros de 1% (um por cento) ao mês, pro rata die.</li>
                                                        </ul>
                                                        <p>5.4 O atraso do pagamento por mais de 30 (trinta) dias permite a <b>CONTRATADA</b> a incluir o nome do <b>CONTRATANTE</b> no Serviço de Proteção ao Crédito, bem como interpor ação judicial visando o recebimento do débito, após prévia notificação com antecedência de 10 dias. </p>

                                                        <h4>6. REGIMENTO INTERNO</h4>
                                                        <p>6.1 Neste ato, a <b>CONTRATADA</b> entrega para o <b>CONTRATANTE</b> e para o <b>RESPONSÁVEL SOLIDÁRIO</b>, cópias do Regimento Interno da <b>CONTRATADA</b> e reconhecem que leram o seu conteúdo, e o aceitam como parte integrante deste Contrato. </p>
                                                        <p>6.2 Eventuais alterações no Regimento Interno serão comunicadas e divulgadas ao <b>CONTRATANTE</b> e ao <b>RESPONSÁVEL SOLIDÁRIO</b> com a devida antecedência, ficando facultada a resilição do Contrato, caso discordem de suas alterações. </p>

                                                        <h4>7. DISPOSIÇÕES DIVERSAS</h4>
                                                        <p>7.1 O <b>CONTRATANTE</b> e o <b>RESPONSÁVEL SOLIDÁRIO</b> reconhecem que a <b>CONTRATADA</b> é entidade idônea, que desempenha da melhor forma possível as atividades necessárias ao pleno cumprimento deste Contrato.</p>
                                                        <p>7.2 As partes aceitam a avaliação médica inicial realizada pelo médico geriatra da <b>CONTRATADA</b> a respeito do estado geral de saúde do <b>CONTRATANTE</b>, com base na anamnese realizada, incluindo as informações prestadas pelo <b>RESPONSÁVEL SOLIDÁRIO</b>, nos termos da Cláusula 3.7 acima.</p>
                                                        <p>7.2.1 Qualquer alteração significativa no estado geral (mental ou físico) do <b>CONTRATANTE</b> implicará na revisão dos termos deste Contrato ou mesmo na sua rescisão, conforme o caso, observadas as regras da Resolução RDC 283/05 ou da legislação que vier a substituí-la. Em função das características e do quadro evolutivo do estado geral do <b>CONTRATANTE</b>, as seguintes correções se aplicarão aos valores contratuais:</p>
                                                        <ul>
                                                            <li>Mudança de Grau I para Grau II: reajuste de 25%;</li>
                                                            <li>Mudança de Grau II para Grau III em caráter temporário: reajuste de 50%.</li>
                                                        </ul>
                                                        <p>NB: por caráter temporário entende-se uma situação transitória de convalescença de no máximo 180 dias. Caso se caracterize uma transição definitiva para GRAU III, a <b>CONTRATADA</b> será levada a solicitar a rescisão deste Contrato.</p>
                                                        <p>7.2.2 O <b>CONTRATANTE</b> autoriza desde já a <b>CONTRATADA</b> a prestar-lhe os primeiros socorros em caso de necessidade premente, e manifesta a sua concordância com o tratamento emergencial prescrito pela equipe de saúde que o atender, de acordo com o disposto no item 3.4 do Regimento Interno. </p>
                                                        <p>7.2.3 As Partes acordam que inexistindo plano de saúde particular contratado pelo <b>CONTRATANTE</b>, as emergências de que trata a cláusula 7.2.2. acima deverão ser atendidas pelo Sistema Único de Saúde – SUS e, excepcionalmente, em caso de autorização expressa do <b>CONTRATANTE</b> ou do <b>RESPONSÁVEL SOLIDÁRIO</b>, poderá ser utilizado serviço de saúde particular para referidas demandas, que deverão ser arcados pelo <b>CONTRATANTE</b> ou do <b>RESPONSÁVEL SOLIDÁRIO</b>.</p>
                                                        <p>7.2.4 A escolha do atendimento médico do indivíduo é uma decisão pessoal ou de seu responsável legal, conforme o caso. O <b>CONTRATANTE</b> e o <b>RESPONSÁVEL SOLIDÁRIO</b> expressa e automaticamente eximem a <b>CONTRATADA</b> de qualquer responsabilidade sobre eventuais complicações decorrentes de uma opção de conduta médica diferente daquela sugerida pelo corpo médico da CONTRATADA.</p>
                                                        <p>7.3 As partes não poderão ceder, total ou parcialmente, os direitos ou obrigações assumidas no presente contrato, salvo se expressamente aprovado pela outra parte.</p>
                                                        <p>7.4 Qualquer tolerância das partes relativamente ao cumprimento das obrigações aqui assumidas não importará em novação ou alteração, tácita ou expressa, nem caracterizará renúncia de qualquer direito.</p>
                                                        <p>7.5 Nenhuma das partes será responsável ou será considerada faltosa pelo descumprimento de qualquer cláusula deste Contrato, se impedida de desempenhar suas obrigações por motivos de força maior ou caso fortuito, incluindo, mas não se limitando a greves, incêndios, terremotos, guerras ou outras contingências além da previsão ou controle das partes, na forma do artigo 393 do Código Civil.</p>

                                                        <h4>8. FORO</h4>
                                                        <p>8.1 As partes elegem o Foro Central da Comarca de Barueri para dirimir as pendências que surgirem deste Contrato.</p>
                                                        <p>Por fim, declaram ter lido todo o Contrato e Anexos e estarem cientes e de acordo com as suas cláusulas e condições, que obrigam as partes e seus sucessores.</p>
                                                        <p>E por estarem justas e contratadas, as partes assinam este Contrato em duas vias de igual teor, rubricando todas as suas páginas, na presença de duas testemunhas.</p>

                                                        <br><br>

                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label for="commentsContract">Comments</label>
                                                                <textarea class="form-control" id="commentsContract" v-model="formContract.comments"></textarea>
                                                            </div>
                                                        </div>

                                                        <br><br><br>
                                                        <p><i>Santana de Parnaíba, - {{formContract.date}}</i></p>

                                                        <div>
                                                            <div class="signatures row">
                                                                <div class="col-lg-6 col-10">
                                                                    <VueSignaturePad class="border-bottom bg-light" height="100px"  ref="signaturePadContratada" saveType="image/png"/>
                                                                    <p>Contratada - <b>{{user.name}} - {{user.CPF}}</b></p>
                                                                </div>
                                                            </div>
                                                            <div class="signatures row">
                                                                <div class="col-lg-6 col-10">
                                                                    <VueSignaturePad class="border-bottom bg-light" height="100px"  ref="signaturePadContratante" saveType="image/png"/>
                                                                    <p>Contratante - <b>{{formInformation.name}} {{formInformation.surname}} - {{formInformation.CPF}}</b></p>
                                                                </div>
                                                            </div>
                                                            <div class="signatures row">
                                                                <div class="col-lg-6 col-10">
                                                                    <VueSignaturePad class="border-bottom bg-light" height="100px"  ref="signaturePadResponsavel" saveType="image/png"/>
                                                                    <p>Responsable - <b>{{formContract.familyName}} - {{formContract.CPF}}</b></p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <button class="btn btn-success" @click="saveContract" :disabled="formContract.familyId==''"><i class="fas fa-save"></i> Submit</button>
                                                            <button class="btn btn-warning"  @click="undoContract"><i class="fas fa-undo"></i> Undo</button>
                                                        </div>



                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END CONTRACT SHOW -->

                                        </div>  <!--  END PRINt -->


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
import html2canvas from 'html2canvas';
import jspdf from 'jspdf';

    export default {

        data() {
            return {
                user_id : this.$userId, //======> AUTH()->id
                user    : '',  //full user
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


                // family
                formFamily: new Form({

                    'id'         : '',
                    'client_id'  : this.$route.params.id,
                    'name'       : '',
                    'surname'    : '',
                    'CPF'        : '',
                    'parent'     : '',
                    'gender'     : false,
                    'phonenumber': '',
                    'email'      : '',
                    'responsable': false,
                }),

                family_save: true,
                familyList: [],


                // diagnostic
                formDiagnostic: new Form({

                    'id'           : '',
                    'client_id'    : this.$route.params.id,
                    'diagnostic_id': '',
                    'name'         : '',
                    'rank'         : '',
                    'date'         : '',
                    'comments'     : '',
                }),

                diagnostic_save     : true,
                search              : '',
                diagnosticListClient: [],
                diagnosticList      : [],


                //Credit  Card
                formCreditCard: new Form({

                    'id'              : '',
                    'clientId'        : this.$route.params.id,
                    'numberCard'      : '',
                    'nameCard'        : '',
                    'expirationMonth' : '',
                    'expirationYear'  : '',
                    'expirationCVV'   : '',
                }),


                //Contracts
                formContract: new Form({

                    'id'        : '',
                    'clientId'  : this.$route.params.id,
                    'userId'    : this.$userId,
                    'familyId'  : '',
                    'familyName': '',
                    'CPF'       : '',
                    'date'      : new Date(),
                    'comments'  : '',
                }),

                allContracts: '',

            }
        },

        computed: {
            filtredListDiagnostic()
            {
                return this.diagnosticListClient.filter(post => {
                    return post.name.toLowerCase().includes(this.search.toLowerCase());
                });
            },
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
            axios.get('/addressClient/' + this.clientId)
                .then(response => {

                    // //address
                    this.formAddress.id        = response.data.id;
                    this.formAddress.street    = response.data.street;
                    this.formAddress.number    = response.data.number;
                    this.formAddress.city      = response.data.city;
                    this.formAddress.state     = response.data.state;
                    this.formAddress.country   = response.data.country;

                });


            // Fetch especific FAMILY
            axios.get('/familyClient/' + this.clientId)
                .then(response => this.familyList = response.data);



            // Fetch especific diagnostic
            axios.get('/diagnostics')
                .then(response => this.diagnosticList = response.data);

             // Fetch especific diagnostic_client
            axios.get('/diagnosticsClient/' + this.clientId)
                .then(response => this.diagnosticListClient = response.data);


            // Fetch especific CREDIT CARD
            axios.get('/bankAccountClient/' + this.clientId)
                .then(response => {

                    if(response.data.id != null){
                        let expDate = response.data.expiration_date.split('/');

                        //Credit Card
                        this.formCreditCard.id              = response.data.id;
                        this.formCreditCard.numberCard      = response.data.card_number;
                        this.formCreditCard.nameCard        = response.data.name_card;
                        this.formCreditCard.expirationMonth = expDate[0];
                        this.formCreditCard.expirationYear  = expDate[1];
                        this.formCreditCard.expirationCVV   = response.data.cvv;
                    }

                });

            // Fetch especific CONTRACT
             axios.get('/fullContract/' + this.clientId)
                .then(response => this.allContracts = response.data);


            // Fetch USER AUTH()
            axios.get('/users/' + this.user_id)
                .then(response => this.user = response.data);

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
                            'CPF':          response.CPF,
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
                this.formFamily.CPF         = this.familyList[index].CPF;
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
                        this.familyList[index].CPF         = response.CPF;
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
                this.formFamily.CPF         = "";
                this.formFamily.phonenumber = "";
                this.formFamily.email       = "";

                //edit button
                this.family_save = true;

                this.$toaster.warning('Canceled.');
            },


            deleteFamily()
            {
                if(confirm("Do you really want to delete?"))
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
                }
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

                        // input information onto current form\
                        this.formDiagnostic.client_id = this.clientId;

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
            modifyDiagnostic()
            {
                this.formDiagnostic
                    .patch('/diagnosticsClient')
                    .then(response => {

                        var index = this.diagnosticListClient.findIndex(x => x.id === response[0].id);

                        this.diagnosticListClient[index].diagnostic_id = response[0].diagnostic_id
                        this.diagnosticListClient[index].name          = response[0].name
                        this.diagnosticListClient[index].rank          = response[0].rank
                        this.diagnosticListClient[index].date          = response[0].date
                        this.diagnosticListClient[index].comments      = response[0].comments

                        this.formDiagnostic.client_id = this.clientId;

                        //edit button
                        this.diagnostic_save = true;

                        this.$toaster.success('Diagnostic edited.');
                    });
            },


            // EDIT DIAGNOSTIC
            deleteDiagnostic(id)
            {
                if(confirm("Do you really want to delete?"))
                {
                    axios.post('/diagnosticsClient/' + id, {
                    _method: 'DELETE'
                    })
                    .then(response => {

                        var count = 0
                        this.diagnosticListClient.forEach(element => {
                            element.id == (response.data.id) ? this.diagnosticListClient.splice(count,1) : count +=1;
                        });

                        this.formDiagnostic.client_id = this.clientId;

                        this.$toaster.success('Successful deleted');
                    });
                }
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


            // ------------------------- [ CREDIT CARD ] -------------------------
            // ===================================================================

            // ----- ADD BANK ACCOUNT -----
            onSubmit_CreditCard()
            {
                this.formCreditCard
                    .patch('/clientCreditCard')
                    .then(response => {

                        let expDate = response.expiration_date.split('/');
                        //Bank account
                        this.formCreditCard.id              = response.id;
                        this.formCreditCard.clientId        = response.client_id;
                        this.formCreditCard.numberCard      = response.card_number;
                        this.formCreditCard.nameCard        = response.name_card;
                        this.formCreditCard.expirationMonth = expDate[0];
                        this.formCreditCard.expirationYear  = expDate[1];
                        this.formCreditCard.expirationCVV   = response.cvv;

                        this.$toaster.success('Credit Card saved.');
                    })
            },



            // -------------------------- [ CONSTRACT ] -------------------------
            // ==================================================================
            onChangeContractFamily(event)
            {
                this.formContract.familyId = event.target.value;

                // change CPF AND NAME
                let family = this.familyList.find(x => x.id == this.formContract.familyId);

                this.formContract.CPF = family.CPF;
                this.formContract.familyName = family.name + ' ' + family.surname;
            },


            undoContract()
            {
                this.formContract.comments = '';
                this.$refs.signaturePadContratada.undoSignature();
                this.$refs.signaturePadContratante.undoSignature();
                this.$refs.signaturePadResponsavel.undoSignature();
            },

            saveContract()
            {
                //GENERATE THE CONTRACT TO PDF
                var HTML_Width = $("#printMe").width();
                var HTML_Height = $("#printMe").height();

                var top_left_margin = 15;
                var PDF_Width = HTML_Width+(top_left_margin*2);
                var PDF_Height = (PDF_Width*1.5)+(top_left_margin*2);
                var canvas_image_width = HTML_Width;
                var canvas_image_height = HTML_Height;

                var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;
                console.log(totalPDFPages);
                console.log(window.pageYOffset);


                html2canvas($("#printMe")[0],{
                    width: window.screen.availWidth,
                    height: 6000,
                    windowWidth: document.body.scrollWidth,
                    windowHeight: document.body.scrollHeight,
                    x: 0,
                    y: 5000
                    }).then(function(canvas) {
                    canvas.getContext('2d');

                    console.log(canvas.height+"  "+canvas.width);


                    var imgData = canvas.toDataURL("image/jpeg");
                    var pdf = new jspdf('p', 'mm',  [PDF_Width, PDF_Height]);
                    pdf.addImage(imgData, 'jpeg', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);


                    for (var i = 1; i <= totalPDFPages; i++) {
                        pdf.addPage();
                        pdf.addImage(imgData, 'jpeg', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                    }

                    // SAVE
                    pdf.save("HTML-Document.pdf");
                    //END GENERATE THE CONTRACT TO PDF

                    // Send information to PHP to save ON SERVER
                    var dataPdf = pdf.output('blob');

                    var formData = new FormData();
                    formData.append('pdf', dataPdf);

                        axios.post("/contracts", formData)
                            .then(response =>{
                                console.log(response);
                            });


                });

                // console.log(this.client.id);
                // SAVE CONTRACT
                // const { isEmptyContratada, dataContratada } = this.$refs.signaturePadContratada.saveSignature();
                // const { isEmptyContratante, dataContratante } = this.$refs.signaturePadContratante.saveSignature();
                // const { isEmptyResponsavel, dataResponsavel } = this.$refs.signaturePadResponsavel.saveSignature();

                // let signatures = [dataContratada, dataContratante, dataResponsavel];

                // axios.post("/contracts", signatures)
                // .then(response =>{
                //     console.log(response);
                // })

            }


        }
    }

</script>
