<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', ['uses' => 'HomeController@index', 'as' => 'main.index']);
Route::get('professionalspace', ['uses' => 'HomeController@professionalspace', 'as' => 'main.professionalspace']);
Route::get('/dashboard', ['uses' => 'HomeController@dashboard', 'as' => 'main.dashboard', 'middleware' => 'checkUserFinish']);
Route::get('/terms', ['uses' => 'HomeController@terms', 'as' => 'main.terms']);
Route::get('/privacy', ['uses' => 'HomeController@privacy', 'as' => 'main.privacy']);
Route::get('/resetpassword', ['uses' => 'HomeController@resetpassword', 'as' => 'main.resetpassword']);
Route::get('/reset', ['uses' => 'HomeController@doresetpassword', 'as' => 'main.reset']);
Route::get('invites', ['uses' => 'HomeController@invites', 'as' => 'main.invites', 'middleware' => 'checkUser']);
Route::get('signup', ['uses' => 'HomeController@signup', 'as' => 'main.signup']);
Route::get('setup', ['uses' => 'HomeController@setup', 'as' => 'main.setup', 'middleware' => 'checkUser']);
Route::get('userinterest', ['uses' => 'HomeController@userinterest', 'as' => 'main.userinterest', 'middleware' => 'checkUser']);
Route::get('myindustrylist', ['uses' => 'HomeController@myindustrylist', 'as' => 'main.myindustrylist', 'middleware' => 'checkUser']);

Route::get('/app/oauth', ['uses' => 'HomeController@oauth', 'as' => 'main.app.oauth', 'middleware' => 'checkUser']);
Route::get('/app/oauth/list', ['uses' => 'HomeController@googlecontact', 'as' => 'main.app.oauth.list', 'middleware' => 'checkUser']);

//Ajax
Route::group(['prefix' => 'Ajax'], function() {
	Route::post('Register', ['uses' => 'AjaxController@register', 'as' => 'main.register']);
	Route::post('CheckEmail', ['uses' => 'AjaxController@checkEmail', 'as' => 'main.checkEmail']);
	Route::post('CreateAccount', ['uses' => 'AjaxController@createaccount', 'as' => 'main.CreateAccount']);
	Route::post('checkAccount', ['uses' => 'AjaxController@checkAccount', 'as' => 'main.checkAccount']);
	Route::post('Login', ['uses' => 'AjaxController@Login', 'as' => 'main.Login']);
	Route::post('Contact', ['uses' => 'AjaxController@contact', 'as' => 'main.Contact']);
	Route::post('Subscribe', ['uses' => 'AjaxController@subscribe', 'as' => 'main.Subscribe']);
	Route::post('Invite', ['uses' => 'AjaxController@invite', 'as' => 'main.Invite']);
	Route::post('InviteContact', ['uses' => 'AjaxController@InviteContact', 'as' => 'main.InviteContact']);
	Route::post('Logout', ['uses' => 'AjaxController@logout', 'as' => 'main.Logout']);
	Route::post('removeConnection', ['uses' => 'AjaxController@removeconnection', 'as' => 'main.removeConnection']);
	Route::post('addConnection', ['uses' => 'AjaxController@addconnection', 'as' => 'main.addConnection']);
	Route::post('addConSetup', ['uses' => 'AjaxController@addConSetup', 'as' => 'main.addConSetup']);
	Route::post('accept', ['uses' => 'AjaxController@accept', 'as' => 'main.accept']);
	Route::post('UpdateAccount', ['uses' => 'AjaxController@updateaccount', 'as' => 'main.UpdateAccount']);
	Route::post('UpdateImage', ['uses' => 'AjaxController@updateimage', 'as' => 'main.UpdateImage']);
	Route::post('DoSettings', ['uses' => 'AjaxController@dosettings', 'as' => 'main.DoSettings']);
	Route::post('getProfile', ['uses' => 'AjaxController@getprofile', 'as' => 'main.getProfile']);
	Route::post('chatdetails', ['uses' => 'AjaxController@chatdetails', 'as' => 'main.chatdetails']);
	Route::post('updatesecurity', ['uses' => 'AjaxController@updatesecurity', 'as' => 'main.updatesecurity']);
	Route::post('trylogin', ['uses' => 'AjaxController@trylogin', 'as' => 'main.trylogin']);
	Route::post('updatepassword', ['uses' => 'AjaxController@updatepassword', 'as' => 'main.updatepassword']);
	Route::post('resetlink', ['uses' => 'AjaxController@resetlink', 'as' => 'main.resetlink']);
	Route::post('doreset', ['uses' => 'AjaxController@doreset', 'as' => 'main.doreset']);
	Route::post('import', ['uses' => 'AjaxController@import', 'as' => 'main.import']);
	Route::post('sendMessage', ['uses' => 'AjaxController@sendMessage', 'as' => 'main.sendMessage']);
	Route::post('alternate_email', ['uses' => 'AjaxController@alternate_email', 'as' => 'main.alternate_email']);
	Route::post('getQuestion', ['uses' => 'AjaxController@getQuestion', 'as' => 'main.getQuestion']);
	Route::post('activateSpace', ['uses' => 'AjaxController@activateSpace', 'as' => 'main.activateSpace']);
	Route::get('loadMoreConnection', ['uses' => 'HomeController@loadMoreConnection', 'as' => 'main.loadMoreConnection']);
	Route::post('saveInterest', ['uses' => 'AjaxController@saveInterest', 'as' => 'main.saveInterest']);
	Route::post('setBadge', ['uses' => 'AjaxController@setBadge', 'as' => 'main.setBadge']);
	Route::post('fetchCalc', ['uses' => 'HomeController@fetchCalc', 'as' => 'main.fetchCalc']);
	Route::post('moreDetails', ['uses' => 'HomeController@moreDetails', 'as' => 'main.moreDetails']);
	Route::post('uploadCompanyLogo', ['uses' => 'HomeController@uploadCompanyLogo', 'as' => 'main.uploadCompanyLogo']);

	//Pull Worker
	Route::post('getcontacts', ['uses' => 'AjaxController@getcontacts', 'as' => 'main.getcontacts']);
	Route::post('getConnections', ['uses' => 'AjaxController@getConnections', 'as' => 'main.getConnections']);
});

//Admin
Route::group(['prefix' => 'Admin'], function() {
	Route::get('index', ['uses' => 'AdminController@index', 'as' => 'main.admin.index']);
	Route::get('index', ['uses' => 'AdminController@index', 'as' => 'main.admin.index']);
	Route::get('logout', ['uses' => 'AdminController@logout', 'as' => 'main.admin.logout']);
	Route::get('getRegistered', ['uses' => 'AdminController@getRegistered', 'as' => 'main.admin.getRegistered']);
	Route::get('details', ['uses' => 'AdminController@details', 'as' => 'main.admin.details']);
	Route::get('unregistered', ['uses' => 'AdminController@unregistered', 'as' => 'main.admin.unregistered']);
	Route::post('makepayment' ,['uses' => 'AdminController@makepayment', 'as' =>'makepayment']);
	Route::get('paysprintpayment' ,['uses' => 'AdminController@paysprintPayment', 'as' =>'paysprintpayment']);
});

//Ajax
Route::group(['prefix' => 'Api'], function() {
	Route::post('index', ['uses' => 'ApiController@index', 'as' => 'main.api.index']);
});

//Cron
Route::group(['prefix' => 'Cron'], function() {
	Route::get('checkActive', ['uses' => 'CronController@checkActive', 'as' => 'cron.checkActive']);
});

//pay with paysprint
Route::prefix('paysprint')->group(function () {
	Route::post('/user', ['uses' => 'PaySprintController@user', 'as' => 'paysprint.user']);
	Route::post('/guest', ['uses' => 'PaySprintController@guest', 'as' => 'paysprint.guest']);
});


