@extends('layouts.admin')

@section('content')
			<div class="row">
				<div class="col-sm-4">
					<div class="alert alert-dismissible alert-info"> 
					  <h4>{{count(\App\Models\Media::all())}}</h4> 
					  <p>All medias</p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="alert alert-dismissible alert-danger"> 
					  <h4>{{count(\App\Models\Media::all())}}</h4> 
					  <p>All medias</p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="alert alert-dismissible alert-warning"> 
					  <h4>{{count(\App\Models\Media::all())}}</h4> 
					  <p>All medias</p>
					</div>
				</div>
			</div> 
            <div class="panel panel-default">
                <div class="panel-heading">
                	<span class="pull-right">
                		<a href="{{route('admin.media.create')}}" class="btn btn-xs btn-success" data-toggle="modal" data-target="#mediaUploadModal"><i class="ion ion-plus"></i> &nbsp; Upload media</a>
                	</span>
                	<b>Media</b>
                </div>

                <div class="panel-body">
                   <table class="table table-striped table-hover ">
					  <thead>
					    <tr>
					      <th>#</th> 
					      <th>Title</th>  
					      <th class="hidden-sm hidden-xs visible-lg">Created at</th>
					      <th></th>
					    </tr>
					  </thead>
					  <tbody>
					  	@foreach($medias as $k=>$file)
					    <tr>
					      <td> 
					      		<img src="{{ asset($file->preview) }}" style="max-width: 50px;min-width: 50px"> 
					      	</td>
					      <td>{{str_limit($file->title,15,'...')}}</td> 
					      <td style="font-size: 10px;" class="text-muted hidden-sm hidden-xs visible-lg">{{$file->created_at}} <b class="text-primery">( {{$file->created_at->diffForHumans()}} )</b></td>
					      <td>
					      	<a href="{{route('admin.media.show',$file->id)}}" class="btn btn-xs btn-info">Show</a> 
					      	<a href="" class="btn btn-xs btn-danger delete-media" data-media="{{$file->id}}">Delete</a>
					      	<form action="{{ route('admin.media.destroy',$file->id) }}" method="post" >
					      		{{csrf_field()}}
					      		{{ method_field('DELETE') }} 
					      	</form>
					      </td>
					    </tr> 
					    @endforeach
					  </tbody>
					</table> 
                </div>
					<center>{{ $medias->links() }}</center>
            </div> 
@include('layouts.admin.includes._modal') 
@include('layouts.admin.includes._modal-confirm') 
@endsection 
@section('js')
<script type="text/javascript">
	$('.delete-media').on('click',function(e){
		e.preventDefault();
		var id = $(this).attr('data-media');
		var form = $(this).parent().find('form');
		$('#modal-confirm').modal({
	      show: true,
	      keyboard: false
	    })
	    .one('click', '#delete', function(e) {
	      form.submit();
	    });
		
	});
</script>
@stop
