@extends('layouts.admin')

@section('content')
			<div class="row">
				<div class="col-xs-2">
						<a href="{{ route('admin.media.index') }}" class="alert alert-dismissible alert-link"> 
						  <i class="fa fa-3x fa-folder-o"></i>
						  <h5>{{count(\App\Models\Media::all())}}</h5>
						  <p>All</p>
						</a>
					</div>
					<div class="col-xs-2">
						<a href="{{ route('admin.media.index') }}?type=picture" class="alert alert-dismissible alert-link"> 
						  <i class="fa fa-3x fa-file-picture-o"></i>
						  <h5>{{count(\App\Models\Media::collect('picture'))}}</h5>
						  <p>Picture</p>
						</a>
					</div>
					<div class="col-xs-2">
						<a href="{{ route('admin.media.index') }}?type=video" class="alert alert-dismissible alert-link"> 
						  <i class="fa fa-3x fa-file-video-o"></i>
						  <h5>{{count(\App\Models\Media::collect('video'))}}</h5>
						  <p>Video</p>
						</a>
					</div>
					<div class="col-xs-2">
						<a href="{{ route('admin.media.index') }}?type=audio" class="alert alert-dismissible alert-link"> 
						  <i class="fa fa-3x fa-file-audio-o"></i>
						  <h5>{{count(\App\Models\Media::collect('audio'))}}</h5>
						  <p>Audio</p>
						</a>
					</div>
					<div class="col-xs-2">
						<a href="{{ route('admin.media.index') }}?type=pdf" class="alert alert-dismissible alert-link"> 
						  <i class="fa fa-3x fa-file-pdf-o"></i>
						  <h5>{{count(\App\Models\Media::collect('pdf'))}}</h5>
						  <p>PDF</p>
						</a>
					</div>
					<div class="col-xs-2">
						<a href="{{ route('admin.media.index') }}?type=rar" class="alert alert-dismissible alert-link"> 
						  <i class="fa fa-3x fa-file-archive-o"></i>
						  <h5>{{count(\App\Models\Media::collect('rar'))}}</h5>
						  <p>RAR</p>
						</a>
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
					      	@if($file->type == 'picture')
					      	<img src="{{ asset($file->preview) }}" style="max-width: 50px;min-width: 50px"> 
					      	@elseif(in_array($file->type,['video','audio','pdf']))
					      	<center>
					      		<i class="fa fa-2x fa-file-{{$file->type}}-o" style="font-size: 3em;margin-left: -35%;"></i>
					      	</center>
					      	@else 
					      	<center>
					      		<i class="fa fa-2x fa-file-archive-o" style="font-size: 3em;margin-left: -35%;"></i>
					      	</center>
					      	@endif
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
@section('css')
<style type="text/css">
	.alert-link{
		background-color: #eaeaea;
		float: left;
		width: 100%; 
		text-decoration: none;
		color: white!important;
		text-align: center;
	} 
	.alert-link:hover{
		background-color: #757575;
		text-decoration: none;
	}
</style>
@stop
