<template>
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Login</div>
				<div class="panel-body">
						<div class="form-group" :class="{'has-error' : errorsEmail}">
							<label for="email" class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input v-model="loginDetails.email" id="email" type="email" class="form-control" name="email"  required autofocus>
								
								<span v-if="errorsEmail" class="help-block">
									<strong>{{ emailError }}</strong>
								</span>
							</div>
						</div>
						<div class="form-group" :class="{'has-error' : errorsPassword}">
							<label for="password" class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input v-model="loginDetails.password" id="password" type="password" class="form-control" name="password" required>
								<span v-if="errorsPassword" class="help-block">
									<strong>{{ passwordError }}</strong>
								</span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input v-model="loginDetails.remember" type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-8 col-md-offset-4">
								<button v-on:click="loginPost" class="btn btn-primary" type="submit">
								Login
								</button>
								
								<a class="btn btn-link">
									Forgot Your Password?
								</a>
							</div>
						</div>
					<!-- </form> -->
				</div>
			</div>
		</div>
	</div>
</div>
</template>
<script>
import {router} from '../routes.js'
	export default {
		data() {
			return {
				loginDetails:{
					email:'',
					password:'',
					remember:true
				},
				errorsEmail:false,
				errorsPassword:false,
				emailError:null,
				passwordError:null	
			}
		},
		methods:{
			loginPost (){
				let vm = this;
				console.log(router),
				
				axios.post('/api/login', vm.loginDetails)
				.then(function(response){
					// vm.$router.go('/home');
				})
				.catch(function(error){
					var errors = error.response;
					console.log(errors)
					if(errors.status === 422){
						if(errors.data){
							if(errors.data.email){
								vm.errorsEmail = true
								vm.emailError = _.isArray(errors.data.email) ? errors.data.email[0] : errors.data.email 
							}
							if(errors.data.password){
								vm.errorsPassword = true
								vm.passwordError = _.isArray(errors.data.password) ? errors.data.password[0] : errors.data.password
							}
						}
					}
				});
				
			},
			getToken(){
               return document.querySelector('#token').getAttribute('content');
           	}
		},
		component:{
            
        }
	}
</script>