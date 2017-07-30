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
                	<b>Inbox</b>
                </div>

                <div class="panel-body">
                   <table class="table table-striped table-hover ">
					  <thead>
					    <tr>
					      <th>#</th> 
					      <th>From</th>  
					      <th>E-mail</th>  
					      <th class="hidden-sm hidden-xs visible-lg">Created at</th>
					      <th></th>
					    </tr>
					  </thead>
					  <tbody>
					  	@foreach($messages as $k=>$msg)
					    <tr>
					      <td> 
					      	@if($msg->see == true) 
					      	<i class="ion ion-android-drafts"></i>
					      	@else
					      	<i class="ion ion-android-mail"></i>
					      	@endif
					      </td>
					      <td>{{str_limit($msg->name,15,'...')}}</td> 
					      <td>{{str_limit($msg->email,15,'...')}}</td> 
					      <td style="font-size: 10px;" class="text-muted hidden-sm hidden-xs visible-lg">{{$msg->created_at}} <b class="text-primery">( {{$msg->created_at->diffForHumans()}} )</b></td>
					      <td>
					      	<a href="{{route('admin.inbox.show',$msg->id)}}" class="btn btn-xs btn-info">Show</a> 
					      	<a href="" class="btn btn-xs btn-danger delete-msg" data-msg="{{$msg->id}}">Delete</a>
					      	<form action="{{ route('admin.inbox.destroy',$msg->id) }}" method="post" >
					      		{{csrf_field()}}
					      		{{ method_field('DELETE') }} 
					      	</form>
					      </td>
					    </tr> 
					    @endforeach
					  </tbody>
					</table> 
                </div>
					<center>{{ $messages->links() }}</center>
            </div> 
@include('layouts.admin.includes._modal') 
@include('layouts.admin.includes._modal-confirm') 
@endsection 
@section('js')
<script type="text/javascript">
	$('.delete-msg').on('click',function(e){
		e.preventDefault();
		var id = $(this).attr('data-msg');
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
