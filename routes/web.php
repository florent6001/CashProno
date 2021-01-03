<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebhookController;

Auth::routes();

// Pages
Route::get('/', 'HomeController@index')->name('homepage');
Route::get('/home', 'HomeController@index')->name('home');

// Contact
Route::get('/contact', 'ContactController@index')->name('contact');
Route::post('/contact', 'ContactController@send')->name('send_contact');

// Pronostic
Route::group(['middleware' => 'auth', 'prefix' => 'pronostic'], function()
{
    Route::get('/', 'PronosticController@index')->name('pronostic_index');
    Route::get('/date/{date}', 'PronosticController@find_by_date')->name('pronostic_find_by_date');
    Route::get('/{id}', 'PronosticController@show')->name('pronostic_show');
});

// VIP
Route::group(['middleware' => 'auth', 'prefix' => 'subscription'], function()
{
    Route::get('/', 'SubscriptionController@index')->name('subscription_index');
    Route::get('/payments', 'SubscriptionController@create_checkout_session')->name('subscription_payments');
    Route::post('/payments', 'SubscriptionController@store')->name('subscription_payments_store');
    Route::post('/create_customer_portal_session', 'SubscriptionController@create_customer_portal_session')->name('subscription_create_customer_portal_session');
});

// Espace admin
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function()
{
    Route::get('/', 'Admin\AdminController@index')->name('admin.index');
    Route::resource('/pronostic', Admin\PronosticController::class, ['as' => 'admin']);
});

// Webhook
// Route::post('/stripe/webhook', [WebhookController::class, 'handleWebhook']);