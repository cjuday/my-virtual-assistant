@extends('layouts.admin')
@section('topline','Running Project')
@section('content')

<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
    @if($count>0)
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Project Title</div></th>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Started At</div></th>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Assigned By</div></th>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Assigned To</div></th>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Actions</div></th>
    </tr>
  </thead>
  <tbody>
  	@foreach($running as $running)
    <tr>
      <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{$running->project_name}}</div></td>
      <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{fix_data_time($running->starting_day)}}</div></td>
      <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{get_client_name($running->client_id)}}</div></td>
      <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{get_emp_name($running->employee_id)}}</div></td>
      <td><a href="{{route('admin.projectdetails',['id'=>$running->project_id])}}" class="btn btn-info btn-sm"><i class="fas fa-info"></i></a></td>

    </tr>
    @endforeach
  </tbody>
</table>  
@else
<h2>No project is being running now.</h2>
@endif
    </div>
  </div>
</div>

@endsection