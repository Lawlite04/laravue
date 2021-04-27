<template>
    <div class="container">
        <p role="alert" class="alert alert-info h2">History Pembayaran</p>

        <div class="row">
            <div class="col-md">
                <div class="row justify-content-end">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-search    "></i>
                                    </div>
                                </div>
                                <input type="text" v-model="cari"  class="form-control" placeholder="Cari Nama" aria-describedby="helpId">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <form @submit.prevent="cariTgl()">
                    <div class="row justify-content-end">
                        <div class="col-sm-6">
                            <div class="form-group">
                              <input type="date" v-model="tgl.tanggal"  class="form-control" placeholder="" aria-describedby="helpId">
                              <p v-if="errors.tanggal" class="text-danger">{{ errors.tanggal[0] }}</p>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
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
                    <td colspan="7" class="text-center text-danger py-2 font-weight-bold border">Data tidak ditemukan</td>
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
            cari: ''
            ,
            errors:{}
        }
    },
    mounted(){
        this.getHistory()
    },
    watch:{
        cari: _.debounce(function(){
            this.getHistory()
        }, 300)
    },
    methods:{
        getHistory(){
            let param = _.isEmpty(this.cari) ? 'all' : this.cari
            axios.get('/api/history/' + param).then((response)=>{
                this.history = response.data
            })
        },
        cariTgl(){
            axios.post('/api/cari/tgl', this.tgl).then((response)=>{
                this.history = response.data

            }).catch((error)=>{
                if(!error.response.data.status){
                    this.errors = error.response.data.message
                }

            })

        },
        cariNama(){
            axios.get('/api/search/nama/' + this.cari).then((response)=>{
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
