<template>
  <div class="container">
    <p role="alert" class="alert alert-info h2">CARI DATA PEMBAYARAN BERDASARKAN NISN</p>

    <form @submit.prevent="getSearch()">
      <div class="form-group m-4">
        <div class="row">
          <div class="col-md  mt-2">
            <input type="text" v-model="nisn" id="nisn" class="form-control" placeholder="Masukan NISN *" autocomplete="off" autofocus/>
          </div>
          <div class="col-md-1 mt-2">
            <button type="submit" class="btn btn-primary px-4 text-light"><i class="fa fa-search" aria-hidden="true"></i></button>
          </div>
        </div>

      </div>
    </form>
  </div>
</template>
<script>
export default {
    data(){
        return{
            nisn:''
        }
    },
    methods:{
        getSearch(){
            axios.get('/api/search/' + this.nisn).then((response)=>{

                if(response.data.status){
                    this.$router.push({
                        name: 'bayar',
                        params: {nisn: this.nisn}
                    })
                }else{
                    this.$swal({
                    title: "INVALID",
                    text: "NISN tidak ditemukan!",
                    icon: "error"
                })
                this.nisn = ''
                }
            }).catch((error)=>{
                this.$swal({
                    title: "ERROR",
                    text: error.response.data.message,
                    icon: "error"
                })
            })
        }
    }
}
</script>
