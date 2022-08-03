@extends('layouts.employee')
@section('topline','Due Task List')
@section('content')
@if(count($dt)==0)
<h2>No task is due yet.</h2>
@else
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
    <table class="table table-bordered" width="100%" cellspacing="0">
    <thead>
    <tr>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Project Title</div></th>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Started At</div></th>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Assigned By</div></th>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Time</div></th>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Due</div></th>
      <th scope="col"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Payment (with VAT)</div></th>
    </tr>
  </thead>
  <tbody>
      @foreach($dt as $p)
        <tr>
            <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{$p->project_name}}</div></td>
            <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{fix_data_time($p->starting_day)}}</div></td>
            <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{get_client_name($p->client_id)}}</div></td>
            <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{timescale($p->difference)}}</div></td>
            <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">USD {{number_format((float)$p->due, 2, '.', '')}}</div></td>
            <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">USD {{number_format((float)$p->total, 2, '.', '')}}</div></td>
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