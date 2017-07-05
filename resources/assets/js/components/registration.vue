<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!--  @if (session('massage'))
            <div class="alert alert-success">
                {{ session('massage') }}
            </div>
            @endif -->
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
              
                        
                        <div >
                            <label  for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input v-model="name" id="name" type="text" class="form-control" name="name"  required autofocus>
                                <!--  @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif -->
                            </div>
                        </div>
                        <div >
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input v-model="email" id="email" type="email" class="form-control" name="email"  required>
                                <!--  @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif -->
                            </div>
                        </div>
                        <div >
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input v-model="password" id="password" type="password" class="form-control" name="password" required>
                                <!--
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input v-model="password_confirmation" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button  class="btn btn-primary" v-on:click='register'>
                                Register
                                </button>
                            </div>
                        </div>
                 
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data() {
            return {
                name:"",
                email:"",
                password:"",
                password_confirmation:"",
                inputs:"",
            }
        },
        methods:{
            register:function()
            {
                let inputs = { 
                    name:this.name,
                    email:this.email,
                    password:this.password,
                    password_confirmation:this.password_confirmation
                };
                //console.log(inputs),
                this.$http.post('/api/register', inputs)
                .then(function(response){
                    //console.log(response.data);
                    /*this.$router.go('/home');
                    console.log(this.$router)*/
                     
                })
                .catch((err) => console.log(err)) 
            }
        }

    }  
</script>