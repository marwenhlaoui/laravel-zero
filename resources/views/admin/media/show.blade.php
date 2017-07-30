@extends('layouts.admin')

@section('content') 
            <div class="panel panel-default">
                <div class="panel-heading">
                	<span class="pull-right">   
                        <a href="" class="btn btn-xs btn-danger delete-media"><i class="ion ion-trash-a"></i> &nbsp; Delete</a>
                	</span> 
                    <b>{{$media->title}}</b>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="pull-right label label-info">{{ $media->type }}</span>
                            @if($media->type == "picture") 
                            <img src="{{asset($media->url)}}" class="img-thumbnail" style="max-width: 100%">
                            @elseif($media->type == "pdf")
                            <center>
                                <i class="ion ion-android-document" style="font-size: 20em;"></i><br>
                                <a href="{{ asset($media->url) }}" class="btn btn-success btn-xs">Download</a>
                            </center>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <h4>Title : {{ $media->title }}</h4>
                            <h5>Uploaded by : {{ (!empty($media->by()->id))?$media->by()->name:'Anonyme' }}</h5> 
                            <h5>Uploaded at : {{ $media->created_at }} &nbsp; ({{ $media->created_at->diffForHumans() }})</h5>
                            <b>Size : {{ $media->size }} oct</b> 
                        </div>
                    </div>
                    <form action="{{ route('admin.media.destroy',$media->id) }}" method="post" id="delete-form">
                                {{csrf_field()}}
                                {{ method_field('delete') }} 
                    </form>
                </div>
            </div>  
@include('layouts.admin.includes._modal-confirm') 
@endsection 
@section('js')
<script type="text/javascript">
	$('.delete-media').on('click',function(e){
		e.preventDefault();
		var id = $(this).attr('data-media');
		var form = $("#delete-form");
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