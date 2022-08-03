@extends('layouts.admin')
@section('topline', 'New Employee Registration')
@section('content')

 <form action="{{route('employee.reg')}}" method="POST">
        @csrf
        @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <i class="fas fa-exclamation-circle"></i> {{ $error }}
        @endforeach
    </div>
@endif

@if(session('success'))
   <div class="alert alert-success">
       <i class="fas fa-check-circle"></i> {{session('success')}}
   </div>
@endif
      <div class="row">
          <div class="col-md-6">
            <label>Name</label><br>
            <input type="text" name="name" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Email</label><br>
            <input type="email" name="email" class="form-control">
          </div>
      </div>

      <div class="row">
          <div class="col-md-6">
            <label>Contact</label><br>
            <input type="text" name="contact" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Country</label><br>
            <input type="text" name="location" class="form-control">
          </div>
      </div>

      <div class="row">
        <div class="col-md-6">
            <label>Designation</label><br>
            <input type="text" name="working_post" class="form-control">
        </div>
        <div class="col-md-6">
            <label>Password</label><br>
            <input type="password" name="password" class="form-control">
        </div>
      </div>
    
      <br/>
      <input type="submit" value="Register Employee" class="btn btn-info"><br/>
    </form>
    <br/>
@endsection