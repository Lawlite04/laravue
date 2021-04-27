<template>
    <div class="container">
        <div class="row">
            <div class="col-md">
                <table class="table border table-striped">
                    <thead>
                        <tr>
                            <th colspan="4" class="bg-secondary h4 text-light">
                                <i class="fa fa-user" aria-hidden="true"></i> Biodata Siswa
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>NISN  </td>
                            <td>: </td>
                            <td>{{ tagihan[0].nisn }} </td>
                        </tr>
                        <tr>
                            <td>NIS  </td>
                            <td>: </td>
                            <td>{{ tagihan[0].nis }} </td>
                        </tr>
                        <tr>
                            <td>Nama  </td>
                            <td>: </td>
                            <td>{{ tagihan[0].nama }} </td>
                        </tr>
                        <tr>
                            <td>Kelas  </td>
                            <td>: </td>
                            <td>{{ tagihan[0].nama_kelas }} </td>
                        </tr>
                        <tr>
                            <td>Alamat  </td>
                            <td>: </td>
                            <td>{{ tagihan[0].alamat }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-md">
                <p class="bg-dark rounded text-light h4 p-3">
                    <i class="fas fa-file-invoice-dollar    "></i> Tagihan Siswa</p>
                <table class="table table-striped table-hover">
                    <thead class="thead-inverse">
                        <tr class="bg-secondary text-light text-center">
                            <th class="border">No</th>
                            <th class="border">Bulan</th>
                            <th class="border">Tahun</th>
                            <th class="border">Nominal</th>
                            <th class="border">Tanggal Dibayar</th>
                            <th class="border">Keterangan</th>
                            <th class="border">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="data,index in tagihan">
                                <td class="border">{{ ++index }}</td>
                                <td class="border">{{ data.bulan_dibayar }}</td>
                                <td class="border">{{ data.tahun }}</td>
                                <td class="border">{{ data.nominal | currency }}</td>
                                <td class="border">{{ data.tgl_bayar }}</td>
                                <td class="border text-danger font-weight-bold">{{ data.tahun_dibayar }}</td>

                                <td v-if="data.tahun_dibayar" class="border">
                                    <button @click.prevent="pdf(data.id)" class="btn btn-primary text-light">
                                        Cetak
                                    </button>
                                    <button @click.prevent="batal(data.id)" class="btn btn-outline-primary">
                                        Batal
                                    </button>
                                </td>
                                <td v-else class="border">
                                    <button @click.prevent="pembayaran(data.id)" class="btn btn-success">
                                         Bayar
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                </table>
            </div>
        </div>

        <router-link :to="{name: 'transaksi'}" class="btn btn-info px-4 py-2 text-light mb-2">Kembali</router-link>
    </div>
</template>

<script>
export default {
    props: ['nisn'],
    data(){
        return{
            tagihan:[],
        }
    },
    mounted(){
        this.getBiodata()
    },
    methods:{
        getBiodata(){

            axios.get('/api/pembayaran/' + this.nisn).then((response)=>{
                this.tagihan = response.data
            })
        },
        pembayaran(id){
            axios.get('/api/bayar/spp/' + id).then((response)=>{
                if(response.data.status){
                    this.$swal({
                        title: "Successfully",
                        text: response.data.message,
                        icon: "success"
                    })
                    this.getBiodata()
                }

            })
        },
        pdf(id){
            this.$router.push({
                name: 'laporan',
                params: {id}
            })
        },
        batal(id){

            axios.get('/api/batal/spp/' + id).then((response)=>{
                if(response.data.status){
                    this.$swal({
                        title: "Successfully",
                        text: response.data.message,
                        icon: "success"
                    })
                    this.getBiodata()
                }

            })
        }
    }
}
</script>
