<?php
use App\Models\employee;
use App\Models\admin;
use App\Models\client;
use \DB as DB;
use \Carbon\Carbon as Carbon;

function get_emp_name($id)
{
    return employee::where('id',$id)->value('name');
}

function get_admin_name($id)
{
    return admin::where('id',$id)->value('name');
}

function get_client_name($id)
{
    return client::where('id',$id)->value('name');
}

function fix_data_time($time)
{
    $dt = explode("-",$time);
    $edited = $dt[2]."-".$dt[1]."-".$dt[0];
    return $edited;
}

function updateDiff()
{
    $col = DB::table('project')->whereNull('pause')->whereNull('end')->get();

    foreach($col as $c)
    {
        if($c->start!=NULL)
        {
            $diff = strtotime(Carbon::now()) - strtotime($c->start);
            $now = Carbon::now();
            $new = $c->difference + $diff;
            DB::table('project')->where('project_id',$c->project_id)->update(['start'=>$now, 'difference'=>$new]);
        }
    }
}

function checkTime($time)
{
    if($time<10)
    {
        $time = "0".$time;
    }
    return $time;
}

function timescale($time)
{
    $h = floor($time/3600);
    $m = floor(($time-($h*3600))/60);
    $s = floor($time%60);

    return checkTime($h).":".checkTime($m).":".checkTime($s);
}

function project_id_by_name($id)
{
    return DB::table('project')->where('project_id',$id)->value('project_name');
}

function get_hourly($id)
{
    return DB::table('working_condition')->where('emp_id',$id)->first();
}

function project_count($id)
{
    return DB::table('project')->where([['employee_id',$id],['status','Completed']])->count();
}

function additional($id)
{
    return DB::table('additional_details')->where('project_id',$id)->value('details');
}

function project_det($id)
{
    return DB::table('project')->where('project_id',$id)->first();
}