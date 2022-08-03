@extends('layouts.client')
@section('topline','Client Profile')
@section('content')
<div align="center">
<h3 class="text-primary">Personal Details</h3>
</div>
<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Client Name:</div>
<div class="text-sm font-weight-bold text-dark text-uppercase mb-3">{{$dt->name}}</div>

<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">E-mail Address:</div>
<div class="text-sm font-weight-bold text-dark text-uppercase mb-3">{{$dt->email}}</div>

<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Location:</div>
<div class="text-sm font-weight-bold text-dark text-uppercase mb-3">{{$dt->location}}</div>

<br/><br/>

<div align="center">
<h3 class="text-primary">Company Details</h3>
</div>

<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Company Name:</div>
@if(empty($pd->company))
<div class="text-sm font-weight-bold text-dark text-uppercase mb-3">Not specified.</div>
@else
<div class="text-sm font-weight-bold text-dark text-uppercase mb-3">{{$pd->company}}</div>
@endif

<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Designation:</div>
@if(empty($pd->job_title))
<div class="text-sm font-weight-bold text-dark text-uppercase mb-3">Not specified.</div>
@else
<div class="text-sm font-weight-bold text-dark text-uppercase mb-3">{{$pd->job_title}}</div>
@endif

<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Tagline:</div>
@if(empty($pd->tagline))
<div class="text-sm font-weight-bold text-dark text-uppercase mb-3">Not specified.</div>
@else
<div class="text-sm font-weight-bold text-dark text-uppercase mb-3">{{$pd->tagline}}</div>
@endif
<br/><br/>

@endsection