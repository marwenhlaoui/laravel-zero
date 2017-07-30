<div class="list-group">
    <a href="{{route('admin.dashboard')}}" class="list-group-item {{(\Request::route()->getName() == 'admin.dashboard')?'active':''}}">
        <i class="ion ion-ios-speedometer-outline"></i> <b>&nbsp; Dashboard</b>
    </a> 
    <a href="{{route('admin.users.index')}}" class="list-group-item {{(in_array(\Request::route()->getName(),['admin.users.index','admin.users.create','admin.users.show','admin.users.edit']))?'active':''}}">
        <i class="ion ion-ios-people-outline"></i> <b>&nbsp; Users</b>
    </a> 
    <a href="{{route('admin.media.index')}}" class="list-group-item {{(in_array(\Request::route()->getName(),['admin.media.index','admin.media.create','admin.media.show','admin.media.edit']))?'active':''}}">
        <i class="ion ion-images"></i> <b>&nbsp; Media</b>
    </a> 
    <a href="{{route('admin.inbox.index')}}" class="list-group-item {{(in_array(\Request::route()->getName(),['admin.inbox.index','admin.inbox.create','admin.inbox.show','admin.inbox.edit']))?'active':''}}">
        <i class="ion ion-ios-filing"></i> <b>&nbsp; Inbox</b>
    </a>
    <a href="{{route('admin.service.index')}}" class="list-group-item {{(in_array(\Request::route()->getName(),['admin.service.index','admin.service.create','admin.service.show','admin.service.edit']))?'active':''}}">
        <i class="ion ion-ios-filing"></i> <b>&nbsp; Services</b>
    </a> 
</div>