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
        Route ::get('delete/{id}', 'AdsController@deleteItem') -> name('delete');
        Route ::get('edit', 'AdsController@editItem') -> name('edit');
        Route ::post('create', 'AdsController@createItem') -> name('create');
    });
    Route ::get('/{id}', 'AdsController@viewItem') -> name('view');