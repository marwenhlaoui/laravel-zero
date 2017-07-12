@extends('layouts.admin')

@section('content') 
            <div class="panel panel-default">
                <div class="panel-heading">
                	<span class="pull-right">
                		<a href="{{ route('admin.users.index') }}" class="btn btn-xs btn-info"><i class="ion ion-navicon"></i> &nbsp; All Users</a>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-xs btn-success"><i class="ion ion-plus"></i> &nbsp; Add New User</a>
                	</span>
                	<b>{{$user->name}}</b>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.users.update',$user->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ (old('name'))?old('name'):$user->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ (old('email'))?old('email'):$user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                            <label for="avatar" class="col-md-4 control-label">Avatar</label>

                            <div class="col-md-6">
                                <input id="avatar" type="file" class="form-control" name="avatar" >

                                @if ($errors->has('avatar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-4 control-label">Role</label>
                          <div class="col-md-6">
                            <div class="checkbox">
                              <label>
                                <input name="role" type="checkbox" {{ (old('role')OR($user->role))?'checked':'' }}> Admin
                              </label>
                            </div>
                          </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group"><hr>
                            <div class="col-md-4 col-md-offset-8">
                                <button type="submit" class="btn btn-success">
                                    Update
                                </button>
                            <a href="" class="btn btn-danger delete-user" data-user="{{$user->id}}">Delete</a>
                            </div>
                        </div>
                    </form>
                    <form action="{{ route('admin.users.destroy',$user->id) }}" method="post" id="delete-form">
                                {{csrf_field()}}
                                {{ method_field('delete') }} 
                    </form>
                </div>
            </div> 
@endsection
@include('layouts.admin.includes._modal-confirm')
@section('js')
<script type="text/javascript">
    $('.delete-user').on('click',function(e){
        e.preventDefault();
        var id = $(this).attr('data-user');
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