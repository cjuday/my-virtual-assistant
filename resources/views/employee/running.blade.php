@extends('layouts.employee')
@section('topline','Running Projects')
@section('content')
@if(count($projects)==0)
<h2>No project is running at this moment.</h2>
@else

@foreach($projects as $project)
    <div class="row">
      <div class="col-xl-12">
        <div class="card shadow md-4">
          <div class="card-header">
            <h4><i class="fas fa-wrench"></i> {{$project->project_name}}</h4>
          </div>
          <div class="card-body">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Project Description:</div> {{$project->project_details}}<br/><br/>
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Assigned By:</div> {{get_client_name($project->client_id)}}<br/><br/>
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Assigned On:</div> {{fix_data_time($project->starting_day)}}<br/><br/>


            <a href="{{route('employee.additional',['project_id'=>$project->project_id])}}" class="btn btn-primary" >Additional Informations</a> <a class="btn btn-success" href="{{route('employee.project',['project_id'=>$project->project_id])}}">Project Statistics</a>

          </div>
        </div>
      </div>
    </div>
    <br/>
  @endforeach


  <div class="float-right mb-4">
        {{$projects->links()}}
  </div>
@endif
@endsection