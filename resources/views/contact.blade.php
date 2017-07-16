@extends('layouts.app')
@section('title','Contact')
@section('content')
<div class="container">
	<div class="panel panel-default">
	  <div class="panel-body">
	    <form class="form-horizontal" action="{{ route('contact') }}" method="post" enctype="multipart/form-data">
	    	{{ csrf_field() }}
		  <fieldset>
		    <legend>Contact form</legend>
		    <div class="row">
		    	<div class="col-md-6">
				    <div class="form-group">
				      <label for="inputName" class="col-md-3 control-label">Name</label>
				      <div class="col-md-7">
				        <input type="text" class="form-control" id="inputName" placeholder="Name" name="name"> 
				      </div>
				    </div>
		    	</div>
		    	<div class="col-md-6">
				    <div class="form-group">
				      <label for="inputEmail" class="col-md-3 control-label">Email</label>
				      <div class="col-md-7">
				        <input type="text" class="form-control" id="inputEmail" placeholder="Email" name="email">
				      </div>
				    </div>
		    	</div>
		    </div> 
		    <div class="row">
		    	<div class="col-md-6">
				    <div class="form-group">
				      <label for="select" class="col-md-3 control-label">Service</label>
				      <div class="col-md-7">
				        <select class="form-control" id="select" name="service">
				          <option>1</option>
				          <option>2</option>
				          <option>3</option>
				          <option>4</option>
				          <option>5</option>
				        </select> 
				      </div>
				    </div>
		    	</div>
		    	<div class="col-md-6">
				    <div class="form-group">
				      <label for="inputCv" class="col-md-3 control-label">CV</label>
				      <div class="col-md-7">
				        <input type="file" class="form-control" id="inputCv" name="cv">
				      </div>
				    </div>
		    	</div>
		    </div> 
		    <div class="row">
		    	<div class="col-md-12"><hr>
				    <div class="form-group"> 
				      <div class="col-md-10 col-md-offset-1">
				        <textarea class="form-control" rows="6" id="textArea" name="message" style="max-width: 100%;"></textarea>
				      </div>
				    </div> 
		    	</div>  
		    	<div class="col-md-12">
				    <div class="form-group">
				      <div class="col-md-4 col-md-offset-8">
				        <button type="reset" class="btn btn-default">Cancel</button>
				        <button type="submit" class="btn btn-primary">Submit</button>
				      </div>
				    </div>
		    	</div> 
		    </div> 
		  </fieldset>
		</form>
	  </div>
	</div>
</div>
@endsection