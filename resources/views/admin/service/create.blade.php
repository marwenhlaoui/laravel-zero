<form class="form-horizontal row" style="padding: 20px 5%;" action="{{ route('admin.service.store') }}" method="post">
 {{ csrf_field() }}
  <fieldset>
    <legend>Add Service</legend>
    <div class="form-group">
      <label for="inputTitle" class="col-lg-2 control-label">Title</label>
      <div class="col-lg-9">
        <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Title">
      </div>
    </div> 
    <div class="form-group">
      <label for="inputTitle" class="col-lg-2 control-label">Description</label>
      <div class="col-lg-9">
        <input type="text" name="description" class="form-control" id="inputDescription" placeholder="Description" maxlength="200">
      </div>
    </div> 
    <div class="form-group">
      <label for="inputTitle" class="col-lg-2 control-label">Access : </label>
      <div class="col-lg-9">

        <ul style="list-style: none;"><br>
        	@foreach(all_models() as $k=>$value)
	        	<li>
	        		<label> <input type="checkbox" name="access[]" value="{{$value}}"> &nbsp; {{$value}} </label>
	        	</li>
        	@endforeach
        </ul>
      </div>
    </div> 
    <div class="form-group"><hr>
      <div class="col-md-4 col-md-offset-8"> 
        <button type="submit" class="btn btn-success">Create</button>
      </div>
    </div>
  </fieldset>
</form>