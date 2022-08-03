@extends('layouts.employee')
@section('topline','Notifications')
@section('content')

@foreach($notification as $nf)
  <div class="row">
    <div class="col-xl-12">
      <div class="card shadow mb-4">
        <div class="card-body">
            <i class="fas fa-bell"></i> {{$nf->notification_text}} from <span class="font-weight-bold text-primary text-uppercase mb-1"> {{$nf->client_name}}</span> titled <span class="font-weight-bold text-primary text-uppercase mb-1"> {{$nf->project_name}}</span>. Check out <a href="{{route('employee.project',['project_id'=>$nf->project_id])}}">the project</a>.<br/>
        </div>
      </div>
    </div>
  </div>
@endforeach
@endsection