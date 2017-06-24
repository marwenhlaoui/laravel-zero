<div class="list-group">
    <a href="{{route('admin.dashboard')}}" class="list-group-item {{(\Request::route()->getName() == 'admin.dashboard')?'active':''}}">
        <i class="ion ion-ios-speedometer-outline"></i> &nbsp; Dashboard
    </a> 
    <a href="{{route('admin.users.index')}}" class="list-group-item {{(\Request::route()->getName() == 'admin.users.index')?'active':''}}">
        <i class="ion ion-ios-people-outline"></i> &nbsp; Users
    </a> 
</div>