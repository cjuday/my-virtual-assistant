<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Models
use App\Models\client;
use App\Models\employee;
use App\Models\project;
//Model ends

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use DB;
use Carbon\Carbon;
class projectController extends Controller
{
    
   public function projectdetails($id){
        $find=DB::table('employee')->where('name','like',$id)->select('*')->get();
        $con=DB::table('working_condition')->where('id','like',$id)->select('*')->get();
        return view('client.projectDetails',['find'=>$find, 'con'=>$con, 'id'=>$id]);

   }

    public function project(Request $request){
        
      $request->validate([

           'project_name'=>'required|string|max:40',
           'project_details'=> 'required|string|max:400',

      ]);
      $created_at=now();
      $client_id=Auth::id();
      $project=DB::table('project')->insert([
          
             'employee_id'=>$request->input('employee_id'),
             'client_id'=>$client_id,
             'project_name'=>$request->input('project_name'),
             'project_details'=>$request->input('project_details'),
             'starting_day'=>Carbon::today()->toDateString(),
             'status'=>"Incomplete",
             'created_at'=>$created_at,


      ]);
         

      $employee_id=$request->input('employee_id');
      $find=DB::table('project')->where('client_id','like',$client_id)->where('employee_id','like',$employee_id)->where('created_at','like',$created_at)->select('*')->first();
      $name=DB::table('clients')->where('id','like',$client_id)->select('*')->first();

      $notification=DB::table('notification')->insert([
         'project_id'=>$find->project_id,
         'project_name'=>$request->input('project_name'),
         'notification_text'=>'Your have a project',
         'client_id'=>$client_id,
         'client_name'=>$name->name,
         'status'=>"Incomplete",
         'emp_id'=>$request->input('employee_id'),


      ]);
$find=DB::table('project')->where('client_id','like',$client_id)->select('*')->first();
   $running=DB::table('project')->where('client_id','like',$client_id)->where('status','like','Incomplete')->count();
   $complete=DB::table('project')->where('client_id','like',$client_id)->where('status','like','Completed')->count();
   $employee=DB::table('employee')->where('id','like',$find->employee_id)->count();
 
      return view('client.dashboard', ['running'=>$running, 'complete'=>$complete, 'employee'=>$employee]);
  

   }


   //Running Project to view for Admin

   public function running(){
   
   $running=DB::table('project')->where('status','like','Incomplete')->select('*')->get();
   $count=DB::table('project')->where('status','like','Incomplete')->count();

   return view('admin.running',['running'=>$running, 'count'=>$count]);

   }
   
   public function runningdetails($id){

    $find=DB::table('project')->where('project_id','like',$id)->select('*')->first();
    
    $order=DB::table('clients')->where('id','like',$find->client_id)->select('*')->get();



    $assign=DB::table('employee')->where('id','like',$find->employee_id)->select('*')->get();
   $running=DB::table('project')->where('project_id','like',$id)->select('*')->get();
    $details=DB::table('additional_details')->where('project_id','like',$id)->select('*')->get();
    return view('admin.projectdetails',['order'=>$order, 'assign'=>$assign, 'running'=>$running, 'details'=>$details]);

   }


   //running ends

      //Complete Project to view for Admin

   public function complete(){

   $running=DB::table('project')->where('status','like','Completed')->select('*')->get();
   $count=DB::table('project')->where('status','like','Completed')->count();

   return view('admin.complete',['running'=>$running, 'count'=>$count]);

   }//Complete ends

   //delete project only admin

   public function deleteProject($id){

   $delete=DB::table('project')->where('project_id',$id)->delete();
   $deletenot=DB::table('notification')->where('project_id',$id)->delete();
   $deletenotify=DB::table('notify_client')->where('project_id',$id)->delete();

   return redirect()->back()->withSuccess('Project is deleted');

   }//end of delete project

}
