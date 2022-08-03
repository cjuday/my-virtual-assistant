@extends('layouts.admin')
@section('topline','Logo Management')
@section('content')
  <form action="{{route('logo')}}" method="POST" enctype="multipart/form-data">
  @csrf
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
  <div class="alert alert-success">
    <i class="fas fa-check-circle"></i> {{session('success')}}
  </div>
@endif
  
   <div class="row">
       <div class="col-md-6">
       <div class="form-group">
       <label for="image">Update Logo</label>
       <input type="file" name="image" class="form-control">
   </div>
       </div>
   </div>


   <b>* Current Logo</b><br/>
<img src="{{asset('/images/'.$data.'')}}" width="290px" height="360px">
<br/>
      
  
      <button class="btn btn-primary col-md-6" name="submit">Update Logo</button>
</form>

<br/>

@endsection