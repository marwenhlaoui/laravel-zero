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
                            <img src="{{asset($media->url)}}" class="img-thumbnail" style="max-width: 100%">
                        </div>
                        <div class="col-sm-6">
                            <h4>Title : {{ $media->title }}</h4>
                            <h5>Uploaded by : {{ $media->by()->name }}</h5> 
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