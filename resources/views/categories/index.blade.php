@extends('layouts.app')

@section('content')
 	@if (isset($categories)) 

		@foreach($categories as $category)

			@if($category->user_id == Auth::id())

				<div class='col-md-8 col-sm-8 col-xs-8 col-md-offset-2 col-xs-offset-2 col-sm-offset-2'>
					<a href="/category/{{$category->id}}/posts" class="cat_link"><h2>{{$category->name}}</h2></a>
					<a href="/category/{{$category->id}}/edit" class="glyphicon glyphicon-pencil"></a>
					{{ Form::open(['url' => ['category', $category->id] , 'method' => 'DELETE' , 'class'=>'form-horizontal']) }}

                    	<button  class="glyphicon glyphicon-remove"></button>
            		{{ Form::close() }}
				</div>
			@else
				<div class='col-md-8 col-sm-8 col-xs-8 col-md-offset-2 col-xs-offset-2 col-sm-offset-2'>
					<a href="/category/{{$category->id}}/posts" class="cat_link col-sm-8"><h2>{{$category->name}}</h2></a>
				</div>
			@endif	

		@endforeach

	@else 
		<p>No Category</p>	
	@endif

@endsection()

