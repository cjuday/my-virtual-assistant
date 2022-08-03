@extends('layouts.admin')
@section('topline', 'Vat Management')
@section('content')

@if(session('success'))
<div class="alert alert-success">  
   <i class="fas fa-check"></i> Vat Updated Successfully.
</div>
@endif

<!--form-->
<form action="{{route('vat')}}" method="POST">
	 @csrf
     <div class="row">
        <div class="col-md-6">
        <div class="form-group">
     	<label>Vat(%)</label>
     	<input type="text" name="vat" class="form-control" value="{{$dt}}">
     </div>
        </div>
     </div>
        <div class="row">
        <div class="col-md-6">
        <button class="btn btn-primary" type="submit">Update Vat</button>
        </div>
        </div>
</form>
<!--form ends-->

@endsection