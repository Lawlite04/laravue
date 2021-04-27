<template>
    <div class="container">
        <p role="alert" class="alert alert-info h2">Data SPP</p>
        <!-- Button trigger modal -->
        <div class="row justify-content-around">
            <div class="col-md-4">
                <button type="button" class="btn btn-success my-2" data-toggle="modal" data-target="#modelTambah">
                <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                </button>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <div class="input-group my-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-search    "></i>
                            </div>
                        </div>
                        <input type="search" v-model="cari" class="form-control" placeholder="Masukan Tahun *" aria-describedby="helpId">
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Tambah -->
        <div class="modal fade" id="modelTambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data SPP</h5>
                            <button type="button" class="close" @click.prevent="resets()" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <form @submit.prevent="createSpp()" action="" method="post">
                        <div class="modal-body">
                                <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <input autocomplete="off" v-model="dataSpp.tahun" type="text" name="tahun" id="tahun" class="form-control" placeholder="" aria-describedby="helpId">
                                    <small v-if="errorV.tahun" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errorV.tahun[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <label for="nominal">Nominal</label>
                                    <input autocomplete="off" v-model="dataSpp.nominal" type="text" name="nominal" id="nominal" class="form-control" placeholder="" aria-describedby="helpId">
                                    <small v-if="errorV.nominal" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errorV.nominal[0] }}</small>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"  @click.prevent="resets()" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Close</button>
                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr class="bg-secondary text-light text-center">
                    <th>No</th>
                    <th class="border">Tahun</th>
                    <th class="border">Nominal</th>
                    <th class="border">Action</th>
                </tr>
            </thead>
            <tbody v-if="spp[0]">
                <tr v-for="data,index in spp">
                    <td>{{ ++index }}</td>
                    <td>{{ data.tahun }}</td>
                    <td>{{ data.nominal | currency }}</td>
                    <td>
                        <!-- Button trigger modal -->
                        <button @click.prevent="editData(data.id)" type="button" class="my-1 btn btn-primary text-light" data-toggle="modal" data-target="#modelEdit">
                        <i class="fas fa-edit"></i>
                        </button>
                        <button @click.prevent="hapus(data.id)" class="my-1 btn btn-danger">
                            <i class="fa fa-trash" aria-hidden="true"></i>
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
                                    <form @submit.prevent="updateSpp(editSpp.id)" action="" method="post">
                                        <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="tahun">Tahun</label>
                                                    <input autocomplete="off" v-model="editSpp.tahun" type="text" name="tahun" id="tahun" class="form-control" placeholder="" aria-describedby="helpId">
                                                    <small v-if="errorV.tahun" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errorV.tahun[0] }}</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nominal">Nominal</label>
                                                    <input autocomplete="off"    v-model="editSpp.nominal" type="text" name="nominal" id="nominal" class="form-control" placeholder="" aria-describedby="helpId">
                                                    <small v-if="errorV.nominal" id="helpId" class="alert d-block my-1 alert-danger text-light text-muted" role="alert">{{ errorV.nominal[0] }}</small>
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
                    </td>
                </tr>
            </tbody>
            <tbody v-else>
                <tr>
                    <td colspan="4" class="text-center text-danger py-2 font-weight-bold border">Data Tidak Ditemukan</td>
                </tr>
            </tbody>
        </table>

        <p class="alert alert-warning text-danger" role="alert">
            Menghapus data SPP akan menghapus data <b>yang be-relasi</b> dari Siswa
        </p>
    </div>
</template>

<script>
export default {
    data(){
        return{
            spp:[],
            dataSpp:{
                tahun: '',
                nominal: ''
            },
            errorV:{},
            editSpp:{},
            cari: ''
        }
    },
    mounted(){
        this.getSpp()
    },
    watch:{
        cari: _.debounce(function() {
            this.getSpp()

        }, 500)
    },
    methods: {
        resets(){
            this.dataSpp.tahun = ''
            this.dataSpp.nominal = ''
            this.errorV = ''
        },
        getSpp(){
            let param = _.isEmpty(this.cari) ? 'all' : this.cari
            axios.get('/api/home/' + param).then((response)=>{
                this.spp = response.data
            });
        },
        createSpp(){
            axios.post('/api/tambah', this.dataSpp).then((response)=>{
                if(response.data.status){

                    this.$swal('Succesfully', response.data.message ,'success')

                    $('#modelTambah').modal('toggle');
                    this.dataSpp.tahun = ''
                    this.dataSpp.nominal = ''
                    this.errorV = ''
                    this.getSpp();
                }else{
                    return false;
                }
            }).catch((error)=>{
                if(!error.response.data.status){
                    this.errorV = error.response.data.message
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
                    axios.delete('/api/hapus/' + id).then((response)=>{
                        if(response.data.status){
                            this.$swal({
                                title: 'Successfully',
                                text: response.data.message,
                                icon: "success"
                            })
                            this.getSpp()
                        }
                    });
                }else{
                    return false
                }

            })
        },
        editData(id){
            axios.get('/api/edit/' + id).then((response)=>{
                this.editSpp = response.data
            });
        },
        updateSpp(id){
            axios.put('/api/update/' + id, this.editSpp).then((response)=>{
                if(response.data.status){

                    this.$swal({
                        title: "Successfully",
                        text: response.data.message,
                        icon: "success"
                    })

                    $('#modelEdit').modal('toggle');
                    this.errorV = ''
                    this.getSpp();
                }else{
                    return false;
                }
            }).catch((error)=>{
                if(!error.response.data.status){
                    this.errorV = error.response.data.message
                }
            });
        }
    }//end method
}
</script>
