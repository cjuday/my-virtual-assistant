<?php
$url1=$_SERVER['REQUEST_URI'];
header("Refresh: 10; URL=$url1");
updateDiff();
?>
@extends('layouts.client')
@section('topline','Timesheet')

@section('content')
@if(count($project)>0)
@if(Session::has('success'))
<div class="alert alert-success">
    <i class="fas fa-check"></i> {{Session::get('success')}}
</div>
@endif

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
        Project is completed.
      @else
        @if($p->start==NULL)
          Project is not started yet.
        @endif

        @if($p->pause==NULL && $p->start!=NULL && $p->end==NULL)
          Project ongoing.
        @elseif($p->pause!=NULL && $p->start!=NULL && $p->end==NULL)
          Paused.
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