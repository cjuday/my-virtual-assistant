@extends('layouts.client')
@section('topline','Payment Invoice')
@section('content')
    <div class="card shadow mb-4">
      <div class="card-body">
      <div class="container bootdey">
<div class="row invoice row-printable">
    <div class="col-md-12">
        <!-- col-lg-12 start here -->
        <div class="panel panel-default plain" id="dash_0">
            <!-- Start .panel -->
            <div class="panel-body p30">
                <div class="row">
                    <!-- Start .row -->
                    <div class="col-lg-6">
                        <!-- col-lg-6 start here -->
                        <div class="invoice-logo"><img width="200" height="180" src="../../images/logo.png" alt="Invoice logo"></div>
                    </div>
                    <!-- col-lg-6 end here -->
                    <div class="col-lg-6">
                        <!-- col-lg-6 start here -->
                        <div class="invoice-from">
                            <ul class="list-unstyled text-right">
                                <li>{{$details->company_name}}</li>
                                <li><i class="fas fa-home"></i> {{$details->address}}</li>
                                <li><i class="fas fa-phone"></i> {{$details->contact}}</li>
                                <li><i class="fas fa-envelope-open"></i> {{$details->email}}</li>
                            </ul>
                        </div>
                    </div>
                    <!-- col-lg-6 end here -->
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="invoice-to mt25">
                                    <ul class="list-unstyled">
                                        <li><strong>Invoiced By</strong></li>
                                        <li>{{$clinet->name}}</li>
                                        <li><i class="fas fa-home"></i> {{$clinet->country}}</li>
                                        <li><i class="fas fa-envelope-open"></i> {{$clinet->email}}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 text-right">
                                <div class="invoice-to mt25">
                                    <ul class="list-unstyled">
                                        <li><strong>Invoiced To</strong></li>
                                        <li>{{$employee->name}}</li>
                                        <li><i class="fas fa-home"></i> {{$employee->location}}</li>
                                        <li><i class="fas fa-phone"></i> {{$employee->contact}}</li>
                                        <li><i class="fas fa-envelope-open"></i> {{$employee->email}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-items">
                            <div class="table-responsive" style="overflow: hidden; outline: none;" tabindex="0">
                                <table class="table table-bordered table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th class="per70 text-center">Project Name</th>
                                            <th class="per5 text-center">Time Spent</th>
                                            <th class="per5 text-center">Hourly Rate</th>
                                            <th class="per25 text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$pro->project_name}}</td>
                                            <td class="text-center">{{timescale($pro->difference)}}</td>
                                            <td class="text-center">${{$emp->hourly_charge}}</td>
                                            <td class="text-center">${{number_format((float)($pro->due), 3, '.', '')}}</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-right">Sub Total:</th>
                                            <th class="text-center">${{number_format((float)($pro->due), 3, '.', '')}}</th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right">5% VAT:</th>
                                            <th class="text-center">${{number_format((float)($pro->total - $pro->due), 3, '.', '')}}</th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right">Total:</th>
                                            <th class="text-center">${{number_format((float)($pro->total), 3, '.', '')}}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- col-lg-12 end here -->
                </div>
                <!-- End .row -->
                @if($pro->payment_status!='Paid')
                    @if($payment==1)
                        <h5>Awaiting Admin Review.</h5>
                    @else
                        <a href="{{route('client.requestpay',['project_id'=>$pro->project_id])}}" class="btn btn-success">Send Payment Request</a>
                    @endif
                @endif
            </div>
        </div>
        <!-- End .panel -->
    </div>
    <!-- col-lg-12 end here -->
</div>
</div>
      </div>
    </div>
@endsection
