@extends('layouts.employee')

@section('content')

<div class="container">
	 <div class="alert alert-info">  <h2>Working Condition</h2></div>
   <form action="{{route('employee.condition')}}" method="POST">
   @csrf

    @if(session()->has('success'))
    <div class="alert alert-success">  
     <h2>{{session('success')}}</h2>
    </div>
    @endif

   	    @foreach($find as $find)
         <label for="hourly_charge">Hourly Charge</label>
   	     <input type="number" name="hourly_charge" value="{{$find->hourly_charge}}" class="form-control">
         <br>
          
          <label for="working_status">Working Status</label>
          <br>
            
         
 <div class="form-check">
  <input type="radio" name="working_status" value="Remote" class="form-check-input">
  <label class="form-check-label" for="exampleRadios1">
    Remote
  </label>
</div>

 <div class="form-check">
  <input type="radio" name="working_status" value="On Site" class="form-check-input">
  <label class="form-check-label" for="exampleRadios1">
   On Site
  </label>
</div>

<div class="form-check">
  <input type="radio" name="working_status" value="Remote and On Site" class="form-check-input">
  <label class="form-check-label" for="exampleRadios1">
   Remote and On Site
  </label>
</div>
<br>
         <label for="time">Shift</label>
          
          <div class="form-check">
  <input type="radio" name="time" value="Day" class="form-check-input">
  <label class="form-check-label" for="exampleRadios1">
    Day
  </label>
</div>

 <div class="form-check">
  <input type="radio" name="time" value="Night" class="form-check-input">
  <label class="form-check-label" for="exampleRadios1">
    Night
  </label>
</div>

    <div class="form-check">
  <input type="radio" name="time" value="Day & Night" class="form-check-input">
  <label class="form-check-label" for="exampleRadios1">
   Both
  </label>
</div>  
     <br>
           <label for="link">Link</label>
   	     <input type="text" name="link" value="{{$find->link}}" class="form-control">
         <br>   
   @endforeach  
          <br>
          <input type="submit" name="submit" class="btn btn-info"> 

   </form>


</div>


@endsection