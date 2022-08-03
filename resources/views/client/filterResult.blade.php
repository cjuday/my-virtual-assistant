@extends('layouts.client')
@section('topline','Serach Results')
@section('content')
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
    <table class="table table-bordered">
		<thead>
      
			<th><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Employee Name</div></th>
      <th><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Designation</div></th>
      <th><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Hourly Charge</div></th>
      <th><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Project Completed</div></th>
      <th><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Action</div></th>
		</thead>
       <tbody>
       	@foreach($filter as $filter)
       	<tr>
         
       		<td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{$filter->name}}</div></td>
          <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{$filter->working_post}}</div></td>
          <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">${{get_hourly($filter->id)->hourly_charge}}</div></td>
          <td><div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{project_count($filter->id)}}</div></td>
          <td><a class="btn btn-info btn-sm" href="{{route('employee.clientviewProfile',['id'=>$filter->id])}}"><i class="fas fa-info"></i></a>
          <a class="btn btn-info btn-sm" href="{{route('search.hire',['id'=>$filter->id])}}"><i class="fas fa-user-plus"></i></a></td>
       	</tr>
        @endforeach

       </tbody>

	</table>
    </div>
  </div>
</div>
@endsection