<template>
	<div class='container'>
	<h1 style="text-align: center;">Ubdate a Category</h1><br>
	<h4 class="text-danger">{{message}}</h4>
	<div class="row">
		<!-- <form class="form-horizontal" role="form" @submit.prevent="create"> -->
			<div class="form-group col-md-8 col-sm-8 col-xs-8 col-md-offset-2 col-xs-offset-2 col-sm-offset-2">
				<input v-model="name"  type="text" class="form-control" id="usr" placeholder="Category Name" name="name" >
			</div>
			<div class="form-group col-md-8 col-sm-8 col-xs-8 col-md-offset-2 col-xs-offset-2 col-sm-offset-2">
				<button v-on:click="update()" type="submit" class="btn btn-primary">Ubdate</button>
			</div>
			
		<!-- </form> -->
	</div>
</div>
</template>
<script>
export default {
	data(){
		return {
			name:"",
			message:""
		}
		 
	},
	created(){
		let id = this.$route.params.id;
        axios.get('/api/category/' +id+ '/edit').then((response)=>{
            this.category 	= response.data.category;
            this.name  		= response.data.category.name;
        });
	},
	methods:{
		update(){
		
			let id = this.$route.params.id;
			let inputs= { name:this.name };
            axios.put('/api/category/' + id, inputs).then((response)=>{
                this.message = response.data.message;
            });
        }
	}
}
</script>