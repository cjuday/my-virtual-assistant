@extends('layouts.client')
@section('topline','New Project')
@section('content')
@if(get_hourly(request('id'))->hourly_charge==0)
<div class="alert alert-warning">
  <i class="fas fa-info"></i> This employee can't be hired as he haven't updated working conditions yet.
  <a href="{{route('client.searchfilter')}}">Go back to search</a>.
</div>
@else
<form action="{{route('client.project')}}" method="POST">
	 @csrf
	 	<div class="row">
       <div class="col-md-6">
       <label for="project_name">Project Title :</label>
      <input type="text" name="project_name" placeholder="Project Title..." class="form-control">
       </div>
     </div>

  <br>

   
	 	<label for="project_details">Project Details</label>
      <textarea  name="project_details" placeholder="Keep it to the point" rows="10" class="form-control"></textarea> 

 <br>

 

   
	 	<div class="row">
       <div class="col-md-6">
       <label for="employee_id">Employee ID</label>
      <input type="text" name="employee_id" class="form-control" value="{{request('id')}}" readonly="readonly">
       </div>
     </div>

  <br>
   <div class="row">
     <div class="col-md-6">
     <label for="project_name">Days Estimated</label>
      <input type="text" name="days" id="days" placeholder="Number of days.." class="form-control">
     </div>
   </div>

 <br>
<input type="hidden" name="emp_id" value="{{$id}}">
<input type="submit" value="Add Project" class="btn btn-primary">

</form>
<br/>

@endif
@endsection