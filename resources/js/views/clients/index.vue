<template>
    <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Clients</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Clients</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-1">
          <div class="row d-flex align-items-stretch">

            <!-- CARD CLIENT -->
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch" v-for="client in clients" v-bind:key="client.id">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                  Appartament <span class="badge badge-primary">{{ client.appartament }}</span>
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h3><b>{{ client.name }} {{ client.surname }}</b></h3>

                      <hr>

                      <p class="text-muted"><i class="fas fa-birthday-cake" style="color: #2b2b2b;"></i> <b>Databirth: </b> {{ client.databirth }}</p>
                      <p class="text-muted"><i v-if="client.gender =='male'" class="fas fa-male fa-2x" style="color: #1464f4;"></i><i v-else class="fas fa-female fa-2x"  style="color: #ff1493;"></i> <b>Gender:</b> {{ client.gender }}</p>
                      <p class="text-muted"><i class="fas fa-lg fa-phone" style="color: #2b2b2b;"></i> <b>Phone:</b> {{ client.phonenumber }}</p>
                      <p class="text-muted"><i class="far fa-calendar-alt" style="color: #2b2b2b;"></i> <b>Datastart: </b> {{ client.datastart }}</p>

                    </div>
                    <div class="col-5 text-center">
                      <img v-if="client.url" :src="'/storage/storage/uploads/images_clients/' + client.url" alt="" class="img-circle img-fluid">
                      <img v-else :src="'images/AdminLTELogo.png'" alt="" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="#" class="btn btn-sm bg-teal">
                      <i class="fas fa-comments"></i>
                    </a>
                    <a @click="gotoProfile(client.client_id)" class="btn btn-sm btn-primary text-white" >
                      <i class="fas fa-user"></i> View Profile
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <!-- END CARD CLIENT -->

          </div>

          <div class="row float-right">
              <button @click="gotoCreate" class="btn btn-warning"><i class="fas fa-users"></i> <b>New Client</b></button>
          </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer"></div>
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->


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

            // Fetch especific User / address / role -> auth
            axios.get('/clients')
                .then(response => this.clients = response.data);
        },


        methods: {

            gotoProfile(id)
            {
                this.$router.push('/clients/' + id);
            },
            gotoCreate()
            {
                this.$router.push('/newclient/');
            },

        }
    }

</script>

<style>


</style>
