<template>
    <div class="container">
        <p role="alert" class="alert alert-info h2">Welcome </p>

        <div class="row justify-content-around my-4">
            <div class="col-md-3 m-2 bg-info rounded p-4 text-light">
                <i class="fas fa-coins h1"></i>
                <h3>Data SPP</h3>
                <h5>Jumlah : {{ spp.spp }}</h5>
            </div>
            <div class="col-md-3 m-2  bg-dark rounded p-4 text-light">
                <i class="fas fa-book-reader h1"></i>
                <h3>Data Kelas</h3>
                <h5>Jumlah : {{ kelas.kelas }}</h5>
            </div>
            <div class="col-md-3 m-2 bg-secondary rounded p-4 text-light">
                <i class="fas fa-users-cog h1"></i>
                <h3>Data Petugas</h3>
                <h5>Jumlah : {{ petugas.petugas }}</h5>
            </div>
        </div>
        <div class="row justify-content-around my-4">
            <div class="col-md-3 m-2 bg-danger rounded p-4 text-light">
                <i class="fa fa-users h1" aria-hidden="true"></i>
                <h3>Data Siswa</h3>
                <h5>Jumlah : {{ siswa.siswa }}</h5>
            </div>
            <div class="col-md-3 m-2 bg-success rounded p-4 text-light">
                <i class="fas fa-donate h1"></i>
                <h3>Pembayaran</h3>
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
            spp:{},
            kelas:{},
            petugas:{},
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
                this.spp = response.data.spp[0]
                this.kelas = response.data.kelas[0]
                this.petugas = response.data.petugas[0]
                this.siswa = response.data.siswa[0]
                this.pembayaran = response.data.pembayaran[0]
            })
        }
    }
}
</script>
