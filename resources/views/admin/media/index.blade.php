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
					      <th>Name</th>
					      <th class="visible-sm visible-md  visible-lg hidden-xs">E-mail</th>
					      <th class="hidden-xs hidden-sm">Role</th>
					      <th class="hidden-sm hidden-xs visible-lg">Created at</th>
					      <th></th>
					    </tr>
					  </thead>
					  <tbody>
					  	@foreach($medias as $k=>$user)
					    <tr>
					      <td>{{$k+1}}</td>
					      <td>{{str_limit($user->name,15,'...')}}</td>
					      <td class="visible-sm visible-md  visible-lg hidden-xs">{{str_limit($user->email,15,'...')}}</td>
					      <td class="hidden-xs hidden-sm">
					      	@if($user->role)
					      	<span class="label label-success">admin</span>
					      	@else
					      	<span class="label label-default">user</span>
					      	@endif
					      </td>
					      <td style="font-size: 10px;" class="text-muted hidden-sm hidden-xs visible-lg">{{$user->created_at}} <b class="text-primery">( {{$user->created_at->diffForHumans()}} )</b></td>
					      <td>
					      	<a href="{{ route('admin.users.show',$user->id) }}" class="btn btn-xs btn-info">Show</a>
					      	<a href="{{ route('admin.users.edit',$user->id) }}" class="btn btn-xs btn-warning">Edit</a>
					      	<a href="" class="btn btn-xs btn-danger delete-user" data-user="{{$user->id}}">Delete</a>
					      	<form action="{{ route('admin.users.destroy',$user->id) }}" method="post" >
					      		{{csrf_field()}}
					      		{{ method_field('delete') }} 
					      	</form>
					      </td>
					    </tr> 
					    @endforeach
					  </tbody>
					</table> 
                </div>
            </div> 
@include('layouts.admin.includes._modal') 
@endsection 
@section('js')
<script type="text/javascript">
	$('.delete-user').on('click',function(e){
		e.preventDefault();
		var id = $(this).attr('data-user');
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
