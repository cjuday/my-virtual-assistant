@extends('layouts.admin')
@section('topline','Payment Requests')
@section('content')

<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
    <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Project Title</div></th>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Started At</div></th>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Client ID</div></th>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Employee Assigned to</div></th>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Due</div></th>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Details</div></th>
     
    </tr>
  </thead>
  <tbody>
  	@foreach($running as $running)
    <tr>
      <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{project_id_by_name($running->project_id)}}</div></td>
      <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{$running->date}}</div></td>
      <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{get_client_name($running->client_id)}}</div></td>
      <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{get_emp_name($running->employee_id)}}</div></td>
      <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{number_format((float)$running->due, 2, '.', '');}}</div></td>
      <td><a href="{{route('admin.projectdetails',['id'=>$running->project_id])}}" class="btn btn-info btn-sm"><i class="fas fa-info"></i></a></td>
    </tr>
    @endforeach
  </tbody>
</table>  
    </div>
  </div>
</div>

@endsection