<?php
updateDiff();
?>
@extends('layouts.employee')
@section('topline','Project Management')
@section('content')
@if(Session::has('success'))
<div class="alert alert-success">
    <i class="fas fa-check"></i> {{Session::get('success')}}
</div>
@endif

<div class="card shadow mb-4">
  <div class="card-body">
    <div class="row">
      <div class="col-md-4">
        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Project Name</div>
          {{$project->project_name}}
      </div>
      <div class="col-md-4">
        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Elapsed Time</div>
          <p id="dd"></p>
      </div>
        <div class="col-md-4">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Time Tracker</div>
          @if($project->end!=NULL)
            <b>Project is completed.</b>
          @else
            @if($project->start==NULL)
              <a href="{{route('start',['project_id'=>$project->project_id])}}" class="btn btn-success">Start</a>
            @endif

            @if($project->pause==NULL && $project->start!=NULL && $project->end==NULL)
              <a href="{{route('pause',['project_id'=>$project->project_id])}}" class="btn btn-warning"><i class="fas fa-pause"></i></a>
            @elseif($project->pause!=NULL && $project->start!=NULL && $project->end==NULL)
              <a href="{{route('resume',['project_id'=>$project->project_id])}}" class="btn btn-warning"><i class="fas fa-play"></i></a>
            @endif

            @if($project->end==NULL && $project->start!=NULL)
              <a href="{{route('end',['project_id'=>$project->project_id])}}" class="btn btn-danger"><i class="fas fa-stop"></i></a>
            @endif
          @endif
      </div>
    </div>
    
    <br/>
    <div class="row">
      <div class="col-12">
        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Project Description</div>
        {{$project->project_details}}
      </div>
    </div>

    <br/>
    <div class="row">
      <div class="col-12">
        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Additional Project Description</div>
        {{$pro2}}
      </div>
    </div>
  </div>
</div>
    <script>
  var time = 0;
  var timex = 0;
  var h = 0;
  var m = 0; 
  var s = 0;

  <?php
  $end = $project->difference;
    echo "time = '$end';";
  ?>
  console.log(time);
  
  var t;
  var startTime = Math.floor(time);

  
function startTimeCounter() {
    h = Math.floor(time/3600);
    m = Math.floor((time - h*3600) / 60);
    s = Math.floor(time % 60);
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
    
    document.getElementById("dd").innerHTML = h + ":" +m + ":" + s;
    ++time;
}

function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

<?php
if($project->pause!=NULL && $project->start!=NULL && $project->end==NULL)
{
  echo 'clearInterval(t);';
}else if($project->pause==NULL && $project->start!=NULL && $project->end==NULL){
  echo 't = setInterval(startTimeCounter, 1000);';
}
?>
startTimeCounter();
</script>
@endsection