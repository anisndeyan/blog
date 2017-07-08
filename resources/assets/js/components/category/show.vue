<template>
	<div class="container">
		<div class="row col-md-8 col-md-offset-2"> 
		    <h2>My Categories</h2>
		   
			<div v-for="category in categories" class="col-sm-12"  >
				<a class="col-sm-8"> {{ category.name }}</a>
				<router-link :to="'/category/'+category.id+'/edit' " v-if="user == category.parent_id" class="btn btn-primary col-sm-2" >Edit </router-link>
				<a v-on:click="remove(category.id)" class="btn btn-danger col-sm-2" v-if="user == category.parent_id">Delete</a>
			</div>
		</div>
		<router-view></router-view>
	</div>
</template>
<script>
export default {
	data(){
		return {
			categories:"",
			user:sessionStorage.getItem('user_id'),
		}
	},
	created(){
		this.index();
	},
	methods:{
		index(){
			axios.get('/api/category/index')
    		.then((response)=> {
    			this.categories = response.data.categories;
    		})	
		},
        remove(id){
            axios.delete('/api/category/' + id).then((response)=>{
				this.index();   
            })
        }
    }
}
</script>