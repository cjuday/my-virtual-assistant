<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



//admin reg,login
Route::get('admin.loginform',[App\Http\Controllers\adminController::class,'loginform'])->name('admin.loginform');
Route::get('admin.registerform',[App\Http\Controllers\adminController::class,'registerform'])->name('admin.registerform');
Route::post('admin.register',[App\Http\Controllers\adminController::class,'register'])->name('admin.register');
Route::post('admin.login',[App\Http\Controllers\adminController::class,'login'])->name('admin.login');

Route::get('admin.logout',[App\Http\Controllers\adminController::class,'logout'])->name('admin.logout');
//admin reg, login ends

//Only accessed by admin pages routes
Route::group(['middleware' => ['web','auth:admin'], 'prefix' => 'admin'], function() {



Route::get('admin.dashboard',[App\Http\Controllers\adminController::class,'dashboard'])->name('admin.dashboard');

/*employee registration by admin*/

Route::get('employee.register',[App\Http\Controllers\employeeController::class,'registerform'])->name('employee.register');
Route::post('employee.reg',[App\Http\Controllers\employeeController::class,'register'])->name('employee.reg');
Route::get('admin.viewemp',[App\Http\Controllers\employeeController::class,'viewemp'])->name('admin.viewemp');
Route::get('admin.viewemp/{id}/deleteemp',[App\Http\Controllers\employeeController::class,'deleteEmpoyee'])->name('deleteemp');
Route::get('admin.viewemp/{id}/employee.profile',[App\Http\Controllers\employeeController::class,'viewprofile'])->name('employee.profile');
//vat
Route::get('admin.addvat',[App\Http\Controllers\adminController::class,'addvat'])->name('admin.addvat');
Route::post('vat',[App\Http\Controllers\adminController::class,'vat'])->name('vat');

//company_details
Route::get('admin.companydetails',[App\Http\Controllers\adminController::class,'company_details'])->name('admin.companydetails');
Route::post('details',[App\Http\Controllers\adminController::class,'details'])->name('details');

//logo Update
  
Route::get('admin.logo',[App\Http\Controllers\adminController::class, 'logoform'])->name('admin.logo');
Route::post('logo',[App\Http\Controllers\adminController::class, 'logo'])->name('logo');

//view and delete Client

Route::get('admin.viewClient',[App\Http\Controllers\clientController::class,'viewClient'])->name('admin.viewClient');
Route::get('admin.viewClient/{id}/clientdetails',[App\Http\Controllers\clientController::class,'clientdetails'])->name('clientdetails');
Route::get('admin.viewClient/{id}/deleteClient',[App\Http\Controllers\clientController::class,'deleteClient'])->name('deleteClient');

//view and delete Client ends

//admin CRUD project

Route::get('admin.running',[App\Http\Controllers\projectController::class,'running'])->name('admin.running');
Route::get('admin.complete',[App\Http\Controllers\projectController::class,'complete'])->name('admin.complete');
Route::get('admin.complete/{id}/deleteProject',[App\Http\Controllers\projectController::class,'deleteProject'])->name('admin.deleteProject');
Route::get('{id}/admin.projectdetails',[App\Http\Controllers\projectController::class,'runningdetails'])->name('admin.projectdetails');

//end of admin CRUD project

//finance
Route::get('admin.request',[App\Http\Controllers\clientController::class,'review'])->name('admin.request');
Route::get('{project_id}/admin.link',[App\Http\Controllers\clientController::class,'sendlink'])->name('admin.link');
Route::get('{project_id}/admin.confirm',[App\Http\Controllers\clientController::class,'confirm'])->name('admin.confirm');
Route::post('link',[App\Http\Controllers\clientController::class,'link'])->name('link');
Route::get('admin.settings',[App\Http\Controllers\adminController::class,'settings'])->name('admin.settings');
Route::post('admin.set_up',[App\Http\Controllers\adminController::class,'update_set'])->name('admin.set_up');
//finance ends

});//Only accessed by admin pages routes ends


//Client reg,login
Route::get('client.loginform',[App\Http\Controllers\clientController::class,'loginform'])->name('client.loginform');
Route::get('client.registerform',[App\Http\Controllers\clientController::class,'registerform'])->name('client.registerform');
Route::post('client.register',[App\Http\Controllers\clientController::class,'register'])->name('client.register');
Route::post('client.login',[App\Http\Controllers\clientController::class,'login'])->name('client.login');

Route::get('client.logout',[App\Http\Controllers\clientController::class,'logout'])->name('client.logout');
//client reg, login ends


//Only accessed by client pages routes
Route::group(['middleware' => ['web','auth:client'], 'prefix' => 'client'], function() {



Route::get('client.dashboard',[App\Http\Controllers\clientController::class,'dashboard'])->name('client.dashboard');
Route::get('client.personalform',[App\Http\Controllers\clientController::class,'personalform'])->name('client.personalform');
Route::post('client.personal',[App\Http\Controllers\clientController::class,'personal'])->name('client.personal');

/*employee search by client*/
Route::get('client.searchfilter',[App\Http\Controllers\clientController::class,'searchfilter'])->name('client.searchfilter');
Route::get('client.search',[App\Http\Controllers\clientController::class,'search'])->name('client.search');
/* project details */

Route::get('/client.search/{id}/search.hire',[App\Http\Controllers\projectController::class,'projectdetails'])->name('search.hire');
Route::post('client.project',[App\Http\Controllers\projectController::class,'project'])->name('client.project');

//finance
Route::get('client.paid',[App\Http\Controllers\clientController::class,'payment_complete'])->name('client.paid');

Route::get('client.payment',[App\Http\Controllers\clientController::class,'payment_status'])->name('client.payment');

Route::get('{project_id}/client.invoice',[App\Http\Controllers\clientController::class,'invoice'])->name('client.invoice');
Route::get('{project_id}/client.requestpay',[App\Http\Controllers\clientController::class,'requestpay'])->name('client.requestpay');

Route::get('client.running',[App\Http\Controllers\clientController::class,'running'])->name('client.running');
Route::get('client.all',[App\Http\Controllers\clientController::class,'all'])->name('client.all');

Route::get('{project_id}/client.additional',[App\Http\Controllers\clientController::class,'project_details'])->name('client.additional');
Route::post('client.adddetails',[App\Http\Controllers\clientController::class,'adddetails'])->name('client.adddetails');

Route::get('client.notify',[App\Http\Controllers\clientController::class,'notify'])->name('client.notify');

Route::get('admin.viewemp/{id}/employee.clientviewProfile',[App\Http\Controllers\employeeController::class,'profileview'])->name('employee.clientviewProfile');

Route::get('client.timesheet',[App\Http\Controllers\clientController::class,'timesheet'])->name('client.timesheet');
Route::get('client.settings',[App\Http\Controllers\clientController::class,'settings'])->name('client.settings');
Route::post('client.set_up',[App\Http\Controllers\clientController::class,'update_set'])->name('client.set_up');
Route::get('client.prof',[App\Http\Controllers\clientController::class,'prof'])->name('client.prof');
});//Only accessed by client pages routes ends


//employee

Route::get('employee.loginform',[App\Http\Controllers\employeeController::class,'loginform'])->name('employee.loginform');

Route::post('employee.login',[App\Http\Controllers\employeeController::class,'login'])->name('employee.login');

Route::get('employee.logout',[App\Http\Controllers\employeeController::class,'logout'])->name('employee.logout');
//employee reg, login ends


//Only accessed by employee pages routes
Route::group(['middleware' => ['web','auth:employee'], 'prefix' => 'employee'], function() {

Route::get('employee.dashboard',[App\Http\Controllers\employeeController::class,'dashboard'])->name('employee.dashboard');
Route::get('employee.notification',[App\Http\Controllers\employeeController::class,'notification'])->name('employee.notification');
Route::get('employee.notification/{project_id}/employee.project',[App\Http\Controllers\employeeController::class,'viewProject'])->name('employee.project');
Route::get('{project_id}/start',[App\Http\Controllers\employeeController::class,'start'])->name('start');
Route::get('{project_id}/pause',[App\Http\Controllers\employeeController::class,'pause'])->name('pause');
Route::get('{project_id}/resume',[App\Http\Controllers\employeeController::class,'resume'])->name('resume');
Route::get('{project_id}/end',[App\Http\Controllers\employeeController::class,'end'])->name('end');

Route::get('employee.running',[App\Http\Controllers\employeeController::class,'running'])->name('employee.running');
Route::get('employee.all',[App\Http\Controllers\employeeController::class,'all'])->name('employee.all');
Route::get('{project_id}/employee.additional',[App\Http\Controllers\employeeController::class,'additional'])->name('employee.additional');

Route::get('employee.timesheet',[App\Http\Controllers\employeeController::class,'timesheet'])->name('employee.timesheet');
Route::get('employee.paid',[App\Http\Controllers\employeeController::class,'paidtask'])->name('employee.paid');
Route::get('employee.due',[App\Http\Controllers\employeeController::class,'duetask'])->name('employee.due');
Route::get('employee.prof',[App\Http\Controllers\employeeController::class,'prof'])->name('employee.prof');
Route::get('employee.settings',[App\Http\Controllers\employeeController::class,'settings'])->name('employee.settings');
Route::post('employee.set_up',[App\Http\Controllers\employeeController::class,'update_set'])->name('employee.set_up');
});//Only accessed by employee pages routes ends


//new pages
Route::get('tos',[PageController::class,'tos'])->name('tos');
Route::get('ua',[PageController::class,'ua'])->name('ua');
Route::get('privacy',[PageController::class,'privacy'])->name('privacy');
