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
                        <!-- Button trigger modal -->
                        <button @click.prevent="editSiswa(data.id)" type="button" class="btn btn-outline-primary my-2 ml-2" data-toggle="modal" data-target="#modelEdit">
                            <i class="fas fa-user-edit"></i>
                        </button>
                        <button @click.prevent="hapusSiswa(data.id)" type="button" class="btn btn-outline-danger my-2 ml-2">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                        <button @click.prevent="kembali()" type="button" class="btn btn-outline-dark my-2 ml-2">
                            <i class="fas fa-backspace    "></i>
                        </button>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="modelEdit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Data SPP</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <form @submit.prevent="updateSiswa(siswaUpdate.id)" action="" method="post">
                                        <div class="modal-body">
                                            <!-- <div class="form-group">
                                                <label for="nisn">NISN</label>
                                                <input autocomplete="off" v-model="siswaUpdate.nisn" type="text" name="nisn" id="nisn" class="form-control" placeholder="" aria-describedby="helpId">
                                                <small v-if="errors.nisn" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errors.nisn[0] }}</small>
                                            </div> -->
                                            <div class="form-group">
                                                <label for="nis">NIS</label>
                                                <input autocomplete="off" v-model="siswaUpdate.nis" type="text" name="nis" id="nis" class="form-control" placeholder="" aria-describedby="helpId">
                                                <small v-if="errors.nis" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errors.nis[0] }}</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input autocomplete="off" v-model="siswaUpdate.nama" type="text" name="nama" id="nama" class="form-control" placeholder="" aria-describedby="helpId">
                                                <small v-if="errors.nama" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errors.nama[0] }}</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="kelas">Kelas</label>
                                                <select v-model="siswaUpdate.id_kelas" id="kelas" class="form-control">
                                                    <option value="" disabled>Pilih</option>
                                                    <option v-for="dKelas in kelas" :value="dKelas.id">
                                                        {{ dKelas.nama_kelas }}
                                                    </option>
                                                </select>
                                                <small v-if="errors.id_kelas" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errors.id_kelas[0] }}</small>
                                            </div>
                                            <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea v-model="siswaUpdate.alamat" id="alamat" cols="15" rows="5" class="form-control"></textarea>
                                                <small v-if="errors.alamat" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errors.alamat[0] }}</small>
                                            </div>
                                            <div class="form-group">
                                            <label for="telp">No Telphone</label>
                                            <input autocomplete="off" type="text" v-model="siswaUpdate.no_telp" id="telp" class="form-control" placeholder="" aria-describedby="helpId">
                                                <small v-if="errors.no_telp" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errors.no_telp[0] }}</small>
                                            </div>
                                            <div class="form-group">
                                            <label for="tahun">Tahun</label>
                                            <select class="form-control" v-model="siswaUpdate.id_spp" id="tahun">
                                                <option value="" disabled>Pilih</option>
                                                <option v-for="dSpp in spp" :value="dSpp.id">
                                                    {{ dSpp.tahun }}
                                                    </option>
                                            </select>
                                                <small v-if="errors.id_spp" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errors.id_spp[0] }}</small>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"  @click.prevent="resets()" data-dismiss="modal"><i class="fa fa-user-times" aria-hidden="true"></i> Close</button>
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save    "></i> Save</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
            siswaUpdate:{},
            tagihanSpp: {},
            pembayaran: {
                id_spp: '',
                nisn: '',
                nominal: '',
                tahun: ''
            }
        }
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
            axios.get('/api/siswa/detail/' + this.id).then((response)=>{
                this.siswa = response.data.siswa
                this.kelas = response.data.kelas
                this.spp = response.data.spp
            })
        },
        editSiswa(id){
            axios.get('/api/siswa/edit/' + id).then((response)=>{{
                this.siswaUpdate = response.data

            }})
        },
        updateSiswa(id){
            axios.put('/api/siswa/update/' + id, this.siswaUpdate).then((response)=>{
                if(response.data.status){
                    this.$swal("successfully", response.data.message, "success")

                    $('#modelEdit').modal('toggle');
                    this.getSiswa()
                }
            }).catch((error)=>{
                if(!error.response.data.status){
                    this.errors = error.response.data.message
                }
            })
        },
        hapusSiswa(id){
            this.$swal({
                title: "Apakah Anda Yakin?",
                text: "Setelah dihapus, Anda tidak akan dapat memulihkan data ini!",
                icon: "warning",
                showDenyButton: true,
            }).then((result)=>{
                if(result.isConfirmed){
                    axios.delete('/api/siswa/delete/' + id).then((response)=>{
                        if(response.data.status){
                            this.$swal("successfully", response.data.message, "success")
                            this.kembali()
                            this.getSiswa()
                        }
                    }).catch((error)=>{
                        if(!error.response.data.status){
                            this.$swal("Error", response.data.message, "error")
                        }
                    })

                }else{
                    return false;
                }
            })
        },
        kembali(){
            this.$router.push({
                name: 'siswa'
            })
        }
    }//end methods
}
</script>
