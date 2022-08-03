@extends('layouts.client')
@section('topline','Serach Employee')
@section('content')

@if(Session::has('error'))
<div class="alert alert-danger">
    <i class="fas fa-times"></i> {{Session::get('error')}}
</div>
@endif


<div class="row">
  <div class="col-md-6">
  <form action="{{route('client.search')}}" method="get">
    
    <div class="form-group">
      <input type="text" name="search" class="form-control" placeholder="Enter employee name to search..">
    </div>
    
    <button type="submit" class="btn btn-primary">Search</button>
  </form>
  </div>
</div>

@endsection