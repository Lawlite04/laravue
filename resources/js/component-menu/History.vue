<template>
    <div class="container">
        <p role="alert" class="alert alert-info h2">History Pembayaran</p>

        <div class="row">
            <div class="col-md-4" >
                <button id="cetak" class="btn btn-outline-primary px-4 py-2 mb-2" @click.prevent="cetak()">
                    <i class="fa fa-print" aria-hidden="true"></i> Print
                </button>
                <!-- <a href="/pdf" class="btn btn-success ml-2 px-4 py-2 mb-3">Cetak Laporan</a> -->
            </div>
            <div class="col-md">
                <form @submit.prevent="cariTgl()">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group" id="cari">
                              <input type="date" v-model="tgl.tanggal"  class="form-control" placeholder="" aria-describedby="helpId">
                              <p v-if="errors.tanggal" class="text-danger">{{ errors.tanggal[0] }}</p>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button id="btnCari" class="btn btn-primary" type="submit">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr class="border bg-secondary text-light">
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Bulan Tagihan</th>
                    <th>Tahun</th>
                    <th>Tanggal Bayar</th>
                    <th>Nominal</th>
                    <!-- <th>Hapus History</th> -->
                </tr>
            </thead>
            <tbody v-if="history[0]">
                <tr v-for="data,index in history">
                    <td>{{ ++index }}</td>
                    <td>{{ data.nama }}</td>
                    <td>{{ data.nama_kelas }}</td>
                    <td>{{ data.bulan_dibayar }}</td>
                    <td>{{ data.tahun }}</td>
                    <td>{{ data.tgl_bayar }}</td>
                    <td>{{ data.nominal | currency }}</td>
                    <!-- <td>
                        <button @click.prevent="hapus(data.id)" class="btn btn-danger text-light text-sm">Hapus</button>
                    </td> -->
                </tr>
            </tbody>
            <tbody v-else>
                <tr>
                    <td colspan="7" class="text-center text-danger py-2 font-weight-bold border">Data Tidak Ditemukan</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data(){
        return{
            history:[],
            tgl: {
                tanggal: ''
            },
            errors:{},
            cari: ''
        }
    },
    mounted(){
        this.getHistory()
    },
    methods:{
        getHistory(){
            let param = _.isEmpty(this.cari) ? 'all' : this.cari
            axios.get('/api/history/' + param).then((response)=>{
                this.history = response.data
            })
        },
        // hapus(id){
        //     if(confirm('Apakah Anda Yakin??')){
        //             axios.delete('/api/history/hapus/' + id).then((response)=>{
        //             if(response.data.status){
        //                 this.$noty.info(response.data.message,{
        //                     killer:true,
        //                     timeout:3000,
        //                     layout: 'topLeft'
        //                 })
        //                 this.getHistory()
        //             }
        //         })
        //     }else{
        //         return false
        //     }
        // },
        // deleteAll(){
        //     if(confirm('Apakah Anda yakin ingin menghapus semua history pembayaran? Semua history akan terhapus!')){
        //         axios.delete('/api/history/hapusAll').then((response)=>{
        //             if(response.data.status){
        //                 this.$noty.error(response.data.message)
        //                 this.getHistory()
        //             }
        //         })
        //     }else{
        //         return false
        //     }
        // },
        cetak(){
            document.getElementById("cetak").style.display = "none";
            document.getElementById("cari").style.display = "none";
            document.getElementById("btnCari").style.display = "none";
            window.print()
            setTimeout((e) => {
                document.getElementById("cetak").style.display = "inherit";
                document.getElementById("cari").style.display = "inherit";
                document.getElementById("btnCari").style.display = "inherit";
            }, 300);
        },
        cariTgl(){
            axios.post('/api/cari/tgl', this.tgl).then((response)=>{
                this.history = response.data

            }).catch((error)=>{
                if(!error.response.data.status){
                    this.errors = error.response.data.message
                }

            })

        }

    } //end method
}
</script>
