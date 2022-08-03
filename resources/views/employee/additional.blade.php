@extends('layouts.employee')
@section('topline','Additional Project Details')
@section('content')
  @foreach($proj as $p)
  	<div class="row">
      <div class="col-xl-12">
        <div class="card shadow mb-4">
          <div class="card-header">
            <h4><i class="fas fa-wrench"></i> {{$p->project_name}}</h4>
          </div>
          <div class="card-body">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Project Description:</div> {{$p->project_details}}<br/><br/>
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Assigned By:</div> {{get_client_name($p->client_id)}}<br/><br/>
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Assigned On:</div> {{fix_data_time($p->starting_day)}}<br/><br/>
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Additional Requirements:</div> {{$dtx}}<br/><br/>
          </div>
        </div>
      </div>
    </div>
  @endforeach
@endsection