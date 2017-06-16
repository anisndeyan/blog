@extends('layouts.app')

@section('content')
<div class='conatiner'>

 	@if (isset($categories)) 
		@foreach ($categories as $category)
			@if ($category->user_id == Auth::id())
				<div class='col-md-8 col-sm-8 col-xs-8 col-md-offset-2 col-xs-offset-2 col-sm-offset-2'>
					<a href="/category/{{$category->id}}/posts" class="cat_link"><h2>{{$category->name}}</h2></a>
					
					{{ Form::open(['url' => ['category', $category->id] , 'method' => 'DELETE' , 'class'=>'form-horizontal']) }}

                    	<button  class="btn btn-danger">Delete</button>
            		{{ Form::close() }}
            		<a href="/category/{{$category->id}}/edit" class="btn btn-primary">Edit</a>
				</div>
			@else
				<div class='col-md-8 col-sm-8 col-xs-8 col-md-offset-2 col-xs-offset-2 col-sm-offset-2'>
					<a href="/category/{{$category->id}}/posts" class="cat_link col-sm-8"><h2>{{$category->name}}</h2></a>
				</div>
			@endif	
		@endforeach	
	@endif
</div>
@endsection
