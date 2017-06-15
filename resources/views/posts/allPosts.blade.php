@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row col-md-8 col-md-offset-2"> 
		    <h2>All Posts</h2>
			@foreach ($posts as $post)
				<div class="col-sm-12 post">
				@if(empty($post->image))
					<img src="/images/default.png" class="col-sm-2">
				@else 
					<img src="/images/{{$post->image}}" class="col-sm-2">
				@endif	
					<p class="col-sm-3">{{$post->title}}</p>
					<p class="col-sm-3">{{$post->text}}</p>
					@if(Auth::user()->id == $post->category->user_id)
						<a href="/post/{{$post->id}}/edit" class="btn btn-primary col-sm-2">Edit</a>
						
						{{ Form::open(['url' => ['post', $post->id] , 'method' => 'DELETE' , 'class'=>'form-horizontal']) }}{{ csrf_field() }}

                    		<button  class="btn btn-danger col-sm-2">Delete</button>
            			{{ Form::close() }}
					@endif
				</div>
			@endforeach
		</div>
	</div>
@endsection