<template>
    <div>
        <form class="form-horizontal" @submit.prevent="onSubmitInfo">
            <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="Name" v-model="form.name">
                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" placeholder="Email" v-model="form.email" disabled>
                </div>
            </div>
            <div class="form-group row">
            <label for="pass" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="pass" placeholder="Password">
                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('password')" v-text="form.errors.get('password')"></span>
                </div>
            </div>

            <hr>

        <!-- ADDRESS` -->

            <div class="form-group row">
                <label for="street" class="col-sm-2 col-form-label">Street</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="street" placeholder="Street" v-model="form.street">
                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('street')" v-text="form.errors.get('street')"></span>
                </div>
                <div class="col-sm-2">
                    <input type="number" class="form-control" id="number" placeholder="number" v-model="form.number">
                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('number')" v-text="form.errors.get('number')"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputSkills" class="col-sm-2 col-form-label">City/ State/ Country</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="city" placeholder="City" v-model="form.city">
                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('city')" v-text="form.errors.get('city')"></span>
                </div>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="state" placeholder="State" v-model="form.state">
                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('state')" v-text="form.errors.get('state')"></span>
                </div>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="country" placeholder="Country" v-model="form.country">
                    <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('country')" v-text="form.errors.get('country')"></span>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <button type="save" class="btn btn-danger">Submit</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>

    export default {

        data() {

            return {

                form: new Form({
                    'id':'',
                    'name': '',
                    'email': '',
                    'photo': '',
                    'password': '',
                    'street': '',
                    'number': '',
                    'city': '',
                    'state': '',
                    'country': '',
                })
            }

        },


        created() {

            // Fetch especific User / address / role -> auth
            axios.get('/profile/user')
                .then(response => {

                    this.form.id       = response.data.user.id;
                    this.form.name     =  response.data.user.name;
                    this.form.email    =  response.data.user.email;
                    this.form.photo    =  response.data.user.photo;
                    this.form.password =  response.data.user.password;
                    this.form.street   =  response.data.address.street;
                    this.form.number   =  response.data.address.number;
                    this.form.city     =  response.data.address.city;
                    this.form.state    =  response.data.address.state;
                    this.form.country  =  response.data.address.country;

                    // send form to parent component
                    this.$emit("formClient", this.form);

                });

        },


        methods: {

            onSubmitInfo()
            {
                this.form
                    .post('/profile/user')
                    .then(response => {

                        this.form.id       = response.user.id;
                        this.form.name     =  response.user.name;
                        this.form.email    =  response.user.email;
                        this.form.photo    =  response.user.photo;
                        this.form.password =  response.user.password;
                        this.form.street   =  response.address.street;
                        this.form.number   =  response.address.number;
                        this.form.city     =  response.address.city;
                        this.form.state    =  response.address.state;
                        this.form.country  =  response.address.country;

                        this.$toaster.success('Saved!');
                    })
            },

        }
    }

</script>
