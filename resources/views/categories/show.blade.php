
@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row col-md-8 col-md-offset-2"> 
		    <h2>My Categories</h2>

			@foreach ($categories as $category)
				@if($category->user_id == Auth::user()->id)
				<div class="col-sm-12 category">
					<a href="/category/{{$category->id}}/posts" class="col-sm-8">{{$category->name}}</a>
					<a href="/category/{{$category->id}}/edit" class="btn btn-primary col-sm-2">Edit</a>
					<a type="button" class="btn btn-danger delete-category" data-id="{{$category->id}}" data-toggle="modal" data-target="#delete-category">Delete</a>
				</div>
				@endif
			@endforeach
		</div>
	</div>
