<div class='col-md-4'>
	<h1 style="text-align: center;">My Categories</h1><br>
	@foreach($categories as $cat)
	<h3>{{$cat->name}}</h3>
	@endforeach
</div>