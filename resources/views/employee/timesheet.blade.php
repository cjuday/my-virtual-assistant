<?php
$url1=$_SERVER['REQUEST_URI'];
header("Refresh: 10; URL=$url1");
updateDiff();
?>
@extends('layouts.employee')
@section('topline','Timesheet')

@section('content')
@if(Session::has('success'))
<div class="alert alert-success">
    <i class="fas fa-check"></i> {{Session::get('success')}}
</div>
@endif
@if(count($project)>0)
<div class="card shadow">
  <div class="card-body">
    <div class="table-responsive">
    <table class="table table-bordered" width="100%" cellspacing="0">
    <thead>
    <tr>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Project Title</div></th>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Started At</div></th>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Assigned By</div></th>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Time Elapsed</div></th>
      <th scoper="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Time Tracker</div></th>
    </tr>
  </thead>
  <tbody>
      @foreach($project as $p)
        <tr>
            <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{$p->project_name}}</div></td>
            <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{fix_data_time($p->starting_day)}}</div></td>
            <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{get_client_name($p->client_id)}}</div></td>
            <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{timescale($p->difference)}}</div></td>
            <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">
      @if($p->end!=NULL)
        <b>Project is completed.</b>
      @else
        @if($p->start==NULL)
          <a href="{{route('start',['project_id'=>$p->project_id])}}" class="btn btn-success"><i class="fas fa-play"></i></a>
        @endif

        @if($p->pause==NULL && $p->start!=NULL && $p->end==NULL)
          <a href="{{route('pause',['project_id'=>$p->project_id])}}" class="btn btn-warning"><i class="fas fa-pause"></i></a>
        @elseif($p->pause!=NULL && $p->start!=NULL && $p->end==NULL)
          <a href="{{route('resume',['project_id'=>$p->project_id])}}" class="btn btn-warning"><i class="fas fa-play"></i></a>
        @endif

        @if($p->end==NULL && $p->start!=NULL)
          <a href="{{route('end',['project_id'=>$p->project_id])}}" class="btn btn-danger"><i class="fas fa-stop"></i></a>
        @endif
      @endif
</div></td>
        </tr>
      @endforeach
  </tbody>
    </table>
                            </div>
                        </div>
                    </div>
                    

  <div class="float-right mb-4">
        {{$project->links()}}
  </div>
  @else
  <h3>No Running Project At This Moment.</h3>
  @endif
@endsection