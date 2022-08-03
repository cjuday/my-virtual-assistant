@extends('layouts.admin')
@section('topline','Profile Settings')
@section('content')
<form action="{{route('admin.set_up')}}" method="post">
    @csrf
@if(Session::has('success'))
<div class="alert alert-success">
    <i class="fas fa-check"></i> {{Session::get('success')}}
</div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger">
    <i class="fas fa-times"></i> {{Session::get('error')}}
</div>
@endif
<div class="card shadow mb-4">
    <div class="card-header">
        <h3 class="text-primary">Personal Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Admin Name:</div>
                <input class="form-control" name="name" value="{{$dt->name}}">
            </div>
            <div class="col-md-6">
                <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">E-mail Address:</div>
                <input class="form-control" name="email" value="{{$dt->email}}">
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-6">
                <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Location:</div>
                <input class="form-control" name="location" value="{{$dt->country}}">
            </div>
        </div>
    </div>
</div>
    <div class="card shadow mb-4">
        <div class="card-header">
            <h3 class="text-primary">Change Password</h3>
        </div>
        <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Enter Password:</div>
                <input class="form-control" type="password" name="pass" Placeholder="Password">
            </div>
            <div class="col-md-6">
                <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Confirm Password:</div>
                <input class="form-control" type="password" name="passx" Placeholder="Confirm Password">
            </div>
        </div>
        </div>
        
        <input type="hidden" name="id" value="{{$dt->id}}">
    </div>
    <div class="float-right mb-4">
            <button class="btn btn-primary" type="submit">Update Profile</button>
        </div>
</form>
@endsection