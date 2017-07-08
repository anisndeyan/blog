<template>
	<div class='container'>
	<h1 style="text-align: center;">Create a Category</h1><br>
	<h4 class="text-danger">{{message}}</h4>
	<div class="row">
		<!-- <form class="form-horizontal" role="form" @submit.prevent="create"> -->
			<div class="form-group col-md-8 col-sm-8 col-xs-8 col-md-offset-2 col-xs-offset-2 col-sm-offset-2">
				<input v-model="name"  type="text" class="form-control" id="usr" placeholder="Category Name" name="name" required autofocus>
			</div>
			<div class="form-group col-md-8 col-sm-8 col-xs-8 col-md-offset-2 col-xs-offset-2 col-sm-offset-2">
				<button  v-on:click="create" type="submit" class="btn btn-primary">Submit</button>
			</div>
			
		<!-- </form> -->
	</div>
</div>
</template>
<script>
	export default{
		data(){
	        return {
	            name:"",
	            user:sessionStorage.getItem('user_id'),
	            message:""
	        }    
   		},
   		methods:{
            create(){
            	let input = { name:this.name }
	                if(this.name!="") {
	                    axios.post('/api/category/create', input).then((response)=>{
	                    	this.message = response.data.message;
	                        this.name="";
	                    }).catch((err)=>{
	                    	console.log(err);
	                    });
	                }
    		}
		}
	}
</script>
