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
Route::resource('entries', 'EntryController');
Route::resource('services', 'ServicesController');
Route::resource('vehicles', 'VehiclesController');
Route::resource('clients', 'ClientsController');
Route::resource('tasks', 'TasksController');
Route::resource('locations', 'LocationController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
