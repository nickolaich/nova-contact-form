<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => config('nova-contact-form.api_prefix'), 'namespace' => '\Nickolaich\NovaContactForm\Http\Controllers'], function ($router) {
    $router->post('contact', 'ContactController@submit')->name('nova-contact-form.submit');
});