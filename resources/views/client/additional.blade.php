@extends('layouts.client')
@section('topline','Additional Informations')
@section('content')

<form action="{{route('client.adddetails')}}" method="POST">
	 @csrf

@if(session('success'))
   <div class="alert alert-success">  
      <i class="fas fa-check"></i> {{session('success')}}
   </div>
@endif

   @foreach($project as $project)
   <div class="col-lg-6">
	 	<label for="project_name">Project Title</label>
      <input type="text" name="project_name" class="form-control" value="{{$project->project_name}}" readonly>
</div>
  <br>

   <?php
   $xx = additional($project->project_id);
   $xy = project_det($project->project_id);
      ?>
   @if($xy->status=='Completed')
   <div class="col-lg-12">
       <label for="details">Additional Details</label>
      <textarea  name="details" rows="10" class="form-control" readonly>{{$xx}}</textarea> 
       </div>
   @else
   @if(!empty($xx))
	 	<div class="col-lg-12">
       <label for="details">Additional Details</label>
      <textarea  name="details" rows="10" class="form-control">{{$xx}}</textarea> 
       </div>
   @else
      <div class="col-lg-12">
       <label for="details">Additional Details</label>
      <textarea  name="details" placeholder="Keep it to the point" rows="10" class="form-control"></textarea> 
       </div>
   @endif
   @endif



 <br>

@endforeach 

   
<div class="col-lg-6">
   <input class="hidden" name="project_id" value="{{$project->project_id}}">
@if($xy->status!='Completed')
<input type="submit" value="Update" class="btn btn-primary">
@else
<a href="{{route('client.all')}}" class="btn btn-primary">Go back</a>
@endif
</div>
<br/>

</form>

	
@endsection