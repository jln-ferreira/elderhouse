<template>
    <div>
        <!-- ---------------------- -->
        <!-- ADD NEW PAYMENTS -->
        <!-- ---------------------- -->
        <div class="col-lg-12">

            <div class="card card-dark" style="cursor:pointer;">
                <div class="card-header" @click="newPaymentToggle">
                    <h3 class="card-title font-weight-bold">New Payment Form</h3> <i :class="[faChanging(), 'float-right']" aria-hidden="true"></i>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <transition name="block">

                    <form class="form-horizontal" @submit.prevent="onSubmit" @keydown="form.errors.clear()" v-show="isShowing">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="clientName">Client Name</label>
                                    <select class="form-control" v-model="form.clientId" id="clientName" name="clientName" required>
                                        <option v-for="client in clients" v-bind:key="client.id" :value="client.id">{{client.name + " " + client.surname}}</option>
                                    </select>
                                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('clientName')" v-text="form.errors.get('clientName')"></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="precification">Product</label>
                                    <select class="form-control" v-model="form.precificationId" id="precification" name="precification" @change="onChange($event)" required>
                                        <option v-for="precification in precifications" v-bind:key="precification.id" :price="precification.price" :value="precification.id">{{precification.name}}</option>
                                    </select>
                                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('clientName')" v-text="form.errors.get('clientName')"></span>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="value">Value</label>
                                    <input type="number" class="form-control" id="value" name="value" placeholder="2050,40" min="1" v-model="form.value" required>
                                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('value')" v-text="form.errors.get('value')"></span>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control" id="date" name="date" v-model="form.date" required>
                                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('date')" v-text="form.errors.get('date')"></span>
                                </div>
                            </div>
                            <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="name">Comment</label>
                                    <input type="text" class="form-control" id="comment" name="comment" v-model="form.comment">
                                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('comment')" v-text="form.errors.get('comment')"></span>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="save" v-show="this.newPayment" class="btn btn-success"><i class="fa fa-plus"></i> Save</button>
                            <a type="edit" v-show="!this.newPayment" class="btn btn-primary text-white" @click="modifyPrecification"><i class="far fa-edit"></i> Edit</a>
                            <a type="cancel" v-show="!this.newPayment" class="btn btn-warning text-white" @click="cancelEdit"><i class="fa fa-times"></i> Cancel</a>
                        </div>
                        <!-- /.card-footer -->
                    </form>

                </transition>
            </div>

        </div>
        <!-- END ADD NEW Precification -->


        <!-- ---------------------- -->
        <!-- LIST PRECIFICATION -->
        <!-- ---------------------- -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">List Precification</h3>

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
                    <table class="table table-hover text-center">
                        <thead>
                        <tr>
                            <th class="clickHeader" @click="sortBy('id')">ID</th>
                            <th class="clickHeader" @click="sortBy('clientName')">Name</th>
                            <th class="clickHeader" @click="sortBy('precificationName')">Product</th>
                            <th class="clickHeader" @click="sortBy('price')">Price</th>
                            <th class="clickHeader" @click="sortBy('date')">Date</th>
                            <th class="clickHeader" @click="sortBy('comment')">Comment</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(precification, index) in filteredList" v-bind:key="precification.id">
                                <td>{{precification.id}}</td>
                                <td>{{precification.clientName + " " + precification.clientSurname}}</td>
                                <td>{{precification.precificationName}}</td>
                                <td>{{precification.price}}</td>
                                <td>{{precification.date}}</td>
                                <td>{{precification.comment}}</td>
                                <td>
                                    <button type="edit" class="btn btn-primary" @click="editPayment(index)"><i class="far fa-edit"></i></button>
                                    <a type="delete" class="btn btn-danger text-white" @click="deletePayment(precification.id)"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- END LIST PAYMENT -->
    </div>
</template>

<script>

    export default {

        data() {

            return {
                isShowing: false,
                newPayment: true,
                search:'',
                sort: {
                    key: '',
                    isAsc: 'asc'
                },

                precifications: [],
                clients       : [],
                payments      : [],
                form: new Form({
                    'id'                : '',
                    'clientId'          : '',
                    'precificationId'   : '',
                    'value'             : '',
                    'date'              : '',
                    'comment'           : '',
                })
            }

        },


        created()
        {
            // Fetch all payments
            axios.get('/payments')
                .then(response => this.payments = response.data);
            // Fetch all precification
            axios.get('/precifications')
                .then(response => this.precifications = response.data);
            // Fetch all clients
            axios.get('/clients')
                .then(response => this.clients = response.data);

        },


        computed: {
            filteredList()
            {
                if(this.search){
                    console.log(this.payments)
                    return this.payments.filter(post => {
                        return post.clientName.toLowerCase().includes(this.search.toLowerCase());   //SEARCH FILTER
                    });
                }

                else if(this.sort.key) return _.orderBy(this.payments, this.sort.key, this.sort.isAsc);  //SORT

                else return this.payments;                                                               //ALL PRODUCTS
            }
        },


        methods: {
            newPaymentToggle()
            {
                this.isShowing = !this.isShowing;
            },
            faChanging(){
                return (this.isShowing == true) ? "fa fa-minus" : "fa fa-plus";
            },

            onChange(event) {
                var options = event.target.options
                if (options.selectedIndex > -1) this.form.value = options[options.selectedIndex].getAttribute('price');
            },

            //----------------------------
            sortBy(key) {
                this.sort.isAsc = (this.sort.key == key) ? "desc" : "asc";
                this.sort.key = key;
            },

            // ----- ADD  -----
            onSubmit()
            {
                this.form
                    .post('/payments')
                    .then(response => {
                        this.payments.push(response[0]);
                        this.isShowing = false;
                        this.$toaster.success('Successful added');
                    })
            },


            // -----DELETE-----
            deletePayment(id)
            {
                axios.post('/precifications/' + id, {
                _method: 'DELETE'
                })
                .then(response => {
                    var count = 0
                    this.precifications.forEach(element => {
                        element.id == (response.data.id) ? this.precifications.splice(count,1) : count +=1;
                    });

                    this.isShowing = false;
                    this.newPayment = true;
                    this.$toaster.success('Successful deleted ' + response.data.name);
                });
            },



            // -----EDIT-----
            editPayment(index)
            {
                this.isShowing = true;                    //open new precifications
                this.newPayment = false;              //button cancel and edit show

                let precifications = this.precifications[index];  //precifications clicked

                //show values precifications
                this.form.id      = precifications.id;
                this.form.name    = precifications.name;
                this.form.price   = precifications.price;
                this.form.comment = precifications.comment;
            },


            //-------- MODIFY --------
            modifyPrecification()
            {
               this.form
                    .patch('/precifications')
                    .then(response => {
                        this.precifications.find(precification => precification.id == response.id).name = response.name;
                        this.precifications.find(precification => precification.id == response.id).price = response.price;
                        this.precifications.find(precification => precification.id == response.id).comment = response.comment;
                        this.isShowing = false;
                        this.newPayment   = true;
                        this.$toaster.success('Successful Updated ' + response.name);
                    });
            },


            cancelEdit()
            {
                this.newPayment = true; //show button add precifications
                this.isShowing = false;

                // clean form
                this.form.id      = '';
                this.form.name    = '';
                this.form.price   = '';
                this.form.comment = '';
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

        /* table */
    .clickHeader{
        transition: 0.5s;
        cursor: pointer;
    }
    .clickHeader:active{
        opacity: 0.3;
        font-size: 10%;
    }
    /* ----- */


</style>
