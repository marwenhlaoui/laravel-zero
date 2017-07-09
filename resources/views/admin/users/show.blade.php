@extends('layouts.admin')

@section('content') 
            <div class="panel panel-default">
                <div class="panel-heading">
                	<span class="pull-right">  
                        <a href="{{ route('admin.users.edit',$user->id) }}" class="btn btn-xs btn-warning"><i class="ion ion-gear-b"></i> &nbsp; Edit</a>
                        <a href="" class="btn btn-xs btn-danger delete-user"><i class="ion ion-trash-a"></i> &nbsp; Delete</a>
                	</span> 
                    <b>{{$user->name}}</b>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-4">
                            @if($user->role)
                            <span class="label label-success" style="position: absolute;">admin</span>
                            @endif
                            <img src="{{asset('img/user-default.png')}}" class="img-thumbnail" style="max-width: 100%">
                        </div>
                        <div class="col-sm-8">
                            <h4>{{ $user->name }}</h4>
                            <h5>{{ $user->email }}</h5> 
                        </div>
                    </div>
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