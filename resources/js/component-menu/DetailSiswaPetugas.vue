<template>
    <div class="container">

        <table class="table table-striped">
            <thead>
                <tr class="bg-secondary text-light text-center">
                    <th class="bg-secondary text-light h4" colspan="2">Biodata Siswa</th>
                </tr>
            </thead>
            <tbody v-for="data in siswa">
                <tr>
                    <th class="w-50">NISN</th>
                    <td>: {{ data.nisn }}</td>
                </tr>
                <tr>
                    <th>NIS</th>
                    <td>: {{ data.nis }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>: {{ data.nama }}</td>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <td>: {{ data.nama_kelas }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>: {{ data.alamat }}</td>
                </tr>
                <tr>
                    <th>No. Telphone</th>
                    <td>: {{ data.no_telp }}</td>
                </tr>
                <tr>
                    <th>Tahun Ajaran</th>
                    <td>: {{ data.tahun }}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button @click.prevent="kembali()" type="button" class="btn btn-outline-dark my-2 ml-2">
                            <i class="fas fa-backspace    "></i>

                        </button>
                    </td>
                </tr>
            </tbody>
        </table>


        <p class="alert alert-warning text-danger" role="alert">
            Menghapus data Siswa akan menghapus semua data transaksi siswa
        </p>
    </div>
</template>

<script>
export default {
    props: ['id'],
    data(){
        return{
            siswa:[],
        }
    },
    mounted(){
        this.getSiswa()
    },
    methods: {
        getSiswa(){
            axios.get('/api/siswa/detail/' + this.id).then((response)=>{
                this.siswa = response.data.siswa
                this.kelas = response.data.kelas
                this.spp = response.data.spp
            })
        },
        kembali(){
            this.$router.push({
                name: 'Siswa'
            })
        }
    }//end methods
}
</script>
