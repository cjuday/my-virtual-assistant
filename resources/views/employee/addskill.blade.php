@extends('layouts.employee')
@section('topline','Skills')
@section('content')

 <form action="{{route('employee.skill')}}" method="POST">
        @csrf
@if(Session()->has('success'))
<div class="alert alert-success">
    <i class="fas fa-check"></i> Skills Added Successfully.
</div>
@endif
    <label>* Skills</label><br>
    <input type="text" name="skills" value="{{$sk}}" placeholder="Use comma (,) after each skill, e.g, Java, Kotlin" class="form-control"><br>
      
      
    <input type="submit" value="Add Skill" class="btn btn-info">
    </form>
@endsection