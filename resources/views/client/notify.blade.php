@extends('layouts.client')
@section('topline','Notifications')
@section('content')
@if(count($notification)>0)
@foreach($notification as $nf)
  <div class="row">
    <div class="col-xl-12">
      <div class="card shadow mb-4">
        <div class="card-body">
            <i class="fas fa-bell"></i> Project <span class="font-weight-bold text-primary text-uppercase mb-1"> {{$nf->project_name}}</span> {{$nf->notification_text}} on {{$nf->started}}. Check out <a href="{{route('client.timesheet')}}">timesheet</a> to check project progress.<br/>
        </div>
      </div>
    </div>
  </div>
@endforeach
<div class="float-right">
  {{$notification->links()}}
</div>
<br/><br/>
@else
<h2>No notifications at this moment.</h2>
@endif
@endsection