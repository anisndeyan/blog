@extends ('layouts.app')

@section ('content')
	@foreach ($categories as $category)
		<div class='col-md-8 col-sm-8 col-xs-8 col-md-offset-2 col-xs-offset-2 col-sm-offset-2'>
			<a href='/category/{{$category->id}}/posts' class="cat_link">
				<h1>{{$category->name}}</h1>
			</a>
			<a href="/category/{{$category->id}}/edit"
			 class="btn btn-primary" role="button">Edit</a>
			{{ Form::open(['url' => ['category', $category->id] , 'method' => 'DELETE' , 'class'=>'form-horizontal']) }}
                <button  class="btn btn-danger col-sm-1">Delete</button>
            {{ Form::close() }}
		</div>
	@endforeach
@endsection()


