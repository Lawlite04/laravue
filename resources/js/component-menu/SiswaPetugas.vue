<template>
    <div class="container">
        <p role="alert" class="alert alert-info h2">Data Siswa</p>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </div>
                </div>
                <input type="search" v-model="cari" class="form-control w-50" placeholder="Cari berdasarkan nama" aria-describedby="helpId">
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr class="bg-secondary text-light text-center">
                    <th>No</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody v-if="siswa[0]">
                <tr v-for="data,index in siswa">
                    <td>{{++index}}</td>
                    <td>{{ data.nisn }}</td>
                    <td>{{ data.nama }}</td>
                    <td>{{ data.nama_kelas }}</td>
                    <td>
                        <button class="btn btn-primary" @click.prevent="detailSiswa(data.id)">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
            <tbody v-else>
                <td colspan="5" class="text-danger font-italic text-center py-2 border">Data tidak ditemukan</td>
            </tbody>
        </table>


        <p class="alert alert-warning text-danger" role="alert">
            Menghapus data Siswa akan menghapus semua data transaksi siswa
        </p>
    </div>
</template>

<script>
export default {
    data(){
        return{
            siswa:[],
            kelas:[],
            spp:[],
            cari: ''
        }
    },
    mounted(){
        this.getSiswa()
    },
    watch:{
        cari: _.debounce(function(){
            this.getSiswa()

        }, 300)
    },
    methods: {
        getSiswa(){
            let param = _.isEmpty(this.cari) ? 'all' : this.cari;
            axios.get('/api/siswa/' + param).then((response)=>{
                this.siswa = response.data.siswa
                this.kelas = response.data.kelas
                this.spp = response.data.spp
            })
        },
        detailSiswa(id){
            this.$router.push({
                name: 'SiswaDetail',
                params: {id}
            })

        }
    }//end methods
}
</script>
