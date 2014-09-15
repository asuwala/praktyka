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

//Route::get('home/test', 'HomeController@home');
Route::get('home', array('as' => 'home', 'uses' => 'HomeController@home'));
//Route::get('auth/register', 'AuthController@getRegister');
//Route::post('auth/register', 'AuthController@postRegister');
//Route::get('auth/login', 'AuthController@getLogin');
//Route::post('auth/login', 'AuthController@postLogin');
// Route::get('home/test', 'HomeController@showWelcome');
Route::get('articles/manage-panel', 'ArticleController@getManagePanel');
Route::post('articles/retrieve', 'ArticleController@postRetrieve');
Route::get('articles/create', 'ArticleController@getCreate');
Route::post('articles/create', 'ArticleController@postCreate');
Route::get('articles/{articleId}', 'ArticleController@showArticle');
Route::get('articles/{articleId}/edit', 'ArticleController@getEdit');
Route::post('articles/{articleId}/edit', 'ArticleController@postEdit');
Route::get('articles/{articleId}/remove', 'ArticleController@getRemove');
Route::post('articles/get-newest', 'ArticleController@getNewestArticle');

//Route::controller('articles', 'ArticleController');
Route::get('subcategories/manage-panel', 'SubcategoryController@managePanel');
Route::get('subcategories/create', 'SubcategoryController@getCreate');
Route::post('subcategories/create', 'SubcategoryController@postCreate');

Route::get('subcategories/{subcategoryId}/edit', 'SubcategoryController@getEdit');
Route::post('subcategories/{subcategoryId}/edit', 'SubcategoryController@postEdit');
Route::get('subcategories/{subcategoryId}/remove', 'SubcategoryController@getRemove');
Route::post('subcategories/retrieve', 'SubcategoryController@postRetrieve');
//Route::controller('subcategories', 'SubcategoryController');


Route::get('/', function() {
    return Redirect::route('home');
    
});

    
Route::get('about', function() {
            return View::make('about');
        });
        
Route::get('contact', function() {
            return View::make('contact');
        });

