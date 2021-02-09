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
        <div class="card-body pb-0">
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
                      <p class="text-muted text-sm"><b>Databirth: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="far fa-calendar-alt"></i></span> {{ client.datastart }}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="" alt="" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="#" class="btn btn-sm bg-teal">
                      <i class="fas fa-comments"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-primary">
                      <i @click="gotoProfile(client.id)" class="fas fa-user"></i> View Profile
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <!-- END CARD CLIENT -->

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
                .then(response => {
                    console.log(response.data)
                    this.clients = response.data
                });

        },


        methods: {

            gotoProfile(id){
                this.$router.push('/clients/' + id);
            },

        }
    }

</script>

<style>


</style>
