<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




get('admin/logs', ['uses' => '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index', 'as' => 'admin.logs', /*'middleware' => ['auth','admin_auth']*/ ]);

/*Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);*/