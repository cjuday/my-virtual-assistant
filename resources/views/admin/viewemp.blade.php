@extends('layouts.admin')
@section('topline','Employee List')
@section('content')

@if(session('success'))
  <div class="alert alert-success">
    <i class="fas fa-check-circle"></i> {{session('success')}}
  </div>
@endif

<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
    <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Name</div></th>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Email</div></th>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Contact</div></th>
       <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Action</div></th>
     
    </tr>
  </thead>
  <tbody>
  	@foreach($view as $view)
    <tr>
      <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{$view->name}}</div></td>
      <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{$view->email}}</div></td>
      <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{$view->contact}}</div></td>
      <td><a href="{{route('employee.profile',['id'=>$view->id])}}" class="btn btn-info btn-sm"><i class="fas fa-info"></i></a> <a  data-target="#deleteEmp_{{$view->id}}" data-toggle="modal" data-name="{{$view->name}}" data-id="{{$view->id}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a></td>
      <!-- Delete Employee Modal-->
    <div class="modal fade" id="deleteEmp_{{$view->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete {{$view->name}}'s profile?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to delete the employee - {{$view->name}}'s profile?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{route('deleteemp',['id'=>$view->id])}}" >Delete</a>
                </div>
            </div>
        </div>
    </div>
    </tr>
    @endforeach
  </tbody>
</table>  
    </div>
  </div>
</div>
 


@endsection