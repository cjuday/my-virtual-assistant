@extends('layouts.client')

@section('content')


 <div class='container'>
    <div style="text-align: center;" class="alert alert-primary" role="alert">
Profile Update
</div>

 <form action="{{route('client.personal')}}" method="POST">
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
   <div class="alert alert-success">  <h2>{{session('success')}}</h2></div>
@endif

@foreach($client as $client)
        <label>Name</label><br>
      <input type="text" name="name" value="{{$client->name}}" class="form-control">
  
      <label>Contact</label><br>
      <input type="text" name="contact" value="{{$client->contact}}" class="form-control">

  @endforeach 


      <label>Tagline</label><br>
      <input type="text" name="tagline" class="form-control">
      <label>Company Name</label><br>
      <input type="text" name="company" class="form-control">
      <label>Job Title</label><br>
      <input type="text" name="job_title" class="form-control">
      <br>

      <input type="submit" name="submit" class="btn btn-info">
    </form>



</div>
@endsection