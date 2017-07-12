<form class="form-horizontal row" style="padding: 20px 5%;" action="{{ route('admin.media.store') }}" method="post" enctype="multipart/form-data" >
 {{ csrf_field() }}
  <fieldset>
    <legend>Upload Media</legend>
    <div class="form-group">
      <label for="inputTitle" class="col-lg-2 control-label">Title</label>
      <div class="col-lg-10">
        <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Title">
      </div>
    </div>
    <div class="form-group">
      <label for="inputFile" class="col-lg-2 control-label">File</label>
      <div class="col-lg-10">
        <input type="file" name="media" class="form-control" id="inputFile" placeholder="File"> 
      </div>
    </div>  
    <div class="form-group"><hr>
      <div class="col-md-4 col-md-offset-8">
        <button type="reset" class="btn btn-default">Cancel</button>
        <button type="submit" class="btn btn-primary">Upload</button>
      </div>
    </div>
  </fieldset>
</form>