@extends('layouts.employee')
@section('topline','Profile Settings')
@section('content')
<form action="{{route('employee.set_up')}}" method="post">
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
                <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Employee Name:</div>
                <input class="form-control" name="name" value="{{$view->name}}">
            </div>
            <div class="col-md-6">
                <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">E-mail Address:</div>
                <input class="form-control" name="email" value="{{$view->email}}">
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-6">
                <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Contact Number:</div>
                <input class="form-control" name="number" value="{{$view->contact}}">
            </div>
            <div class="col-md-6">
                <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Location:</div>
                <input class="form-control" name="location" value="{{$view->location}}">
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-6">
                <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Designation:</div>
                <input class="form-control" name="desig" value="{{$view->working_post}}">
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header">
        <h3 class="text-primary">Educations</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Degree:</div>
                <input class="form-control" name="deg" Placeholder="Degree">
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-6">
                <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Subject:</div>
                <input class="form-control" name="sub" Placeholder="Subject">
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-6">
                <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Year of Passing:</div>
                <input class="form-control" name="year" Placeholder="Year of Passing">
            </div>
        </div>
        <br/><br/>

        <h3 class="text-primary">Edit Educations</h3>
        @foreach($education as $edu)
            <div class="row">
                <div class="col-sm-6">
                    <div class="text-md font-weight-bold text-success text-uppercase mb-1">{{$edu->degree}}</div>
                </div>
                <div class="col-sm-6">
                    <a href="" class="btn btn-primary btn-sm"><i class="fas fa-user-edit"></i></a> <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a> 
                </div>
            </div>
            <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Subject: {{$edu->subject}}</div>
            <div class="text-sm font-weight-bold text-dark text-uppercase mb-3">Year of Passing: {{$edu->year}}</div>
        <br/>
        @endforeach
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header">
        <h3 class="text-primary">Skillsets</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Skillsets:</div>
                <input class="form-control" name="skl" value="{{$skills->skills}}">
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header">
        <h3 class="text-primary">Conditions</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Hourly Charge:</div>
                <input class="form-control" name="charge" value="{{$cond->hourly_charge}}">
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-6">
                <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Preffered Type of Work:</div>
                <select class="form-control" name="type">
                    <option value="0">Select...</option>
                    <option value="Remote">Remote</option>
                    <option value="On Site">On Site</option>
                    <option value="Both">Both</option>
                </select>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-6">
                <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Preffered Working Shift:</div>
                <select class="form-control" name="shift">
                    <option value="0">Select...</option>
                    <option value="Day">Day</option>
                    <option value="Night">Night</option>
                    <option value="Both">Both</option>
                </select>
            </div>
        </div>
        <input type="hidden" name="id" value="{{$view->id}}">
        <div class="float-right">
            <button class="btn btn-primary" type="submit">Update Profile</button>
        </div>
    </div>
</div>

</form>
@endsection