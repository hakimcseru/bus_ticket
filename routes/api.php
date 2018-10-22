<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('register','ApiLoginController@register');
//login submit
Route::post('login-submit','ApiLoginController@login');
//profile
Route::post('profile/dashboard','ApiProfile@profileDashboard');
//profile update
Route::post('profile/update','ApiProfile@submitUpdate');
//logout
Route::post('logout','ApiLoginController@logout');
//forgot password
Route::post('forgot-password','ApiLoginController@forgotPassword');
//submit device token
Route::post('login/submit-device-token','ApiLoginController@submitDeviceToken');

//d

//doctor list updated
Route::get('doctor/list','ApiDoctorOperation@doctorList');
//doctor single info updated
Route::post('doctor/single','ApiDoctorOperation@doctorSingle');
//message list
Route::get('message/list','ApiMessageOperation@messageList');
//message single
Route::post('message/single','ApiMessageOperation@messageSingle');
//all institute list by type updated
Route::post('institute/list','ApiInstituteOperation@instituteList');
//institute list for employee
Route::get('institute/list-employee','ApiInstituteOperation@instituteListEmployee');
//institute single updated
Route::post('institute/single','ApiInstituteOperation@instituteSingle');
//medicine list updated
Route::get('medicine/list','ApiMedicineOperation@medicineList');
//medicine single updated
Route::post('medicine/single','ApiMedicineOperation@medicineSingle');
//create emp_todo
Route::post('todo/create','ApiTodoOperation@createTodo');
//emp_todo list
Route::get('todo/list','ApiTodoOperation@todoList');
//emp_todo delete
Route::post('todo/delete','ApiTodoOperation@todoDelete');
//emp_todo edit
Route::post('todo/update','ApiTodoOperation@todoUpdate');
//notice list
Route::get('notice/list','ApiTodoOperation@noticeList');
//attendance
Route::post('attendance/submit','ApiAttendanceOperation@submitAttendance');
//news
Route::get('news/list','ApiNewsOperation@newsList');

//department by Institution
Route::post('department/list-by-institution','ApiDepartmentOperation@listByInstitution');
//work plan submit
Route::post('work-plan/submit','ApiWorkPlanOperation@submitWorkPlan');
//work plan list
Route::get('work-plan/list','ApiWorkPlanOperation@listWorkPlan');
//work plan single
Route::post('work-plan/single','ApiWorkPlanOperation@singleWorkPlan');
//work plan update
Route::post('work-plan/update','ApiWorkPlanOperation@updateWorkPlan');
//work plan delete
Route::post('work-plan/delete','ApiWorkPlanOperation@deleteWorkPlan');
//medicine list for work plan
Route::post('medicine/list-for-plan','ApiMedicineOperation@medicineListByDoctor');





