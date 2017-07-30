@extends('layouts.admin')

@section('content') 
            <div class="panel panel-default">
                <div class="panel-heading">
                  <span class="pull-right">  
                        <a href="{{ route('admin.service.edit',$service->id) }}" class="btn btn-xs btn-warning"><i class="ion ion-gear-b"></i> &nbsp; Edit</a> 
                        <a href="" class="btn btn-xs btn-danger delete-service"><i class="ion ion-trash-a"></i> &nbsp; Delete</a> 
                  </span> 
                    <b>{{$service->title}}</b>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                          <div class="col-xs-3 text-center">
                            <i class="fa fa-5x  fa-id-card"></i>
                          </div>
                          <div class="col-xs-9">
                            <span class="pull-right">
                              {{$service->created_at->diffForHumans()}}
                            </span>
                            <h3>{{ $service->title }}</h3>
                            <p>{{ $service->description }}</p>  
                            <div>
                              <hr>
                              @foreach(App\Models\User::all() as $user) 
                                @if($service->have($user->id))
                                <a href="{{ route('admin.users.show',$user->id) }}" title="{{$user->name}}" class="pull-left">
                                  <img src="{{asset($user->avatar()) }}" style="width: 60px;height: 60px;" class="img-thumbnail">
                                </a>
                                @endif
                              @endforeach
                            </div>  
                          </div>
                        </div>
                    </div> 
                    <form action="{{ route('admin.service.destroy',$service->id) }}" method="post" id="delete-form">
                                {{csrf_field()}}
                                {{ method_field('delete') }} 
                    </form> 
                </div>
            </div> 
@endsection
@include('layouts.admin.includes._modal-confirm')
@section('js')
<script type="text/javascript">
    $('.delete-service').on('click',function(e){
        e.preventDefault();
        var id = $(this).attr('data-service');
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