<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Common
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/all_employees', "UserController@allEmployees");
});



// Teams
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/teams', "TeamsController@index");
    Route::post('/addTeam', "TeamsController@store");
    //Members
    Route::get('/teamMembers/{team}', "UserController@members");
    Route::post('add_team_member/{userType}', 'UserController@register');
});

// Leads

Route::get('/lead_detail/{id}', "LeadsController@detail");
Route::get('/activity/{id}', "LeadsController@activity");
Route::get('/lead_types', "LeadsController@leadTypes");
Route::get('/lead_sources', "LeadsController@leadSources");
Route::get('/tradeins/{id}', "LeadsController@tradeins");
Route::get('/voi/{id}', "LeadsController@voi");
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('/dt_leads', "LeadsController@dt_leads");
    Route::get('/appointments/{id}', "LeadsController@appointments");
    Route::post('/add_appointment', "LeadsController@addAppointment");
    Route::get('/tasks/{id}', "LeadsController@tasks");
    Route::post('/add_task', "LeadsController@addTask");
    Route::get('/notes/{id}', "LeadsController@notes");
    Route::post('/add_note', "LeadsController@addNote"); 
    Route::post('/lead_assign', "LeadsController@leadAssign");
    Route::post('/update_lead_status', "LeadsController@updateLeadStatus");
    Route::post('/add_new_lead', "LeadsController@addNewLead");
    Route::post('/leads_count', "LeadsController@leadsCount"); 
    Route::post('/activity_detail', "LeadsController@activityDetail");
    Route::post('/add_trade', "LeadsController@addTrade");
    Route::get('getEmails/{id}','MailController@getEmails');
    Route::post('/send_email', "MailController@sendEmail"); 
});


// Reports 
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('/dt_leads_report_data', "ReportsController@dt_leads_report_data");
    Route::post('/leads_report_stats', "ReportsController@leadsStats"); 
    Route::get('/employee_activity_report_stats', "ReportsController@employeeActivityStats");
});

// User Management
Route::post('login', 'UserController@login');
Route::post('register/{userType}', 'UserController@register');


// Mail BOX
Route::get('mailbox','CatchMailBoxController');
Route::get('uts/{id}','LeadsController@updateUntouchStatus');
//Route::get('clearMailBox','CatchMailBoxController@clearMailBox');
Route::get('testXml','CatchMailBoxController@testXml');


// Notifications
Route::middleware('auth:api')->get('/notifications', function() {
	return ['count'=>count(Auth::user()->unreadNotifications),'text'=>Auth::user()->notifications,'user'=>Auth::user()->id];
});
Route::middleware('auth:api')->get('/mark_as_read', function() {
	return Auth::user()->unreadNotifications->markAsRead();
});


// Twilio SMS
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('sendSMS','WebHooksController@sendSMS');
    Route::get('getSMS/{id}','WebHooksController@getSMS');
});
Route::post('twillio_sms_response','WebHooksController@twillioSMSResponse');

// Settings
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/schedule','Settings@schedule');
    Route::post('/update_schedule','Settings@updateSchedule');
    Route::get('/update_user_busy_status','UserController@updateUserBusyStatus');
});

// Campaigns
Route::get('/send_campaigns','Campaigns@sendCampaigns');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('/dt_campaigns_list','Campaigns@dtCampaignsList');
    Route::get('/campaigns_list','Campaigns@campaignsList');
    Route::post('/add_campaign_list','Campaigns@addCampaignList'); 
    Route::post('/change_campaign_list_status','Campaigns@changeCampaignListStatus');
    Route::post('/add_new_campaign','Campaigns@addNewCampaign');
    // Route::post('/campaigns','Campaigns@campaigns');
    Route::post('/dt_campaigns','Campaigns@dt_campaigns');
    
    
});
Route::get('/contact_list','Campaigns@sg_createContactsList');

//Route::get('/send_email', "MailController@sendEmail");
// Test
//Route::get('/like_it', "UserController@likeIt");