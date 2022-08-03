<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;


use App\Models\admin;
use App\Models\employee;

class adminController extends Controller
{
    //registration form
    public function registerform()
    {
        return view('admin.registerform');
    }


    //database reg
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
          $count = admin::where('email',$request->email)->count();
          if($count==0)
          {
            admin::create([
              'name'=>$request->fname." ".$request->lname,
              'email'=>$request->email,
              'password'=>Hash::make($request->password),
              'country'=>$request->country,
              'type'=>$request->type,
              'platform'=>$request->platform,
              'vastat'=>$request->va,
              'newslet'=>$val
            ]);
          }else{
            return back()->withErrors(['multi'=>'Email is already in use.']);
          }
        }else{
          return back()->withErrors(['agree'=>'Must read and agree with our policies.']);
        }

        return redirect('admin.loginform')->with('success','Account Created Successfully');
    }

    //admin Login

  public function loginform(){
 
        
            return view('admin.loginform');

  }// login form ends

  public function login(Request $request){
      $validatedData = $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember')))
{

$email=$request->input('email');
   $user=DB::table('admins')->where('email','like',$email)->select('name')->get();
  $complete=DB::table('project')->where('status','like','Completed')->count();
   $running=DB::table('project')->where('status','like','Incomplete')->count();
   $total=DB::table('employee')->count();
   $client=DB::table('clients')->count();
   
return view('admin.dashboard',['total'=>$total,'user'=>$user, 'client'=> $client, 'complete'=>$complete, 'running'=>$running]);
 
     

    }
        else{
       
 return redirect()->back()->withErrors([
        'approve' => 'Invalid password or email.',
    ]);
  


        }
        //Password Checking Ends

  }//admin login ends
  
  //Logout

     public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('admin.loginform');
}
 

  //logoutEnds

//sidebar_links

public function dashboard(){
    $complete=DB::table('project')->where('status','like','Completed')->count();
   $running=DB::table('project')->where('status','like','Incomplete')->count();
$client=DB::table('clients')->count();
$total=DB::table('employee')->count();
return view('admin.dashboard',['total'=>$total, 'client'=>$client, 'complete'=>$complete, 'running'=>$running]);



}//sidebar links ends

//vat
public function addvat(){
$dt =DB::table('company_details')->value('vat');
  return view('admin.vat')->with(['dt'=>$dt]);

}
public function vat(Request $request){
$request->validate([

    'vat'=>'required',

]);

$find=DB::table('company_details')->select('vat')->first();
if(!$find){

$vat=DB::table('company_details')->insert([

'vat'=>$request->input('vat'),

]);

}//if

else{
$vat=DB::table('company_details')->update([

'vat'=>$request->input('vat'),

]);

}//else
return redirect()->back()->withSuccess('Vat Updated Successfully!');

}//vat end

//company_details

public function company_details()
{
  $data = DB::table('company_details')->select('*')->get();
  return view('admin.company_details')->with(['data'=>$data]);
}

public function details(Request $request){

$request->validate([

  'company_name'=>'required',
  'address'=>'required',
  'contact'=>'required',
  'email'=>'required',

]);

$find=DB::table('company_details')->select('*')->first();
if(is_null($find)){

$details=DB::table('company_details')->insert([

 'company_name'=>$request->input('company_name'),
  'address'=>$request->input('address'),
  'contact'=>$request->input('contact'),
  'email'=>$request->input('email'),

]);


}//if

else{


$details=DB::table('company_details')->update([

 'company_name'=>$request->input('company_name'),
  'address'=>$request->input('address'),
  'contact'=>$request->input('contact'),
  'email'=>$request->input('email'),

]);

}//else

return redirect()->back()->withSuccess('Company Details Updated Successfully!');

}

  //logo update
  
  
  public function logoform(){
    $data = DB::table('company_details')->value('image');
    
    return view('admin.logo')->with(['data'=>$data]);
    
  }
  
  public function logo(Request $request){


$this->validate($request,[
    'image' => 'required|image|mimes:png,jpg|max:2048']);
$image = $request->file('image');
$new_name = 'logo'. '.' . 'PNG';
$image->move(public_path("images"),$new_name);

$update_logo=DB::table('company_details')->update([
  'image'=>$new_name,
]);
return redirect()->back()->withSuccsess('Logo Updated Successfully');
}


public function settings()
{
  $id = Auth::id();
  $dt = DB::table('admins')->where('id',$id)->first();
  return view('admin.settings')->with(['dt'=>$dt]);
}

  public function update_set(Request $request)
  {
    $id = $request->id;

    if(empty($request->pass))
    {
    DB::table('admins')->where('id',$id)->update([
      'name'=>$request->name,
      'email'=>$request->email,
      'country'=>$request->location
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
        DB::table('admins')->where('id',$id)->update([
      'name'=>$request->name,
      'email'=>$request->email,
      'country'=>$request->location,
          'password'=>$pass
        ]);
        return back()->with('success','Profile Updated Successfully.');
      }
    }
  }
}
