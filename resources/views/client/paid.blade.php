@extends('layouts.client')
@section('topline','Paid Task List')
@section('content')
@if(count($payment)==0)
<h2>No tasks have been paid yet.</h2>
@else
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
    <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Project Title</div></th>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Charge</div></th>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Payment Status</div></th>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Time</div></th>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Invoice</div></th>

      
    </tr>
  </thead>
  <tbody>
    <tr>
     @foreach($payment as $payment)
      <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{$payment->project_name}}</div></td>
      <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{$payment->currency}}{{$payment->due}}</div></td>
      <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{$payment->payment_status}}</div></td>
      <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{timescale($payment->difference)}}</div></td>
      <td>
      
      <a href="{{route('client.invoice',['project_id'=>$payment->project_id])}}" class="btn btn-info btn-sm"><i class="fas fa-file-invoice"></i></a>
    </td>

    </tr>
   @endforeach
  </tbody>
</table>
    </div>
  </div>
</div>
@endif
@endsection