<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group([
    'as' => 'budget.',
    'middleware' => 'auth'
], function () {
    Route::get('/orcamentos', 'BudgetController@index')->name('index');
    Route::get('/orcamentos/criar', 'BudgetController@create')->name('create');
    Route::get('/orcamentos/editar/{budget}', 'BudgetController@edit')->name('edit');
    Route::post('/orcamentos', 'BudgetController@store')->name('store');
    Route::put('/orcamentos', 'BudgetController@update')->name('update');
    Route::delete('/orcamentos/{budget}', 'BudgetController@delete')->name('delete');
});


