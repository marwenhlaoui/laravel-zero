@extends('layouts.admin')

@section('content') 
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>From : {{$message->name}}</b>
                    <span class="pull-right">
                        {{$message->email}}
                    </span>
                </div>

                <div class="panel-body">
                    <div class="row"> 
                        <div class="col-xs-12">
                            <p>{{ $message->message }}</p> 
                        </div>
                    </div> 
                    <form action="{{ route('admin.users.destroy',$message->id) }}" method="post" id="delete-form">
                                {{csrf_field()}}
                                {{ method_field('delete') }} 
                    </form> 
                    <hr>
                    <span class="pull-right">  
                        <a href="" class="btn btn-xs btn-danger delete-msg"><i class="ion ion-trash-a"></i> &nbsp; Delete</a>
                    </span> 
                </div>
            </div> 
@endsection
@include('layouts.admin.includes._modal-confirm')
@section('js')
<script type="text/javascript">
    $('.delete-msg').on('click',function(e){
        e.preventDefault();
        var id = $(this).attr('data-msg');
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