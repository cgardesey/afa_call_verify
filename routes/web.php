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

use App\CallLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return  view('index');
})->middleware('auth');

Route::post('/group-call', 'CallLogController@callLog')->name('groupCall');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('password/update', 'UsersController@updatePassword')->name('password.update');
Route::get('password/update', 'UsersController@showUpdatePassword')->name('show.password.update')->middleware('auth');
//
// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');
//
// Password Reset Routes...
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset');






/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin/admin-users',                            'Admin\AdminUsersController@index');
    Route::get('/admin/admin-users/create',                     'Admin\AdminUsersController@create');
    Route::post('/admin/admin-users',                           'Admin\AdminUsersController@store');
    Route::get('/admin/admin-users/{adminUser}/edit',           'Admin\AdminUsersController@edit')->name('admin/admin-users/edit');
    Route::post('/admin/admin-users/{adminUser}',               'Admin\AdminUsersController@update')->name('admin/admin-users/update');
    Route::delete('/admin/admin-users/{adminUser}',             'Admin\AdminUsersController@destroy')->name('admin/admin-users/destroy');
    Route::get('/admin/admin-users/{adminUser}/resend-activation','Admin\AdminUsersController@resendActivationEmail')->name('admin/admin-users/resendActivationEmail');
});

/* Auto-generated profile routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin/profile',                                'Admin\ProfileController@editProfile');
    Route::post('/admin/profile',                               'Admin\ProfileController@updateProfile');
    Route::get('/admin/password',                               'Admin\ProfileController@editPassword');
    Route::post('/admin/password',                              'Admin\ProfileController@updatePassword');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin/users',                                  'Admin\UsersController@index');
    Route::get('/admin/users/create',                           'Admin\UsersController@create');
    Route::post('/admin/users',                                 'Admin\UsersController@store');
    Route::get('/admin/users/{user}/edit',                      'Admin\UsersController@edit')->name('admin/users/edit');
    Route::post('/admin/users/bulk-destroy',                    'Admin\UsersController@bulkDestroy')->name('admin/users/bulk-destroy');
    Route::post('/admin/users/{user}',                          'Admin\UsersController@update')->name('admin/users/update');
    Route::delete('/admin/users/{user}',                        'Admin\UsersController@destroy')->name('admin/users/destroy');
    Route::get('/admin/users/export',                           'Admin\UsersController@export')->name('admin/users/export');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin/call-logs',                              'Admin\CallLogsController@index');
    Route::get('/admin/call-logs/create',                       'Admin\CallLogsController@create');
    Route::post('/admin/call-logs',                             'Admin\CallLogsController@store');
    Route::get('/admin/call-logs/{callLog}/edit',               'Admin\CallLogsController@edit')->name('admin/call-logs/edit');
    Route::post('/admin/call-logs/bulk-destroy',                'Admin\CallLogsController@bulkDestroy')->name('admin/call-logs/bulk-destroy');
    Route::post('/admin/call-logs/{callLog}',                   'Admin\CallLogsController@update')->name('admin/call-logs/update');
    Route::delete('/admin/call-logs/{callLog}',                 'Admin\CallLogsController@destroy')->name('admin/call-logs/destroy');
    Route::get('/admin/call-logs/export',                       'Admin\CallLogsController@export')->name('admin/call-logs/export');
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin/call-logs',                              'Admin\CallLogsController@index');
    Route::get('/admin/call-logs/create',                       'Admin\CallLogsController@create');
    Route::post('/admin/call-logs',                             'Admin\CallLogsController@store');
    Route::get('/admin/call-logs/{callLog}/edit',               'Admin\CallLogsController@edit')->name('admin/call-logs/edit');
    Route::post('/admin/call-logs/bulk-destroy',                'Admin\CallLogsController@bulkDestroy')->name('admin/call-logs/bulk-destroy');
    Route::post('/admin/call-logs/{callLog}',                   'Admin\CallLogsController@update')->name('admin/call-logs/update');
    Route::delete('/admin/call-logs/{callLog}',                 'Admin\CallLogsController@destroy')->name('admin/call-logs/destroy');
    Route::get('/admin/call-logs/export',                       'Admin\CallLogsController@export')->name('admin/call-logs/export');
});
