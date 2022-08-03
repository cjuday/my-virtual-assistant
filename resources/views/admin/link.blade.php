@extends('layouts.admin')
@section('topline','Project Link')
@section('content')

@if(session('success'))
   <div class="alert alert-success">
     <i class="fas fa-check-circle"></i> {{session('success')}}
   </div>
@endif

 <form action="{{route('link')}}" method="POST">
        @csrf


@foreach($find as $find)
      <label>Project Name:</label><br>
      <input type="text" value="{{$find->project_name}}" class="form-control" readonly><br>

      <label>Client Name:</label><br>
      <input type="text" name="client_id" value="{{get_client_name($find->client_id)}}" class="form-control" readonly><br>

      <label>Employee Name</label><br>
      <input type="text" name="employee_id" value="{{get_emp_name($find->employee_id)}}" class="form-control" readonly><br>

      <input type="hidden" name="id" value="{{$find->project_id}}">
      <label>Due</label><br>
      <input type="number" name="due" value="{{$find->total}}" class="form-control" readonly><br>
@endforeach


      <label>Link</label><br>
      <input type="text" name="link" class="form-control" value="{{$gg}}">
      <br/>
      <input type="submit" value="Send Link" class="btn btn-info">
    </form>
    <br/>
@endsection