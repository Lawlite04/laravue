<template>
    <div class="container">
        <p role="alert" class="alert alert-info h2">Data Petugas</p>

        <div class="row justify-content-around">
            <div class="col-md-4">
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
        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="modelTambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Petugas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <form @submit.prevent="createPetugas()" action="" method="post">
                        <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input autocomplete="off" v-model="tambahPetugas.name" type="text" name="name" id="nama" class="form-control" placeholder="" aria-describedby="helpId">
                                    <small v-if="errors.name" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errors.name[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input autocomplete="off" v-model="tambahPetugas.email" type="text" name="email" id="email" class="form-control" placeholder="" aria-describedby="helpId">
                                    <small v-if="errors.email" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errors.email[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input autocomplete="off" v-model="tambahPetugas.password" type="password" name="password" id="password" class="form-control" placeholder="" aria-describedby="helpId">
                                    <small v-if="errors.password" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errors.password[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <label for="level">Level</label>
                                    <select v-model="tambahPetugas.level" id="level" class="form-control">
                                        <option value="" disabled>-- Pilih</option>
                                        <option value="admin">Admin</option>
                                        <option value="petugas">Petugas</option>
                                    </select>
                                    <small v-if="errors.level" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errors.level[0] }}</small>
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
                    <th class="border">Email</th>
                    <!-- <th class="border">Password</th> -->
                    <th class="border">Nama</th>
                    <th class="border">Level</th>
                    <th class="border">Action</th>
                </tr>
            </thead>
            <tbody v-if="petugas[0]">
                <tr v-for="data,index in petugas">
                    <td>{{ ++index }}</td>
                    <td>{{ data.email }}</td>
                    <!-- <td style="max-width: 100px; overflow:hidden;">{{ data.password }}</td> -->
                    <td>{{ data.name }}</td>
                    <td>{{ data.level }}</td>
                    <td>
                        <!-- Button trigger modal -->
                    <button @click.prevent="editPetugas(data.id)" type="button" class="my-1 btn btn-primary text-light" data-toggle="modal" data-target="#modelEdit">
                      <i class="fas fa-edit    "></i>
                    </button>
                        <button class="my-1 btn btn-danger" @click.prevent="hapus(data.id)">
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
                    <form @submit.prevent="updatePetugas(dataEdit.id)" action="" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input autocomplete="off" v-model="dataEdit.name" type="text" name="name" id="nama" class="form-control" placeholder="" aria-describedby="helpId">
                                <small v-if="errors.name" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errors.name[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="nama">Level</label>
                                <select v-model="dataEdit.level" id="nama" class="form-control">
                                    <option value="admin">Admin</option>
                                    <option value="petugas">Petugas</option>
                                </select>
                                <small v-if="errors.level" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errors.name[0] }}</small>
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


        <!-- <p class="alert alert-warning text-danger" role="alert">
            Menghapus data Petugas akan menghapus semua kegiatan yang pernah dilakukan petugas tsb dan semua transaksi yang pernah diinputkan
        </p> -->
    </div>
</template>
<script>
export default {
    data(){
        return{
            petugas: [],
            tambahPetugas: {
                email: '',
                password: '',
                name: '',
                level: ''
            },
            errors:{},
            dataEdit: {},
            cari: ''
        }
    },
    mounted(){
        this.getPetugas()
    },
    watch:{
        cari: _.debounce(function() {
            this.getPetugas()
        }, 500)
    },
    methods:{
        resets(){
            this.errors = '',
            this.tambahPetugas.email = '',
            this.tambahPetugas.password = '',
            this.tambahPetugas.name = ''
            this.tambahPetugas.level = ''
        },
        getPetugas(){
            let param = _.isEmpty(this.cari) ? 'all' : this.cari;
            axios.get('/api/petugas/' + param).then((response)=>{
                this.petugas = response.data
            })
        },
        createPetugas(){
            axios.post('/api/petugas/tambah', this.tambahPetugas).then((response)=>{
                if(response.data.status){
                    this.$swal({
                        title: "Successfully",
                        text: response.data.message,
                        icon: "success"
                    })
                    $('#modelTambah').modal('toggle')
                    this.resets()
                    this.getPetugas()
                }
            }).catch((error)=>{
                if(!error.response.data.status){
                    this.errors = error.response.data.message


                }
            })
        },
        hapus(id){

            this.$swal({
                title: "Apakah Anda Yakin?",
                text: "Setelah dihapus, Anda tidak dapat memulihkan data ini!",
                icon: "warning",
                showDenyButton: true,
            }).then((result)=>{
                if(result.isConfirmed){
                    axios.delete('/api/petugas/delete/' + id).then((response)=>{
                        if(response.data.status){
                            this.$swal({
                                title: "Successfully",
                                text: response.data.message,
                                icon: "success"
                            })
                            this.getPetugas()
                        }
                    }).catch((error)=>{
                        if(!error.response.data.status){
                            this.$swal({
                                title: "Error",
                                text: response.data.message,
                                icon: "error"
                            })
                        }
                    });
                }else{
                    return false
                }
            })
        },
        editPetugas(id){
            axios.get('/api/petugas/edit/' + id).then((response)=>{
                this.dataEdit = response.data
            })
        },
        updatePetugas(id){
            axios.put('/api/petugas/update/' + id, this.dataEdit).then((response)=>{
                if(response.data.status){

                    this.$swal({
                        title: "Successfully",
                        text: response.data.message,
                        icon: "success"
                    })

                    $('#modelEdit').modal('toggle');
                    this.errors = ''
                    this.getPetugas();
                }
            }).catch((error)=>{
                if(!error.response.data.status){
                    this.errors = error.response.data.message
                }
            })
        }
    }//end
}
</script>
