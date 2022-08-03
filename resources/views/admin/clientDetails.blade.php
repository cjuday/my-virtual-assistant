@extends('layouts.admin')
@section('topline','Details of '.$basic.'')
@section('content')

<div class="card shadow mb-4">
    <div class="card-body">
    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Client Name:</div>
    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">{{$basic}}</div><br/>

    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Organization Name:</div>
    @if(empty($client[0]))
    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Not Specified</div><br/>
    @else
    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">{{$client[0]}}</div><br/>
    @endif

    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Designation:</div>
    @if(empty($client[2]))
    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Not Specified</div><br/>
    @else
    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">{{$client[2]}}</div><br/>
    @endif

    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tagline:</div>
    @if(empty($client[1]))
    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Not Specified</div><br/>
    @else
    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">{{$client[1]}}</div><br/>
    @endif
    </div>
</div>

@endsection