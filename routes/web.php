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
    Auth ::routes();
    Route ::get('/', 'IndexController@index') -> name('index');
    //   Route::get('/', 'TestController@index')->name('test');
    Route ::post('login', 'AuthController@login') -> name('login');
    Route ::post('logout', 'AuthController@logout') -> name('logout');
    Route ::middleware('auth') -> group(function () {
        Route ::get('delete/{id}', 'AdsController@deleteHandler') -> name('delete');
        Route ::get('edit/{id}', 'AdsController@editItem') -> name('edit');
        Route ::get('create', 'AdsController@createItem') -> name('create');
        Route ::post('create-handler', 'AdsController@createHandler') -> name('create-handler');
        Route ::post('edit-handler', 'AdsController@editHandler') -> name('edit-handler');
    });
    Route ::get('/{id}', 'AdsController@viewItem') -> name('view');