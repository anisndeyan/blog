@extends('layouts.app')

@section('content')
<div class='col-md-8'>
	@if (session('success'))
               <div class="alert alert-success col-xs-11">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   {{session('success') }}
               </div>
           @endif

           @if (session('error'))
               <div class="alert alert-danger col-xs-11">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   {{session('error') }}
               </div>
           @endif
           @if (count($errors) > 0)
                <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
	<h1 style="text-align: center;">Create a Category</h1><br>
	<div class="row">
		{{ Form::open(['url' => ['category'], 'method' => 'POST']) }}
		    <div class="form-group col-md-8 col-sm-8 col-xs-8 col-md-offset-2 col-xs-offset-2 col-sm-offset-2">
				<input type="text" class="form-control" id="usr" placeholder="Category Name" name="name" value="{{old('name')}}">
			</div>
			<div class="form-group col-md-8 col-sm-8 col-xs-8 col-md-offset-2 col-xs-offset-2 col-sm-offset-2">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		{{ Form::close() }}
	</div>
</div>

@endsection