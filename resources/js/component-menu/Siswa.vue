<template>
    <div class="container">
        <p role="alert" class="alert alert-info h2">Data Siswa</p>
        <div class="row justify-content-around">
            <div class="col-md-4">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modelTambah">
                <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                </button>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-search    "></i>
                            </div>
                        </div>
                        <input type="search" v-model="cari" class="form-control" placeholder="Cari berdasarkan nama" aria-describedby="helpId">
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modelTambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Siswa</h5>
                            <button @click.prevent="resets()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <form @submit.prevent="createSiswa()" action="" method="post">
                        <div class="modal-body">
                                <div class="form-group">
                                    <label for="nisn">NISN</label>
                                    <input autocomplete="off" v-model="tambahSiswa.nisn" type="text" name="nisn" id="nisn" class="form-control" placeholder="" aria-describedby="helpId">
                                    <small v-if="errors.nisn" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errors.nisn[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <label for="nis">NIS</label>
                                    <input autocomplete="off" v-model="tambahSiswa.nis" type="text" name="nis" id="nis" class="form-control" placeholder="" aria-describedby="helpId">
                                    <small v-if="errors.nis" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errors.nis[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input autocomplete="off" v-model="tambahSiswa.nama" type="text" name="nama" id="nama" class="form-control" placeholder="" aria-describedby="helpId">
                                    <small v-if="errors.nama" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errors.nama[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <select v-model="tambahSiswa.id_kelas" id="kelas" class="form-control">
                                        <option value="">Pilih</option>
                                        <option v-for="dKelas in kelas" :value="dKelas.id">
                                            {{ dKelas.nama_kelas }}
                                        </option>
                                    </select>
                                    <small v-if="errors.id_kelas" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errors.id_kelas[0] }}</small>
                                </div>
                                <div class="form-group">
                                  <label for="alamat">Alamat</label>
                                  <textarea v-model="tambahSiswa.alamat" id="alamat" cols="15" rows="5" class="form-control"></textarea>
                                    <small v-if="errors.alamat" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errors.alamat[0] }}</small>
                                </div>
                                <div class="form-group">
                                  <label for="telp">No Telphone</label>
                                  <input autocomplete="off" type="text" v-model="tambahSiswa.no_telp" id="telp" class="form-control" placeholder="" aria-describedby="helpId">
                                    <small v-if="errors.no_telp" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errors.no_telp[0] }}</small>
                                </div>
                                <div class="form-group">
                                  <label for="tahun">Tahun</label>
                                  <select class="form-control" v-model="tambahSiswa.id_spp" id="tahun">
                                      <option value="">Pilih</option>
                                      <option v-for="dSpp in spp" :value="dSpp.id">
                                          {{ dSpp.tahun }}
                                        </option>
                                  </select>
                                    <small v-if="errors.id_spp" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errors.id_spp[0] }}</small>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"  @click.prevent="resets()" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save    "></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr class="bg-secondary text-light text-center">
                    <th class="border">No</th>
                    <th class="border">NISN</th>
                    <th class="border">Nama</th>
                    <th class="border">Kelas</th>
                    <th class="border">Action</th>
                </tr>
            </thead>
            <tbody v-if="siswa[0]">
                <tr v-for="data,index in siswa">
                    <td class="border">{{ ++index }}</td>
                    <td class="border">{{ data.nisn }}</td>
                    <td class="border">{{ data.nama }}</td>
                    <td class="border">{{ data.nama_kelas }}</td>
                    <td class="border">
                        <button @click.prevent="detail(data.id)" class="btn btn-primary">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </button>
                        <button @click.prevent="hapusSiswa(data.id)" class="btn btn-danger">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
            <tbody v-else>
                <tr>
                    <td colspan="5" class="text-center text-danger py-2 font-weight-bold border">Data Tidak Ditemukan</td>
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
    data(){
        return{
            siswa:[],
            kelas:[],
            spp:[],
            tambahSiswa:{
                nisn: '',
                nis: '',
                nama: '',
                id_kelas: '',
                alamat: '',
                no_telp: '',
                id_spp: ''
            },
            errors:{},
            cari: ''
        }
    },
    watch:{
        cari: _.debounce(function(){
            this.getSiswa()
        }, 300)
    },
    mounted(){
        this.getSiswa()
    },
    methods: {
        resets(){
            this.tambahSiswa.nisn= '',
            this.tambahSiswa.nis= '',
            this.tambahSiswa.nama= '',
            this.tambahSiswa.id_kelas= '',
            this.tambahSiswa.alamat= '',
            this.tambahSiswa.no_telp= '',
            this.tambahSiswa.id_spp= ''
        },
        getSiswa(){
            let param = _.isEmpty(this.cari) ? 'all' : this.cari;
            axios.get('/api/siswa/' + param).then((response)=>{
                this.siswa = response.data.siswa
                this.kelas = response.data.kelas
                this.spp = response.data.spp
            })
        },
        createSiswa(){
            axios.post('/api/siswa/create', this.tambahSiswa).then((response)=>{
                if(response.data.status){
                    this.$swal("successfully", response.data.message, "success")
                    $('#modelTambah').modal('toggle')
                    this.getSiswa()
                }
                this.resets()
                this.tagihanSpp = response.data
            }).catch((error)=>{
                if(!error.response.data.status){
                    this.errors = error.response.data.message
                }
            })
        },
        hapusSiswa(id){
            this.$swal({
                title: "Apakah Anda Yakin?",
                text: "Setelah dihapus, Anda tidak dapat memulihkan data ini",
                icon: "warning",
                showDenyButton: true,
            }).then((result)=>{
                if(result.isConfirmed){
                    axios.delete('/api/siswa/delete/' + id).then((response)=>{
                        if(response.data.status){
                            this.$swal("successfully", response.data.message, "success")
                            this.getSiswa()
                        }
                    }).catch((error)=>{
                        if(!error.response.data.status){
                            this.$swal("Error", response.data.message, "error")
                        }
                    })
                }else{
                    return false
                }
            })
        },
        detail(id){
            this.$router.push({
                name: 'DetailSiswa',
                params: {id}
            })
        }
    }//end methods
}
</script>
