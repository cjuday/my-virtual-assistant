@extends('layouts.admin')
@section('topline','Company Details')
@section('content')

@if(session('success'))
  <div class="alert alert-success">
    <i class="fas fa-check-circle"></i> {{session('success')}}
  </div>
@endif

<!--form-->
<form action="{{route('details')}}" method="POST">
	 @csrf
     @foreach($data as $dt)
     <div class="row">
        <div class="col-md-6">
        <div class="form-group">
     	   <label>Company Name</label>
     	   <input type="text" name="company_name" value="{{$dt->company_name}}" class="form-control" >
         </div>
        </div>

        <div class="col-md-6">
        <div class="form-group">
     	<label>Address</label>
     	<input type="text" name="address" value="{{$dt->address}}" class="form-control">
     </div>
        </div>
     </div>
    
     
     <div class="row">
        <div class="col-md-6">
        <div class="form-group">
     	<label>Contact No</label>
     	<input type="text" name="contact" value="{{$dt->contact}}" class="form-control">
     </div>
        </div>

        <div class="col-md-6">
        <div class="form-group">
     	<label>Email</label>
     	<input type="email" name="email" value="{{$dt->email}}"  class="form-control">
     </div>
        </div>
     </div>
     @endforeach
        <button class="btn btn-primary col-md-6" type="submit">Update Details</button>
</form>
<!--form ends-->
</div><!--container

@endsection