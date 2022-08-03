<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\client;
use App\Models\employee;
use App\Models\project;
use DateTime;
use DB;
use Carbon\Carbon;


use Illuminate\Http\Request;

class employeeController extends Controller
{
     public function registerform(){
        
        return view('employee.register');

    }//register view ends

    public function register(Request $request){
     
     $request->validate([
        
            'name'=>'required|string|max:250',
            'email'=>'required|unique:employee',
            'contact'=>'required',
            'location'=>'required',
            'working_post'=>'required',
            'password'=>'required|min:6',

     ]);

     $register=DB::table('employee')->insertGetId([
         
         'name'=>$request->input('name'),
            'email'=> $request->input('email'),
            'contact'=>$request->input('contact'),
            'location'=>$request->input('location'),
            'working_post'=>$request->input('working_post'),
            'password'=>Hash::make($request->input('password'))

     ]);

     DB::table('working_condition')->insert([
       'emp_id'=>$register,
       'hourly_charge'=>'0',
       'working_status'=>'Remote',
       'time'=>'Day'
     ]);

     DB::table('skills')->insert([
       'id'=>$register,
       'name'=>$request->name,
       'location'=>$request->location,
       'skills'=>'Not Specified Yet.',
       'post'=>'Not Specified Yet.'
     ]);

           //change

             return redirect()->back()->withSuccess('Successfully Recorded!');
       

     //changeends

    } //register ends
    
    //view and delete employee

    public function viewemp(){


     $view=DB::table('employee')->select('*')->get();

     return view('admin.viewemp',['view'=>$view]);


    }

    public function deleteEmpoyee($id){

    $delete=DB::table('employee')->where('id','like',$id)->delete();

    return redirect()->back()->withSuccess('Employee is deleted from the list.');

    }

    public function viewprofile($id){
    
      $view=DB::table('employee')->where('id',$id)->select('*')->first();
      $condition=DB::table('working_condition')->where('emp_id',$id)->select('*')->first();
      $skills=DB::table('skills')->where('id',$id)->select('*')->first();
      $education=DB::table('education')->where('emp_id',$id)->select('*')->get();
      $project=DB::table('project')->where('employee_id',$id)->count();
      $complete=DB::table('project')->where('employee_id',$id)->where('status','like','Completed')->count();
    
      return view('employee.profile',['view'=>$view, 'condition'=>$condition, 'skills'=>$skills, 'education'=>$education, 'project'=>$project, 'complete'=>$complete]);

    }//view and delete employee ends

    //view employee profile for client

        public function profileview($id){
    
    $view=DB::table('employee')->where('id','like',$id)->select('*')->get();
    $condition=DB::table('working_condition')->where('emp_id','like',$id)->select('*')->get();
    $skills=DB::table('skills')->where('id','like',$id)->select('*')->get();
    $edu=DB::table('education')->where('id','like',$id)->select('*')->get();
    $project=DB::table('project')->where('employee_id','like',$id)->count();
    $complete=DB::table('project')->where('employee_id','like',$id)->where('status','like','Completed')->count();

    return view('employee.clientviewProfile',['view'=>$view, 'condition'=>$condition, 'skills'=>$skills, 'edu'=>$edu, 'project'=>$project, 'complete'=>$complete]);

    }

    //view employee profile for client ends

     public function loginform(){
 
        
            return view('employee.loginform');

  }// login form ends

  public function login(Request $request){
      $validatedData = $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
if (Auth::guard('employee')->attempt(['email' => $request->email, 'password' => $request->password]))
{

$email=$request->input('email');

 $user=DB::table('employee')->where('email','like',$email)->select('*')->first();
   $find=DB::table('project')->where('employee_id','like',$user->id)->select('*')->first();
   $running=DB::table('project')->where('employee_id','like',$user->id)->where('status','like','Incomplete')->count();
   $complete=DB::table('project')->where('employee_id','like',$user->id)->where('status','like','Completed')->count();
  if(!$find){
    $client=0;
  }
  
  else{
    $client=DB::table('clients')->where('id','like',$find->client_id)->count(); 
    
  }
      return view('employee.dashboard', ['running'=>$running, 'complete'=>$complete, 'client'=>$client]);
  
 
 

    }
        else{
       
 return redirect()->back()->withErrors([
        'approve' => 'Invalid password or email.',
    ]);
  


        }
        //Password Checking Ends

  }//employee login ends

 public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('employee.loginform');
}
 

  //logoutEnds

//sidebar_links

public function dashboard(){


$id=Auth::id();

$find=DB::table('project')->where('employee_id','like',$id)->select('*')->first();
   $running=DB::table('project')->where('employee_id','like',$id)->where('status','like','Incomplete')->count();
   $complete=DB::table('project')->where('employee_id','like',$id)->where('status','like','Completed')->count();
     if(!$find){
    $client=0;
  }
  
  else{
    $client=DB::table('clients')->where('id','like',$find->client_id)->count(); 
    
  }
  
 
      return view('employee.dashboard', ['running'=>$running, 'complete'=>$complete, 'client'=>$client]);


}

public function addskill(){
$id=Auth::id();
$sk = DB::table('skills')->where('id',$id)->value('skills');
return view('employee.addskill')->with('sk',$sk);

}

public function skill(Request $request){

$request->validate([

'skills'=>'required|max:250',

]);

$id=Auth::id();
$user=DB::table('employee')->where('id','like',$id)->select('*')->first();
$find=DB::table('skills')->where('id','like',$id)->select('*')->first();

if(!$find){

$skill=DB::table('skills')->where('id','like',$id)->insert([

'id'=>$id,
'name'=>$user->name,
'location'=>$user->location,
'post'=>$user->working_post,
'skills'=>$request->input('skills')

]);

return redirect()->back()->withSuccess('message', 'Skills successfully inserted');
}
else{

$skill=DB::table('skills')->where('id','like',$id)->update([

'id'=>$id,
'name'=>$user->name,
'location'=>$user->location,
'post'=>$user->working_post,
'skills'=>$request->input('skills')

]);
return redirect()->back()->with('success', 'Skills successfully updated');

}



}
//educational info
public function addedu()
{
  $dt = DB::table('education')->where('emp_id',$id)->get();

   return view('employee.education')->with('dt',$dt);

}

public function education(Request $request){

   $request->validate([
            
            'degree'=>'required',
            'subject'=>'required',
            'year'=>'required|max:4',

   ]);

   $id=Auth::id();
   $degree=$request->input('degree');
   $subject=$request->input('subject');
   $year=$request->input('year');

  $find=DB::table('education')->where('id','like',$id)->where('subject','like',$subject)->where('degree','like',$degree)->select('*')->first();

  if(!$find){

      $education=DB::table('education')->insert([
          'emp_id'=>$id,
          'degree'=>$degree,
            'subject'=>$subject,
            'year'=>$year,

      ]);

      return redirect()->back()->withSuccess('Successfully Recorded!');
           }//if



      else{

          return redirect()->back()->withErrors([
        'approve' => 'Record Exists.',
    ]);
  
          }//else


}

//work conditions

public function workCondition(){
  
  $id=Auth::id();
  
  $find=DB::table('working_condition')->where('id',$id)->select('*')->get();

    return view('employee.workCondition',['find'=>$find]);

}

public function condition(Request $request){

$request->validate([

'hourly_charge'=> 'required',
'working_status'=>'required' ,
'time'=>'required',
'link'=>'required',
]);

$id=Auth::id();
$find=DB::table('working_condition')->where('id','like',$id)->select('*')->first();
if(!$find){

$insert=DB::table('working_condition')->insert([

    'id'=>$id,
    'hourly_charge'=>$request->input('hourly_charge'),
    'working_status'=>$request->input('working_status'),
    'time'=>$request->input('time'),
    'link'=>$request->input('link'),

]);

 return redirect()->back()->withSuccess('Successfully Recorded!');

}//if

else{

$update=DB::table('working_condition')->where('id','like',$id)->update([

    'id'=>$id,
    'hourly_charge'=>$request->input('hourly_charge'),
    'working_status'=>$request->input('working_status'),
    'time'=>$request->input('time'),
  'link'=>$request->input('link'),

]);

 return redirect()->back()->withSuccess('Successfully Updated!');


}//else


}//condition

//Notification

public function notification(){
  
$employee_id=Auth::id();

$find=DB::table('working_condition')->where('emp_id',$employee_id)->select('*')->first();


$select=DB::table('notification')->where('emp_id',$employee_id)->select('*')->first();


$notification=DB::table('notification')->where('emp_id',$employee_id)->select('*')->orderBy('id','DESC')->get();

$project=DB::table('project')->where('project_id','like',$select->project_id)->select('*')->get();


  return view('employee.notification',['notification'=>$notification,'project'=>$project]);

}

public function viewProject($project_id){


$project=DB::table('project')->where('project_id','like',$project_id)->select('*')->first();
$proj2 = DB::table('additional_details')->where('project_id',$project_id)->select('*')->first();

if(!$proj2)
{
  $pro2 = "No additional details added yet.";
}else{
  $pro2 = $proj2->details;
}

return view('employee.viewProject',['project'=>$project, 'pro2'=>$pro2]);

}

public function start($project_id){

$employee_id=Auth::id();



$find=DB::table('project')->where('employee_id','like',$employee_id)->where('project_id','like',$project_id)->select('*')->first();

if(is_null($find->start)){
$starts=now();
$start=DB::table('project')->where('employee_id','like',$employee_id)->where('project_id','like',$project_id)->update([

'start'=>$starts

]);

$notify=DB::table('notify_client')->insert([
'id'=>$find->client_id,
'project_id'=>$find->project_id,
'project_name'=>$find->project_name,
'notification_text'=>'has been started',
'started'=>$starts,

]);

return redirect()->back()->withSuccess('You have started working on this project');

}//if


else{

  return redirect()->back()->withErrors([

'approve'=>'You have already started this project.',
  ]);
}//else

}//start ends

public function pause(Request $request, $project_id){

$employee_id=Auth::id();

$find=DB::table('project')->where('employee_id','like',$employee_id)->where('project_id','like',$project_id)->select('*')->first();
if(is_null($find->start)){
 return redirect()->back()->withErrors([

'approve'=>'You have not started this project yet.',
  ]);

}

else{

$pause=now();
$due=$find->due;



   $pause_time=DB::table('project')->where('employee_id','like',$employee_id)->where('project_id','like',$project_id)->update([

'pause'=>$pause,

]);
        $difference = $find->difference;
        $pause_now = strtotime($pause);
        $start_time = strtotime($find->start);
        $diff = $pause_now - $start_time;
        $difference+=$diff;
 

 $counter=DB::table('project')->where('employee_id','like',$employee_id)->where('project_id','like',$project_id)->update([

   'difference'=>$difference

 ]); 
$notify=DB::table('notify_client')->insert([
'id'=>$find->client_id,
'project_id'=>$find->project_id,
'project_name'=>$find->project_name,
'notification_text'=>'has been paused',
'started'=>$pause,

]);

$request->session()->put('pause','pause');


return redirect()->back()->with('success','You have paused your working time.');

}//else

}//pause


public function resume(Request $request, $project_id){
$employee_id=Auth::id();
$find=DB::table('project')->where('employee_id','like',$employee_id)->where('project_id','like',$project_id)->select('*')->first();
if(is_null($find->start)){
 return redirect()->back()->withErrors([

'approve'=>'You have not started this project yet.',
  ]);

}//if

else{
if(is_null($find->pause)){

   return redirect()->back()->withErrors([

'approve'=>'You have not paused this project.',
  ]);
}//if

else{

$start_time=now();
$start=DB::table('project')->where('project_id','like',$project_id)->update([

      'start'=>$start_time,

]);

 $pause_now = NULL;

 $pause_time=DB::table('project')->where('employee_id','like',$employee_id)->where('project_id','like',$project_id)->update([

'pause'=>$pause_now,

]);

$notify=DB::table('notify_client')->insert([
'id'=>$find->client_id,
'project_id'=>$find->project_id,
'project_name'=>$find->project_name,
'notification_text'=>'has been resumed',
'started'=>$start_time,

]);

$request->session()->put('pause','no');
return redirect()->back()->withSuccess('You have resumed your work.');

}//else_inside

}//else


}//resume

public function end($project_id){

$employee_id=Auth::id();

$find=DB::table('project')->where('employee_id','like',$employee_id)->where('project_id','like',$project_id)->select('*')->first();
if(is_null($find->start)){
 return redirect()->back()->withErrors([

'approve'=>'You have not started this project yet.',
  ]);

}//if

else{

$end=now();
$due=$find->due;
$vat_find=DB::table('company_details')->select('vat')->first();
$vat=$vat_find->vat;
if(is_null($find->end)){
$difference = $find->difference;
        $end_now = strtotime($end);
        $start_time = strtotime($find->start);
        $diff = $end_now - $start_time;
        $difference += $diff;
 $condition=DB::table('working_condition')->where('emp_id','like',$employee_id)->select('*')->first();
 $hourly_charge=$condition->hourly_charge;
$due=($hourly_charge*($difference/3600));   
$total=$due + ($due*($vat/100));   
 $counter=DB::table('project')->where('employee_id','like',$employee_id)->where('project_id','like',$project_id)->update([

   'difference'=>$difference,
   'due'=>$due,
   'status'=>'Completed',
   'end'=>$end,
   'total'=>$total,

 ]); 

 $notification=DB::table('notification')->where('project_id','like',$project_id)->update([

      
      'status'=>"Completed",



 ]);

 $notify=DB::table('notify_client')->insert([
'id'=>$find->client_id,
'project_id'=>$find->project_id,
'project_name'=>$find->project_name,
'notification_text'=>'is completed for you.',
'started'=>$end,

]);

 return redirect()->back()->withSuccess('Congratulations! You have successfully completed this project.');

}//if

else{

return redirect()->back()->withSuccess('This project has been completed');

}//else_inside

}//else_outside


}//end of project

//view running projects
public function running(){

$employee_id=Auth::id();

$projects=DB::table('project')->where('employee_id','like',$employee_id)->where('status','like','Incomplete')->select('*')->orderBy('created_at','desc')->paginate(10);

return view('employee.running',['projects'=>$projects]);
}//end of running projects

//view additional details from client
public function additional($project_id){

$proj=DB::table('project')->where('project_id',$project_id)->select('*')->get();
$dtx=DB::table('additional_details')->where('project_id',$project_id)->value('details');
if(!$dtx)
{
  $dtx = "No additional requirements specified.";
}

return view('employee.additional',['proj'=>$proj, 'dtx'=>$dtx]);

}//end of additional details


public function timesheet()
{
  $client_id = Auth::id();
  $project=DB::table('project')->where('employee_id',$client_id)->where('status','like','Incomplete')->select('*')->orderBy('created_at','desc')->paginate(15);
  return view('employee.timesheet',['project'=>$project]);
}


public function paidtask()
{
  $id = Auth::id();
  $dt = DB::table('project')->where([['employee_id',$id],['payment_status','Paid']])->paginate(20);
  return view('employee.paid')->with('dt',$dt);
}

public function duetask()
{
  $id = Auth::id();
  $dt = DB::table('project')->where([['employee_id',$id],['payment_status','Payment Due'],['status','Completed']])->paginate(20);
  return view('employee.due')->with('dt',$dt);
}

public function all(){

  $employee_id=Auth::id();
  
  $projects=DB::table('project')->where('employee_id',$employee_id)->select('*')->orderBy('created_at','desc')->paginate(10);
  
  return view('employee.all',['projects'=>$projects]);
}
  
public function prof(){
  $id = Auth::id();
  $view=DB::table('employee')->where('id',$id)->select('*')->first();
  $condition=DB::table('working_condition')->where('emp_id',$id)->select('*')->first();
  $skills=DB::table('skills')->where('id',$id)->select('*')->first();
  $education=DB::table('education')->where('emp_id',$id)->select('*')->get();
  $project=DB::table('project')->where('employee_id',$id)->count();
  $complete=DB::table('project')->where('employee_id',$id)->where('status','like','Completed')->count();

  return view('employee.prof',['view'=>$view, 'condition'=>$condition, 'skills'=>$skills, 'education'=>$education, 'project'=>$project, 'complete'=>$complete]);

  }

  public function settings()
  {
    $id = Auth::id();
    $view=DB::table('employee')->where('id',$id)->select('*')->first();
    $education=DB::table('education')->where('emp_id',$id)->select('*')->orderBy('id','desc')->get();
    $condition=DB::table('working_condition')->where('emp_id','like',$id)->select('*')->first();
    $skills=DB::table('skills')->where('id',$id)->select('*')->first();

    return view('employee.settings',['view'=>$view, 'education'=>$education, 'cond'=>$condition, 'skills'=>$skills]);
  }

  public function update_set(Request $request)
  {
    $id = $request->id;
    DB::table('employee')->where('id',$id)->update([
      'name'=>$request->name,
      'email'=>$request->email,
      'contact'=>$request->number,
      'location'=>$request->location,
      'working_post'=>$request->desig
    ]);

    if(!empty($request->deg) && !empty($request->sub) && !empty($request->year))
    {
      DB::table('education')->insert([
        'emp_id'=>$id,
        'degree'=>$request->deg,
        'subject'=>$request->sub,
        'year'=>$request->year
      ]);
    }

    DB::table('skills')->where('id',$id)->update(['skills'=>$request->skl]);

    $data = DB::table('working_condition')->where('emp_id',$id)->first();

    if($data->working_status==NULL || $data->time==NULL)
    {
      if($request->type=='0' || $request->shift=='0')
      {
        return back()->with('error','Select a type and shift.');
      }else{
        DB::table('working_condition')->where('emp_id',$id)->update([
          'hourly_charge'=>$request->charge,
          'working_status'=>$request->type,
          'time'=>$request->shift
        ]);
      }
    }else{
      if($request->type=='0' || $request->shift=='0')
      {
        DB::table('working_condition')->where('id',$id)->update([
          'hourly_charge'=>$request->charge
        ]);
      }else{
        DB::table('working_condition')->where('emp_id',$id)->update([
          'hourly_charge'=>$request->charge,
          'working_status'=>$request->type,
          'time'=>$request->shift
        ]);
      }
    }

    return back()->with('success','Profile Updated Successfully.');
  }

}
