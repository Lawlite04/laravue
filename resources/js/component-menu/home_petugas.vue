<template>
    <div class="container">
        <p role="alert" class="alert alert-info h2">Welcome </p>
        <div class="row justify-content-around my-4">
            <div class="col-md-3 m-2 bg-success rounded p-4 text-light">
                <i class="h1 fa fa-users" aria-hidden="true"></i>
                <h4>Data Siswa</h4>
                <h5>Jumlah : {{ siswa.siswa }}</h5>
            </div>
            <div class="col-md-3 m-2 bg-secondary rounded p-4 text-light">
                <i class="h1 fas fa-donate    "></i>
                <h4>Data Pembayaran</h4>
                <h5>Jumlah : {{ pembayaran.pembayaran }}</h5>
            </div>
            <div class="col-md-3">

            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            siswa:{},
            pembayaran:{},
        }
    },
    mounted(){
        this.getData()
    },
    methods:{
        getData(){
            axios.get('/api/dashboardAdmin').then((response)=>{
                this.siswa = response.data.siswa[0]
                this.pembayaran = response.data.pembayaran[0]
            })
        }
    }
}
</script>
