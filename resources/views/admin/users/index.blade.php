@extends('layouts.admin')

@section('content') 
            <div class="panel panel-default">
                <div class="panel-heading">
                	<span class="pull-right">
                		<a href="" class="btn btn-xs btn-success"><i class="ion ion-plus"></i> &nbsp; Add New User</a>
                	</span>
                	<b>Users</b>
                </div>

                <div class="panel-body">
                   <table class="table table-striped table-hover ">
					  <thead>
					    <tr>
					      <th>#</th>
					      <th>Name</th>
					      <th>E-mail</th>
					      <th>Created at</th>
					    </tr>
					  </thead>
					  <tbody>
					  	@foreach($users as $k=>$user)
					    <tr>
					      <td>{{$k+1}}</td>
					      <td>{{$user->name}}</td>
					      <td>{{$user->email}}</td>
					      <td>{{$user->created_at}}</td>
					    </tr> 
					    @endforeach
					  </tbody>
					</table> 
                </div>
            </div> 
@endsection
