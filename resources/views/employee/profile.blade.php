@extends('layouts.admin')
@section('topline','Profile')
@section('content')
<div align="center">
<h3 class="text-primary">Personal Details</h3>
</div>
<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Employee Name:</div>
<div class="text-sm font-weight-bold text-dark text-uppercase mb-3">{{$view->name}}</div>

<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">E-mail Address:</div>
<div class="text-sm font-weight-bold text-dark text-uppercase mb-3">{{$view->email}}</div>

<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Contact Number:</div>
<div class="text-sm font-weight-bold text-dark text-uppercase mb-3">{{$view->contact}}</div>

<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Location:</div>
<div class="text-sm font-weight-bold text-dark text-uppercase mb-3">{{$view->location}}</div>

<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Designation:</div>
<div class="text-sm font-weight-bold text-dark text-uppercase mb-3">{{$view->working_post}}</div>

<br/><br/>

<div align="center">
<h3 class="text-primary">Educations</h3>
</div>
@foreach($education as $edu)
<div class="text-md font-weight-bold text-success text-uppercase mb-1">{{$edu->degree}}</div>
<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Subject: {{$edu->subject}}</div>
<div class="text-sm font-weight-bold text-dark text-uppercase mb-3">Year of Passing: {{$edu->year}}</div>
@endforeach
<br/><br/>

<div align="center">
<h3 class="text-primary">Skills</h3>
</div>

<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Skillsets:</div>
<div class="text-sm font-weight-bold text-dark text-uppercase mb-3">{{$skills->skills}}</div>
<br/><br/>

<div align="center">
<h3 class="text-primary">Conditions</h3>
</div>

<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Hourly Charge:</div>
<div class="text-sm font-weight-bold text-dark text-uppercase mb-3">${{$condition->hourly_charge}}</div>

<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Preffered Type of Working:</div>
<div class="text-sm font-weight-bold text-dark text-uppercase mb-3">{{$condition->working_status}}</div>


<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Preffered Working Shift:</div>
<div class="text-sm font-weight-bold text-dark text-uppercase mb-3">{{$condition->time}}</div>
<br/><br/>

<div align="center">
<h3 class="text-primary">Work Statistics</h3>
</div>

<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Total Projects:</div>
<div class="text-sm font-weight-bold text-dark text-uppercase mb-3">{{$project}}</div>

<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Total Completed Projects:</div>
<div class="text-sm font-weight-bold text-dark text-uppercase mb-3">{{$complete}}</div>

<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Currently Running Projects:</div>
<div class="text-sm font-weight-bold text-dark text-uppercase mb-3">{{$project-$complete}}</div>
@endsection