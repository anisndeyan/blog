<template>

	<div class='container col-md-2 ' style="float: left;">
	<div id="sidebar-wrapper">
	    <nav id="spy">
	        <ul class="sidebar-nav nav">
	            <li><h1 style="text-align:center;"><a>Home</a></h1></li>
	            <li>
	                <a data-toggle="collapse" data-target="#toggleDemo" data-parent="#sidenav01" class="collapsed">Categories <b>{{ categoryCount }}</b><span class="caret"></span> 
	                </a>
	                <div class="collapse" id="toggleDemo" style="height: 0px;">
	                    <ul class="nav nav-list">
	                        <li><router-link to="/category/create">Create Category</router-link></li>
	                        <li><router-link to="/category/index">View My Categories</router-link></li>
	                        <li><router-link to="/category/show">View All Categories</router-link></li>
	                    </ul>
	                </div>
	            </li>
	            <li>
	                <a data-toggle="collapse" data-target="#toggleDemo1" data-parent="#sidenav01" class="collapsed">Posts <b> {{ postCount }}</b> <span class="caret"></span> 
	                </a>
	                <div class="collapse" id="toggleDemo1" style="height: 0px;">
	                    <ul class="nav nav-list">
	                        <li><a >Create Post</a> </li>
	                        <li><a >View My Posts</a></li>
	                        <li><a >View All Posts</a></li>
	                    </ul>
	                </div>
	            </li>
	            <li>
	                <a  data-scroll="">
	                    <span>Users <b> {{ userCount }} </b> </span>
	                </a>
	            </li>
	        </ul>
	    </nav>
	    <router-view></router-view>
	</div>
</div>
</template>
<script>

export default {
	data(){
		return {
			postCount:"",
	        categoryCount:"",
	        userCount:""
		}
		 
	},
	mounted(){
		axios.get('/api/home')
	        .then(
	            (response) =>{ 
	            	console.log(response);
	                sessionStorage.setItem('userCount',response.data.userCount);
	                this.userCount= sessionStorage.getItem('userCount');
	                sessionStorage.setItem('categoryCount',response.data.categoryCount);
	                this.categoryCount= sessionStorage.getItem('categoryCount');
	                sessionStorage.setItem('postCount',response.data.postCount);
	                this.postCount= sessionStorage.getItem('postCount');
	            }, 
	            
	        ); 
	}
}
</script>