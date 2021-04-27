<template>
    <div class="container mb-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register Admin</div>

                <div class="card-body">
                    <form @submit.prevent="regist()">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" v-model="register.name" value="" required autocomplete="name" autofocus>

                                <p v-if="errors.name" class="alert alert-danger mt-1" role="alert">
                                    <strong>{{ errors.name[0] }}</strong>
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" v-model="register.email" value="" required autocomplete="email">
                                <p v-if="errors.email" class="alert alert-danger mt-1" role="alert">
                                    <strong>{{ errors.email[0] }}</strong>
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" v-model="register.password" required autocomplete="new-password">
                                <p v-if="errors.password" class="alert alert-danger mt-1" role="alert">
                                    <strong>{{ errors.password[0] }}</strong>
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" v-model="register.confirmPassword" required autocomplete="new-password">
                                <p v-if="failConfirm" class="alert alert-danger mt-1" role="alert">
                                    <strong>{{ failConfirm }}</strong>
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="level" class="col-md-4 col-form-label text-md-right">Level</label>

                            <div class="col-md-6">
                                <select name="level" id="level" class="form-control" v-model="register.level">
                                    <option value="admin">Admin</option>
                                    <option value="petugas">Petugas</option>
                                </select>

                                <p v-if="errors.level" class="alert alert-danger mt-1" role="alert">
                                    <strong>{{ errors.level[0] }}</strong>
                                </p>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-user" aria-hidden="true"></i> Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    data(){
        return{
            register:{
                name: '',
                email: '',
                password: '',
                confirmPassword: '',
                level: 'admin'
            },
            failConfirm: '',
            errors:{}
        }
    },
    methods:{
        resets(){
            this.register.name = '',
            this.register.email= '',
            this.register.password= '',
            this.register.confirmPassword= '',
            this.register.level= 'admin'
        },
        regist(){
            if(this.register.password == this.register.confirmPassword){
                this.failConfirm = ''
                axios.post('/api/register/admin', this.register).then((response)=>{
                    // console.log(response.data)
                    if(response.data.status){
                        this.$swal({
                            title: "Successfully",
                            text:response.data.message,
                            icon: "success"
                        })
                        this.resets()
                    }
                }).catch((error)=>{
                    // console.log(error.response.data)
                    if(!error.response.data.status){
                        this.errors = error.response.data.message
                    }
                });
            }else{
                this.failConfirm = "Konfirmasi Password Salah!!"
                return false
            }

        }
    }
}
</script>
