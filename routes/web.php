<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

// Pages
Route::get('/', 'HomeController@index')->name('homepage');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/conditions-generales-utilisation', 'PageController@conditions_generales')->name('cgu');
Route::get('/conditions-generales-vente', 'PageController@conditions_vente')->name('cgv');
Route::get('/mentions-legales', 'PageController@mentions_legales')->name('mentions_legales');
Route::get('/politique-confidentialite-donnees', 'PageController@politique_confidentialite_donnees')->name('politique_confidentialite_donnees');

// Contact
Route::get('/contact', 'ContactController@index')->name('contact');
Route::post('/contact', 'ContactController@send')->name('send_contact');

// Giveaway
Route::group(['middleware' => ['auth', 'vip'], 'prefix' => 'concours'], function()
{
    Route::get('/', 'GiveawayController@index')->name('giveaway_index');
    Route::post('/ajax', 'GiveawayController@store')->name('giveaway_store');
});

// Pronostic
Route::group(['middleware' => 'auth', 'prefix' => 'pronostic'], function()
{
    Route::get('/', 'PronosticController@index')->name('pronostic_index');
    Route::get('/date/{date}', 'PronosticController@find_by_date')->name('pronostic_find_by_date');
    Route::get('/{id}', 'PronosticController@show')->name('pronostic_show');
});

// Subscription
Route::group(['middleware' => 'auth', 'prefix' => 'subscription'], function()
{
    Route::get('/', 'SubscriptionController@index')->name('subscription_index');
    Route::get('/payments', 'SubscriptionController@create_checkout_session')->name('subscription_payments');
    Route::post('/payments', 'SubscriptionController@store')->name('subscription_payments_store');
    Route::post('/create_customer_portal_session', 'SubscriptionController@create_customer_portal_session')->name('subscription_create_customer_portal_session');
});

// Administration
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function()
{
    Route::get('/', 'Admin\AdminController@index')->name('admin.index');
    Route::resource('/pronostic', Admin\PronosticController::class, ['as' => 'admin']);
    Route::resource('/giveaway', Admin\GiveawayController::class, ['as' => 'admin']);
});
