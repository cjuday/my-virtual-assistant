@extends('layouts.admin')
@section('topline','Project Details')
@section('content')

@if(session('success'))
   <div class="alert alert-success">
     <i class="fas fa-check-circle"></i> {{session('success')}}
   </div>
@endif

<div class="card shadow mb-4">
  <div class="card-body">
@foreach($order as $order)
<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ordered By:</div>
<div class="text-sm font-weight-bold text-dark text-uppercase mb-1">{{$order->name}}</div>
<br/>
@endforeach

@foreach($assign as $assign)
<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Assigned to:</div>
<div class="text-sm font-weight-bold text-dark text-uppercase mb-1">{{$assign->name}}</div>
<br/>
@endforeach

@foreach($running as $running)
<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Project Name:</div>
<div class="text-sm font-weight-bold text-dark text-uppercase mb-1">{{$running->project_name}}</div>
<br/>
<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Starting Date:</div>
<div class="text-sm font-weight-bold text-dark text-uppercase mb-1">{{fix_data_time($running->starting_day)}}</div>
<br/>
<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Project Details:</div>
<div class="text-sm font-weight-bold text-dark text-uppercase mb-1">{{$running->project_details}}</div>
  <br/>
@foreach($details as $details)
<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Additional Project Details:</div>
<div class="text-sm font-weight-bold text-dark text-uppercase mb-1">{{$details->details}}</div>
<br/>
@endforeach 
@if($running->end!=NULL)
<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Price:</div>
<div class="text-sm font-weight-bold text-dark text-uppercase mb-1">{{$running->currency}}{{$running->total}}</div>
<br/>
<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Payment Details:</div>
<a href="{{route('admin.link',['project_id'=>$running->project_id])}}" class="btn btn-info">Send Project Link</a>
@if($running->payment_status!='Paid')
<a href="{{route('admin.confirm',['project_id'=>$running->project_id])}}" class="btn btn-info">Confirm Full Payment Clearance</a>
@endif
<br/><br/>
@endif
@endforeach
  </div>
</div>
@endsection