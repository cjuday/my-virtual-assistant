<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Models
use App\Models\client;
use App\Models\employee;
//Model ends

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use DB;
use Carbon\Carbon;


class clientController extends Controller
{
      public function registerform(){
        
        return view('client.registerform');

    }//register view ends

    public function register(Request $request)
    {
    $request->validate([
      'fname'=>'required',
      'lname'=>'required',
      'email'=>'required',
      'country'=>'required',
      'password'=>'required',
      'type'=>'required',
      'va'=>'required'
    ]);

    if(!empty($request->emailcheck))
    {
      $val = 1;
    }else{
      $val = 0;
    }

    if(!empty($request->agreement))
    {
      $count = client::where('email',$request->email)->count();
      if($count==0)
      {
        $dd = client::insertGetId([
          'name'=>$request->fname." ".$request->lname,
          'email'=>$request->email,
          'password'=>Hash::make($request->password),
          'country'=>$request->country,
          'type'=>$request->type,
          'platform'=>$request->platform,
          'vastat'=>$request->va,
          'newslet'=>$val
        ]);
        DB::table('client_personal')->insert([
          'cl_id'=>$dd
        ]);
      }else{
        return back()->withErrors(['multi'=>'Email is already in use.']);
      }
    }else{
      return back()->withErrors(['agree'=>'Must read and agree with our policies.']);
    }

    return redirect('client.loginform')->with('success','Account Created Successfully');
}


  public function loginform(){
 
        
            return view('client.loginform');

  }// login form ends

  public function login(Request $request){
      $validatedData = $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
if (Auth::guard('client')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember')))
{

$email=$request->input('email');
$user=DB::table('clients')->where('email','like',$email)->select('*')->first();
   $find=DB::table('project')->where('client_id','like',$user->id)->select('*')->first();
   $running=DB::table('project')->where('client_id','like',$user->id)->where('status','like','Incomplete')->count();
   $complete=DB::table('project')->where('client_id','like',$user->id)->where('status','like','Completed')->count();
  if(!$find){
    $employee=0;
  }
  
  else{
    $employee=DB::table('employee')->where('id','like',$find->employee_id)->count();
  }
   
 
      return view('client.dashboard', ['running'=>$running, 'complete'=>$complete, 'employee'=>$employee]);

    }
        else{
       
 return redirect()->back()->withErrors([
        'approve' => 'Invalid password or email.',
    ]);
  


        }
        //Password Checking Ends

  }//client login ends
  
  //Logout

     public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('client.loginform');
}
 

  //logoutEnds

//sidebar_links

public function dashboard(){

$id=Auth::id();

$find=DB::table('project')->where('client_id','like',$id)->select('*')->first();
   $running=DB::table('project')->where('client_id','like',$id)->where('status','like','Incomplete')->count();
   $complete=DB::table('project')->where('client_id','like',$id)->where('status','like','Completed')->count();
   if(!$find){
    $employee=0;
  }
  
  else{
    $employee=DB::table('employee')->where('id','like',$find->employee_id)->count();
  }
 
      return view('client.dashboard', ['running'=>$running, 'complete'=>$complete, 'employee'=>$employee]);




}//sidebar links ends



public function personalform(){

$id=Auth::id();
  $client=DB::table('clients')->where('id','like',$id)->select('*')->get();

return view('client.personal',['client'=>$client]);

}//personal form ends

public function personal(Request $request){

$request->validate([
     
     'name'=> 'required',
     'contact'=>'required', 
    'tagline'=>'required',
    'company'=>'required',
    'job_title'=>'required',

]);

$id=Auth::id();
$basic= DB::table('clients')->where('id','like',$id)->update([
   
   'name'=>$request->input('name'),
   'contact'=>$request->input('contact'),


]);

$find=DB::table('client_personal')->where('id','like',$id)->select('*')->first();

if(!$find){
   
   $insert=DB::table('client_personal')->insert([
     'id'=>$id ,
    'tagline'=> $request->input('tagline'),
    'company'=> $request->input('company'),
    'job_title'=> $request->input('job_title'),

   ]);

   return redirect()->back()->withSuccess('Successfully Recorded!');


}//if


else{

   $update=DB::table('client_personal')->where('id','like',$id)->update([
      
    'tagline'=> $request->input('tagline'),
    'company'=> $request->input('company'),
    'job_title'=> $request->input('job_title'),

   ]);

return redirect()->back()->withSuccess('Successfully Updated!');
}//else

}//submit personal info ends

//search filter

public function searchfilter(){

  return view('client.searchfilter');
}

public function search(Request $request){
$search= $request->get('search');
$find=DB::table('employee')->where('name','like','%'.$search.'%')->select('*')->get();
if(count($find)==0)
{
  return back()->with('error','No member found with that name.');
}else{
 return view('client.filterResult',['filter'=>$find]);
}
}//search filter ends


//finance
public function payment_status(){

$id=Auth::id();

$payment=DB::table('project')->where('client_id','like',$id)->where([['payment_status','Payment Due'],['status','Completed']])->select('*')->get();

return view('client.payment',['payment'=>$payment]);

}//payment



public function payment_complete(){

$id=Auth::id();

$payment=DB::table('project')->where('client_id','like',$id)->where('payment_status','like','Paid')->select('*')->get();

return view('client.paid',['payment'=>$payment]);

}//payment


public function invoice($project_id){

$client_id=Auth::id();

$payment=DB::table('payments')->where('project_id','like',$project_id)->first();
if($payment)
{
  $payment=1;
}else{
  $payment=0;
}
$pro=DB::table('project')->where('project_id','like',$project_id)->select('*')->first();
$emp=DB::table('working_condition')->where('emp_id','like',$pro->employee_id)->select('*')->first();
$employee=DB::table('employee')->where('id','like',$pro->employee_id)->select('*')->first();
$clinet=DB::table('clients')->where('id',$pro->client_id)->first();
return view('client.invoice',['pro'=>$pro, 'employee'=>$employee, 'emp'=>$emp, 'payment'=>$payment, 'clinet'=>$clinet]);

}//invoice


//payment request
public function requestpay($project_id){

$project=DB::table('project')->where('project_id','like',$project_id)->select('*')->first();
$find=DB::table('payments')->where('project_id','like',$project_id)->select('*')->first();
if(!$find){

  $status=DB::table('project')->where('project_id','like',$project_id)->where('status','like','Incomplete')->select('*')->first();
  $currency=DB::table('working_condition')->where('emp_id','like',$project->employee_id)->select('*')->first();
if(!$status){

$request=DB::table('payments')->insert([

  'project_id'=>$project_id,
  'client_id'=>$project->client_id,
  'employee_id'=>$project->employee_id,
  'date'=>date('Y-m-d'),
  'due'=>$project->total,
  'request'=>'Not Reviewed',
  'currency'=>$currency->currency,


]);

return redirect()->back()->withSuccess('Payment Request Sent');

}//if_inside

else{
  return redirect()->back()->withErrors([
'approve'=>'Project is not finished yet',

  ]);

}//else_inside

}//if

else{

  return redirect()->back()->withErrors([
'approve'=>'Request is already sent.',

  ]);
}//else

}//payment request

//admin reviewing payment request
public function review(){

  $running=DB::table('payments')->where('payment_status','like','Due')->select('*')->get();

  return view('admin.request', ['running'=>$running]);
}

//admin sending links (requests becomes reviewed)

public function sendlink($project_id){
$find=DB::table('project')->where('project_id',$project_id)->select('*')->get();
$gg = DB::table('payments')->where('project_id',$project_id)->value('link');

return view('admin.link',['find'=>$find, 'gg'=>$gg]);


}

//admin saving links to database

public function link(Request $request)
{
$project_id=$request->id;
   $update=DB::table('payments')->where('project_id',$project_id)->update([
    'link'=>$request->link,
    'request'=>'Link Sent',
   ]);
   return redirect()->back()->withSuccess('Link sent to the employee.');
}

//admin accepting and confirming payments (payment_status becomes paid)

public function confirm($project_id){

  $update=DB::table('payments')->where('project_id','like',$project_id)->update([
   
   'payment_status'=>'Paid',

  ]);

    $project=DB::table('project')->where('project_id','like',$project_id)->update([
   
   'payment_status'=>'Paid',

  ]);

return redirect()->back()->withSuccess('Confirmed');

}


//finance ends


//project additional details
public function running(){
$client_id=Auth::id();
$projects=DB::table('project')->where('client_id','like',$client_id)->where('status','like','Incomplete')->select('*')->paginate(15);
  return view('client.running',['projects'=>$projects]);
}

public function project_details($project_id){
$project=DB::table('project')->where('project_id','like',$project_id)->select('*')->get();

  return view('client.additional',['project'=>$project]);

}

public function adddetails(Request $request){

$request->validate([

'details'=>'required',

]);

$dd = DB::table('additional_details')->where('project_id',$request->input('project_id'))->count();

if($dd==0)
{
  DB::table('additional_details')->insert([

    'project_id'=>$request->input('project_id'),
    'project_name'=>$request->input('project_name'),
    'details'=>$request->input('details'),
    'given'=>date('Y-m-d'),
    
    ]);
}else{
  DB::table('additional_details')->where('project_id',$request->input('project_id'))->update([
    'details'=>$request->input('details'),
    'given'=>date('Y-m-d'),
    ]);
}

$dt = DB::table('project')->where('project_id',$request->input('project_id'))->first();

DB::table('notification')->insert([
  'project_id'=>$request->input('project_id'),
  'project_name'=>$dt->project_name,
  'notification_text'=>'Updated additional information',
  'client_id'=>Auth::id(),
  'client_name'=>get_client_name(Auth::id()),
  'status'=>"Incomplete",
  'emp_id'=>$dt->employee_id
]);

return redirect()->back()->withSuccess('Successfully Updated!');

}//end of project additional details

public function notify(){

$client_id=Auth::id();

$notification=DB::table('notify_client')->where('id',$client_id)->select('*')->orderBy('started','desc')->paginate(10);

return view('client.notify',['notification'=>$notification]);

}


//view and delete client for admin
public function viewClient(){

$client=DB::table('clients')->select('*')->get();

return view('admin.viewclient',['client'=>$client]);

}

//clientDetails
public function clientdetails($id)
{
  $basic=DB::table('clients')->where('id',$id)->value('name');

  $client[0]=DB::table('client_personal')->where('cl_id',$id)->value('company');
  $client[1]=DB::table('client_personal')->where('cl_id',$id)->value('tagline');
  $client[2]=DB::table('client_personal')->where('cl_id',$id)->value('job_title');

return view('admin.clientDetails',['basic'=>$basic, 'client'=>$client]);

}  
  
public function deleteClient($id){

$delete=DB::table('clients')->where('id','like',$id)->delete();

return redirect()->back()->withSuccess('Client is deleted from the list.');

}//view and delete client ends

public function timesheet()
{
  $client_id = Auth::guard('client')->id();
  $project=DB::table('project')->where('client_id','like',$client_id)->where('status','like','Incomplete')->select('*')->paginate(15);
  return view('client.timesheet',['project'=>$project]);
}

public function all(){
  $client_id=Auth::id();
  $projects=DB::table('project')->where('client_id',$client_id)->orderBy('project_id','desc')->paginate(15);
    return view('client.all',['projects'=>$projects]);
  }

  public function prof()
  {
    $id = Auth::id();
    $dt = client::find($id);
    $pd = DB::table('client_personal')->where('cl_id',$id)->first();
    return view('client.prof')->with(['dt'=>$dt, 'pd'=>$pd]);
  }

  public function settings()
  {
    $id = Auth::id();
    $dt = client::find($id);
    $pd = DB::table('client_personal')->where('cl_id',$id)->first();
    return view('client.settings')->with(['dt'=>$dt, 'pd'=>$pd]);
  }

  public function update_set(Request $request)
  {
    $id = $request->id;

    if(empty($request->pass))
    {
    DB::table('clients')->where('id',$id)->update([
      'name'=>$request->name,
      'email'=>$request->email,
      'country'=>$request->location
    ]);

    DB::table('client_personal')->where('id',$id)->update([
      'company'=>$request->comp,
      'job_title'=>$request->des,
      'tagline'=>$request->tag
    ]);
      return back()->with('success','Profile Updated Successfully.');
    }else{
      if(!empty($request->pass) && empty($request->passx))
      {
        return back()->with('error','Enter confirm password field to change password.');
      }

      if($request->pass == $request->passx)
      {
        $pass = Hash::make($request->pass);
        DB::table('clients')->where('id',$id)->update([
      'name'=>$request->name,
      'email'=>$request->email,
      'country'=>$request->location,
          'password'=>$pass
        ]);
        
    DB::table('client_personal')->where('id',$id)->update([
      'company'=>$request->comp,
      'job_title'=>$request->des,
      'tagline'=>$request->tag
    ]);
        return back()->with('success','Profile Updated Successfully.');
      }
    }
  }
}
