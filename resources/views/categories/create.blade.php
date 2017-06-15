@extends('layouts.app')

@section('content')

  <div class='col-md-8'>
  	@include('alerts')
  	<h1 style="text-align: center;">Create a Category</h1><br>
  	<div class="row">

  		{{ Form::open(['url' => ['category'], 'method' => 'POST']) }} {{ csrf_field() }}

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