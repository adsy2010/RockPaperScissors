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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/match/list',       'MatchController@listMatches')->name('matches.list');
Route::get('/match/view/{mid}', 'MatchController@viewMatch')->name('matches.view');
Route::get('/match/create',     'MatchController@createMatch')->name('matches.create');
Route::post('/match/create',    'MatchController@createMatch')->name('matches.postCreate');
Route::get('/match/join/{mid}', 'MatchController@joinMatch')->name('matches.join');

Route::get('/match/invites', function (){})->name('matches.invites');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
