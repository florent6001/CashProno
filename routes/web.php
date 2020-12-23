<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('homepage');

// Contact
Route::get('/contact', 'ContactController@index')->name('contact');
Route::post('/contact', 'ContactController@send')->name('send_contact');

Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function()
{
    Route::get('/', 'Admin\AdminController@index')->name('admin.index');
    Route::resource('/pronostic', Admin\PronosticController::class, ['as' => 'admin']);
});