<?php

use Illuminate\Support\Facades\Route;
use App\Mail\MailNotifyUser;
use Illuminate\Support\Facades\Mail;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => 'auth'], function () {
    Route::resource('tasks', 'TaskController');
    Route::resource('logs', 'LogController');
    Route::get('/send-mail', function () {
        Mail::to('mosiahazuaje2010@gmail.com')->send(new MailNotifyUser());
        return 'A message has been sent to Mailtrap!';
    });
    Route::get('addlogs/{id}', 'LogController@addLogs');
});
