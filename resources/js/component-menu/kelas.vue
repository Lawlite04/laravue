<template>
    <div class="container">
        <p role="alert" class="alert alert-info h2">Data Kelas</p>
        <!-- Button trigger modal -->
        <div class="row justify-content-around">
            <div class="col-md-4">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modelTambah">
                <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                </button>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-search    "></i>
                            </div>
                        </div>
                        <input type="search" v-model="cari" class="form-control" placeholder="Masukan Nama Kelas *" aria-describedby="helpId">
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Tambah -->
        <div class="modal fade" id="modelTambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Kelas</h5>
                            <button type="button" class="close" @click.prevent="resets()" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <form @submit.prevent="createKelas()" action="" method="post">
                        <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama">Nama Kelas</label>
                                    <input autocomplete="off" v-model="tambahKelas.nama_kelas" type="text" name="nama_kelas" id="nama" class="form-control" placeholder="" aria-describedby="helpId">
                                    <small v-if="errors.nama_kelas" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errors.nama_kelas[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <label for="jurusan">Kompetensi Keahlian</label>
                                    <input autocomplete="off" v-model="tambahKelas.kompetensi_keahlian" type="text" name="kompetensi_keahlian" id="jurusan" class="form-control" placeholder="" aria-describedby="helpId">
                                    <small v-if="errors.kompetensi_keahlian" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errors.kompetensi_keahlian[0] }}</small>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"  @click.prevent="resets()" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <table class="table table-striped table-hover">
            <thead>
                <tr class="bg-secondary text-center text-light">
                    <th class="border">No</th>
                    <th class="border">Nama Kelas</th>
                    <th class="border">Kompetensi Keahlian</th>
                    <th class="border">Action</th>
                </tr>
            </thead>
            <tbody v-if="kelas[0]">
                <tr v-for="data,index in kelas">
                    <td>{{ ++index }}</td>
                    <td>{{ data.nama_kelas }}</td>
                    <td>{{ data.kompetensi_keahlian }}</td>
                    <td>
                        <!-- Button trigger modal -->
                        <button @click.prevent="editData(data.id)" type="button" class="my-1 btn btn-primary text-light" data-toggle="modal" data-target="#modelEdit">
                        <i class="fas fa-edit" aria-hidden="true"></i>
                        </button>
                        <button class="my-1 btn btn-danger" @click.prevent="hapus(data.id)">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
            <tbody v-else>
                <tr>
                    <td colspan="4" class="text-center text-danger py-2 font-weight-bold border">Data Tidak Ditemukan</td>
                </tr>
            </tbody>
        </table>

        <!-- Modal Edit -->
        <div class="modal fade" id="modelEdit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Kelas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <form @submit.prevent="updateKelas(editKelas.id)" action="" method="post">
                        <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama">Nama Kelas</label>
                                    <input autocomplete="off" v-model="editKelas.nama_kelas" type="text" name="nama" id="tahun" class="form-control" placeholder="" aria-describedby="helpId">
                                    <small v-if="errors.nama_kelas" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errors.nama_kelas[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <label for="kompetensi_keahlian">Kompetensi Keahlian</label>
                                    <input autocomplete="off" v-model="editKelas.kompetensi_keahlian" type="text" name="kompetensi_keahlian" id="kompetensi_keahlian" class="form-control" placeholder="" aria-describedby="helpId">
                                    <small v-if="errors.kompetensi_keahlian" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errors.kompetensi_keahlian[0] }}</small>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"  @click.prevent="resets()" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <p class="alert alert-warning text-danger" role="alert">
            Menghapus data Kelas akan menghapus data <b>yang be-relasi</b> dari Siswa
        </p>
    </div>
</template>

<script>
export default {
    data(){
        return{
            kelas: [],
            tambahKelas: {
                nama_kelas: '',
                kompetensi_keahlian: ''
            },
            errors:{},
            editKelas:{},
            cari: ''
        }
    },
    watch: {
        cari: _.debounce(function(){
            this.getKelas()
        }, 500)
    },
    mounted(){
        this.getKelas()
    },
    methods: {
        resets(){
            this.tambahKelas.nama_kelas = ''
            this.tambahKelas.kompetensi_keahlian = ''
            this.errors = ''
        },
        getKelas(){
            let param = _.isEmpty(this.cari) ? 'all' : this.cari
            axios.get('/api/kelas/' + param).then((response)=>{
                this.kelas = response.data
            });
        },
        createKelas(){
            axios.post('/api/kelas/create', this.tambahKelas).then((response)=>{
                // console.log(response.data)
                if(response.data.status){

                    this.$swal("Successfully", response.data.message, "success")

                    $('#modelTambah').modal('toggle')
                    this.resets()
                    this.getKelas()
                }
            }).catch((error)=>{
                if(!error.response.data.status){
                    this.errors = error.response.data.message
                }
            });
        },
        hapus(id){

            this.$swal({
                title: "Apakah Anda Yakin?",
                text: "Setelah dihapus, Anda tidak dapat memulihkan data ini!",
                icon: "warning",
                showDenyButton: true,
            }).then((result)=>{
                if(result.isConfirmed){
                    axios.delete('/api/kelas/delete/' + id).then((response)=>{
                        if(response.data.status){
                            this.$swal({
                                title: "Successfully",
                                text: response.data.message,
                                icon: "success"
                            })
                            this.getKelas()
                        }
                    });
                }else{
                    return false
                }
            })
        },
        editData(id){
            axios.get('/api/kelas/edit/' + id).then((response)=>{
                this.editKelas = response.data
            });
        },
        updateKelas(id){
            axios.put('/api/kelas/update/' + id, this.editKelas).then((response)=>{
                if(response.data.status){
                    this.$swal({
                        title: "Successfully",
                        text: response.data.message,
                        icon: "success"
                    })
                    this.getKelas()
                    $('#modelEdit').modal('toggle')
                    this.resets()
                }
            }).catch((error)=>{
                if(!error.response.data.status){
                    this.errors = error.response.data.message
                }
            });
        }
    }//end method
}
</script>
