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


Route::get('first', function()
{
    return Redirect::to('second');
});

Route::get('second', function()
{
    return 'Second route.';
});

Route::get('hello', function() 
{
    return View::make('hello');
});

Route::get('custom/response', function()
{
     $response = Response::make('***some bold text***', 200);
    $response->headers->set('Content-Type', 'text/x-markdown');
    return $response;
});

Route::get('our/response', function()
{
    $response = Response::make('Bond, James Bond.', 200);
    $response->setTtl(60);
    return $response;
});

Route::get('markdown/response', function()
{
    $data = array('iron', 'man', 'rocks');
    return Response::json($data);
});
/*
Route::get('file/download', function()
{
    $file = 'konfiguracja.txt';
    return Response::download($file, 418, array('iron', 'man'));
});
 */

Route::get('simple', 'ArticleController@showSingle');

Route::get('example', function()
{
    return View::make('example');
});


Route::get('/przyklad', function()
{
    return View::make('example1');
});

Route::get('/moj', function()
{
    return View::make('home');
});
