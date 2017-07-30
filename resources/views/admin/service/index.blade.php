@extends('layouts.admin')

@section('content')
			<div class="row">
				<div class="col-sm-4">
					<div class="alert alert-dismissible alert-info"> 
					  <h4>{{count(\App\Models\Contact::all())}}</h4> 
					  <p>All Messages</p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="alert alert-dismissible alert-danger"> 
					  <h4>{{count(\App\Models\Contact::where('see',false)->get())}}</h4> 
					  <p>New Messages</p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="alert alert-dismissible alert-warning"> 
					  <h4>{{count(\App\Models\Contact::where('see',true)->get())}}</h4> 
					  <p>opened Messages</p>
					</div>
				</div>
			</div> 
            <div class="panel panel-default">
                <div class="panel-heading"> 
                	<span class="pull-right">
                		<a href="{{route('admin.service.create')}}" class="btn btn-xs btn-success" data-toggle="modal" data-target="#mediaUploadModal"><i class="ion ion-plus"></i> &nbsp; Add Service</a>
                	</span>
                	<b>Services</b>
                </div>

                <div class="panel-body"> 
					  	@foreach($services as $k=>$item)
					  	<div class="col-xs-12 well">
					  		<div class="col-xs-3 text-center">
					  			<i class="fa fa-5x  fa-id-card"></i>
					  		</div>
					  		<div class="col-xs-9">
					  			<span class="pull-right">
					  				{{$item->created_at->diffForHumans()}}
					  			</span>
					  			<h3>{{ $item->title }}</h3>
					  			<p>{{ str_limit($item->description,100,'...') }}</p>
					  			<hr>
					  			<p> 
                					<a href="{{route('admin.service.edit',$item->id)}}" class="btn btn-xs btn-warning">Edit</a>
                					<a href="{{route('admin.service.show',$item->id)}}" class="btn btn-xs btn-info">Show</a>
							      	<a href="" class="btn btn-xs btn-danger delete-service" data-service="{{$item->id}}">Delete</a>

					  			</p>

								    <form action="{{ route('admin.service.destroy',$item->id) }}" method="post" class="service-delete-{{$item->id}}">
								    	{{csrf_field()}}
								    	{{ method_field('DELETE') }} 
								    </form>
					  		</div>
					  	</div>   
					    @endforeach 
                </div>
				<center>{{ $services->links() }}</center>
            </div> 
@include('layouts.admin.includes._modal') 
@include('layouts.admin.includes._modal-confirm') 
@endsection 
@section('js')
<script type="text/javascript">
	$('.delete-service').on('click',function(e){
		e.preventDefault();
		var id = $(this).attr('data-service');
		var form = $(".service-delete-"+id); 
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
