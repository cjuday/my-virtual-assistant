@extends('layouts.employee')

@section('content')

<div class='container'>
    <div style="text-align: center;" class="alert alert-primary" role="alert">
 Add Educational Background
</div>

 <form action="{{route('employee.education')}}" method="POST">
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


        <label>Degree </label><br>
      <input type="text" name="degree" placeholder="e.g, MSc" class="form-control"><br>
        <label>Subject </label><br>
      <input type="text" name="subject" placeholder="e.g, CSE" class="form-control"><br>
        <label>Passing Year </label><br>
      <input type="text" name="year" placeholder="e.g 2014" class="form-control"><br>
      
      <input type="submit" name="submit" class="btn btn-info">
    </form>



</div>

 


@endsection