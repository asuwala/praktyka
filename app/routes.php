<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

// app/routes.php
Route::controller('auth', 'AuthController');
//Route::get('auth/register', 'AuthController@getRegister');
//Route::post('auth/register', 'AuthController@postRegister');
//Route::get('auth/login', 'AuthController@getLogin');
//Route::post('auth/login', 'AuthController@postLogin');
// Route::get('home/test', 'HomeController@showWelcome');


Route::get('/', function() {
            return View::make('home');
        });

Route::get('hello', function() {
            return View::make('hello');
        });