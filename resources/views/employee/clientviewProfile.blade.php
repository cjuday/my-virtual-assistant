@extends('layouts.client')

@section('content')
<div class='container'>
  @if(session('success'))
   <div class="alert alert-success">  <h2>{{session('success')}}</h2></div>
@endif
    <div style="text-align: center;" class="alert alert-warning" role="alert">
 Basic Info
</div>
<table class="table table-secondary table-hover">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Designation</th>
      <th scope="col">Email</th>
      <th scope="col">Contact</th>
      <th scope="col">Location</th>
      <th scope="col">Education</th>
      <th scope="col">Skills</th>
      
     
    </tr>
  </thead>
  <tbody>
  	@foreach($view as $view)
    <tr>

    
      <td>{{$view->id}}</td>
      <td>{{$view->name}}</td>
      <td>{{$view->working_post}}</td>
      <td>{{$view->email}}</td>
      <td>{{$view->contact}}</td>
      <td>{{$view->location}}</td>
       @endforeach
       @foreach($edu as $edu)
       
      <td>{{$edu->degree}} in {{$edu->subject}}</td>

       @endforeach
       @foreach($skills as $skills)
       
      <td>{{$skills->skills}}</td>

       @endforeach
    </tr>
  
  </tbody>
</table>  
 
    <div style="text-align: center;" class="alert alert-warning" role="alert">
Projects
</div>
<table class="table table-secondary table-hover">
  <thead>
    <tr>
      <th scope="col">Total</th>
      <th scope="col">Completed</th> 
    </tr>
  </thead>
  <tbody>
   
    <tr>

    
      <td>{{$project}}</td>
      <td>{{$complete}}</td>


    </tr>
    
  </tbody>
</table> 

    <div style="text-align: center;" class="alert alert-warning" role="alert">
Working Condition
</div>
<table class="table table-secondary table-hover">
  <thead>
    <tr>
      <th scope="col">Working Status</th>
      <th scope="col">Hourly Charge</th>
      <th scope="col">Shift</th>

      
     
    </tr>
  </thead>
  <tbody>
    @foreach($condition as $condition)
    <tr>

    
      <td>{{$condition->working_status}}</td>
      <td>{{$condition->currency}}{{$condition->hourly_charge}}</td>
      <td>{{$condition->time}}</td>


    </tr>
    @endforeach
  </tbody>
</table>

@endsection

