<template>
<div class="container">
	<div class="row col-md-8 col-md-offset-2">
		<h2>My Posts</h2>
		<h4 v-if="message" class="text-danger">{{message}}</h4>
		<div  v-for="post in posts" class="col-sm-12" :id = "post.id" >
			<img v-show="post.image" :src="`../images/${post.image}`" class="col-sm-2">
			<img v-show="post.image == null" :src="`../images/default.png`" class="col-sm-2">
			<p class="col-sm-3">{{post.title}}</p>
			<p class="col-sm-3">{{post.text}}</p>
			<router-link :to="'/post/'+post.id+'/edit' " class="btn btn-primary col-sm-2" >Edit </router-link>
			<a v-on:click="remove(post.id)" class="btn btn-danger col-sm-2">Delete</a>
		</div>
	</div>
</div>
</template>
<script >
	export default {
	data(){
		return {
			posts:"",
			message:""
		}
		 
	},
	created(){
		
		this.index();
	},
	methods:{
		index() {
			axios.get('/api/post/index')
    		.then((response)=> {
    			this.posts = response.data.posts;
    		})
		},
       	remove(id){
            axios.delete('/api/post/' + id).then((response)=>{ 
                this.index();
                this.message = response.data.message;  
            }); 
        }
    }
}

</script>