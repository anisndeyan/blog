@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row col-md-8 col-md-offset-2"> 
      @include('alerts')
        <h2>Add Post</h2>
          <div class="col-sm-6">
            <label class="control-label col-sm-12" for="title">Post Title:</label>
            <input type="text" id="title" class="col-sm-12 form-control" placeholder="Enter Name" name="title">
          </div>

          <div class="col-sm-6">
            <label class="control-label col-sm-12" for="text">Post Text:</label>
            <textarea class="col-sm-12 form-control" id="text" name="text" placeholder="Enter Text"></textarea>
          </div>
         
    
        </div>
        
 
    </div>
  </div>
@endsection
