<template>
    <div>
        <h1>{{clientId}}</h1>
  </div>
</template>

// <script>

    export default {

        data() {
            return {
                clientId: this.$route.params.id,

            }
        },


        created() {
            // Fetch especific CLIENT
            axios.get('/clients/' + this.clientId)
                .then(response => console.log(response));
        },


    }

</script>

