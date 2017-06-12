@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row col-md-10 col-md-offset-2"> 
		@include('alerts')

		    <h2>Update Category</h2>				
			<div class="col-sm-12">

			{{ Form::open(['url' => ['category', $category->id], 'method' => 'put']) }}
				<div class="form-group">
					<div class="col-sm-7">
						<input type="text" id="name" class="form-control" placeholder="Category Name" name="name" value="{{$category->name}}">
						
					</div>
				</div>
				<button type="submit" class="btn btn-primary">Update</button>
			{{ Form::close() }}
				
			</div>
		</div>
	</div>
@endsection