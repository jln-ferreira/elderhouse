<template>
    <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" :src="'images/images_profile/' + form.photo" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ form.name  }}</h3>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Followers</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#message" data-toggle="tab">Message</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                  <li class="nav-item"><a class="nav-link" href="#Information" data-toggle="tab">Information</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="message">

                    <!-- Post -->
                    <div class="post clearfix">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="" alt="User Image">
                        <span class="username">
                          <a href="#">Sarah Ross</a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                        <span class="description">Sent you a message - 3 days ago</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.
                      </p>

                      <form class="form-horizontal">
                        <div class="input-group input-group-sm mb-0">
                          <input class="form-control form-control-sm" placeholder="Response">
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-danger">Send</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.post -->

                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-danger">
                          10 Feb. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-envelope bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 12:05</span>

                          <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-user bg-info"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                          <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                          </h3>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-comments bg-warning"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                          <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                          <div class="timeline-body">
                            Take me to your leader!
                            Switzerland is small and neutral!
                            We are more like Germany, ambitious and misunderstood!
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-success">
                          3 Jan. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-camera bg-purple"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                          <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                          <div class="timeline-body">
                            <img src="" alt="...">
                            <img src="" alt="...">
                            <img src="" alt="...">
                            <img src="" alt="...">
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <div>
                        <i class="far fa-clock bg-gray"></i>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="Information">
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
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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
            axios.get('/settings/user')
                .then(response => {

                    this.form.id           = response.data.user.id;
                    this.form.name         =  response.data.user.name;
                    this.form.email        =  response.data.user.email;
                    this.form.photo        =  response.data.user.photo;
                    this.form.password     =  response.data.user.password;
                    this.form.street       =  response.data.address.street;
                    this.form.number       =  response.data.address.number;
                    this.form.city         =  response.data.address.city;
                    this.form.state        =  response.data.address.state;
                    this.form.country      =  response.data.address.country;

                });

        },


        methods: {

            onSubmitInfo(){
                    this.form
                        .post('/setting/user')
                        .then(user => {
                            this.$toaster.success('Successful added ' + user.name);
                        })
            },

        }
    }

</script>

<style>


</style>
