@extends('layouts.app')

@section('content')
	<h1>{{$category->name}}</h1>
	<h3>{{$category->id}}</h3>
	<p>{{$category->created_at}}</p>
	<p>{{$category->updated_at}}</p>
@endsection()