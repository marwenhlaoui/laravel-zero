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
                        <form class="form-horizontal row" style="padding: 20px 5%;" action="{{ route('admin.service.update',$service->id) }}" method="post">
                           {{ csrf_field() }}
                           {{ method_field('PUT')}}
                            <fieldset> 
                              <div class="form-group">
                                <label for="inputTitle" class="col-lg-2 control-label">Title</label>
                                <div class="col-lg-9">
                                  <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Title" value="{{ (old('title'))?old('title'): $service->title }}">
                                </div>
                              </div> 
                              <div class="form-group">
                                <label for="inputTitle" class="col-lg-2 control-label">Description</label>
                                <div class="col-lg-9">
                                  <input type="text" name="description" class="form-control" id="inputDescription" placeholder="Description" maxlength="200" value="{{ (old('description'))?old('description'): $service->description }}">
                                </div>
                              </div> 
                              <div class="form-group">
                                <label for="inputTitle" class="col-lg-2 control-label">Access : </label>
                                <div class="col-lg-9">

                                  <ul style="list-style: none;"><br>
                                    @foreach(all_models() as $k=>$value)
                                      <li>
                                        <label> <input type="checkbox" name="access[]" value="{{$value}}" {{(in_array($value,$service->access()))?'checked':''}} > &nbsp; {{$value}} </label>
                                      </li>
                                    @endforeach
                                  </ul>
                                </div>
                              </div> 
                              <div class="form-group">
                                <label for="inputTitle" class="col-lg-2 control-label">Team : </label>
                                <div class="col-lg-9">
                                  <br>
                                  <select multiple="" class="form-control" name="users[]">
                                    @foreach(App\Models\User::allUsers() as $k=>$user)
                                      <option value="{{$user->id}}" {{(in_array($user->id,$service->users('user')))? "selected" : ""}} >{{ $user->name }}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div> 
                              <div class="form-group"><hr>
                                <div class="col-md-4 col-md-offset-8"> 
                                  <button type="submit" class="btn btn-success">Update</button>
                                </div>
                              </div>
                            </fieldset>
                          </form>
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