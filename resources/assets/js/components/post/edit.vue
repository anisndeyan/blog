<template>
<div class="container">
    <div class="row col-md-8 col-md-offset-2"> 
        <h2>Add Post</h2>
        <div class="col-sm-offset-2 col-sm-10">
<h4 class="text-danger">{{message}}</h4>
            <div class="form-horizontal">
                 <div class="form-group">
                    <label for="title" class="col-md-4 control-label">Post Title:</label>
                    <div class="col-md-6">
                        <input v-model="posts.title" id="title" type="text" class="form-control" >                         
                    </div>
                </div>
                <div class="form-group">
                    <label for="text" class="col-md-4 control-label">Post Text:</label>
                    <div class="col-md-6">
                        <textarea v-model="posts.text" id="text" type="text" class="form-control"></textarea>                    
                    </div>
                </div>
                <div class="form-group">
                    <label for="category" class="col-md-4 control-label">Post Category:</label>
                    <div class="col-md-6">
                        <select class="col-sm-12 form-control" id="category" v-model="selectedCategory">
                            <option v-for="category in categories" :value="category.id">{{category.name}}</option>
                        </select>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="category" class="col-md-4 control-label">Post Image:</label>
                    <div class="col-md-6">
                        <input type="file" name="file" accept="image/*" v-on:change="imageUpload"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 text-center">
                        <button  v-on:click="postCreate" class="btn btn-primary">
                            Add Post
                        </button>                               
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data(){
        return {
            categories:"" ,
            selectedCategory: "",
            message:"",
            image:"",
            posts:""
        } 
    },
    created() {
        let id = this.$route.params.id;
        axios.get('/api/post/'+id+'/edit').then((response) =>{
            this.posts = response.data.posts;
            this.categories = response.data.categories;
            console.log(this.posts);
        })
    },
    methods:{
        imageUpload(image){
            if(image.target.files && image.target.files[0]){
                this.image = image.target.files[0];
            }
        },
        postCreate:function(){
            let id = this.$route.params.id;
            var inputs = {title:this.posts.title, text:this.posts.text, category_id:this.selectedCategory, image:this.image};
            var myData = new FormData();
            for(var i in inputs) {
                myData.append(i, inputs[i]);
            }
            if ((inputs.title && inputs.text && inputs.category_id) !=="") {
                axios.post('post/'+id+'/update',myData).then((response)=>{
                    this.message = response.data.message;
                });
            }
        }
    }   
}
</script>