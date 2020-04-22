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
Auth::routes();
Route::get('/', function () {
    return view('home');
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('other');
Route::resource('entries', 'EntryController');
Route::resource('services', 'ServicesController');
Route::resource('vehicles', 'VehiclesController');
Route::resource('user', 'UserController');
Route::resource('clients', 'ClientsController');
Route::resource('tasks', 'TasksController');
Route::resource('locations', 'LocationController');
Route::resource('reminder', 'ReminderController');
Route::resource('copy', 'CopyController');
Route::resource('task', 'TaskController');
Route::get('/home', 'HomeController@index')->name('home');

