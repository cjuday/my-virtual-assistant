@extends('layouts.admin')
@section('topline','Completed Projects')
@section('content')
@if(session('success'))
  <div class="alert alert-success">
    <i class="fas fa-check-circle"></i> {{session('success')}}
  </div>
@endif

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
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Payment Status</div></th>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Action</div></th>
     
    </tr>
  </thead>
  <tbody>
  	@foreach($running as $running)
    <tr>
      <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{$running->project_name}}</div></td>
      <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{fix_data_time($running->starting_day)}}</div></td>
      <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{get_client_name($running->client_id)}}</div></td>
      <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{get_emp_name($running->employee_id)}}</div></td>
      <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{$running->payment_status}}</div></td>
      <td><a href="{{route('admin.projectdetails',['id'=>$running->project_id])}}" class="btn btn-info btn-sm"><i class="fas fa-info"></i></a>
      <a data-target="#deletePro_{{$running->project_id}}" data-toggle="modal" data-name="{{$running->project_name}}" data-id="{{$running->project_id}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a></td>
      <!-- Delete Employee Modal-->
    <div class="modal fade" id="deletePro_{{$running->project_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Project - {{$running->project_name}}?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to delete the project - {{$running->project_name}}?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{route('admin.deleteProject',['id'=>$running->project_id])}}" >Delete</a>
                </div>
            </div>
        </div>
    </div>


    </tr>
    @endforeach
  </tbody>
</table>  
@else
<h2>No project is completed yet.</h2>
@endif
    </div>
  </div>
</div>

@endsection
  
  
  