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

Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('login', 'DashboardController@login')->name('login');
Route::post('login-process', 'DashboardController@loginProcess')->name('login.proses');
Route::get('logout', 'DashboardController@logout')->name('logout');

/*
|--------------------------------------------------------------------------
| Manajemen Kelas
|--------------------------------------------------------------------------
*/
Route::get('assesor/ajax_datatable', 'ManajemenKelas\AssesorController@ajax_datatable')->name('assesor.ajax_datatable');
Route::get('assesor', 'ManajemenKelas\AssesorController@index')->name('assesor');
Route::get('assesor/create', 'ManajemenKelas\AssesorController@create')->name('assesor.create');
Route::post('assesor/store', 'ManajemenKelas\AssesorController@store')->name('assesor.store');
Route::get('assesor/{id}/edit', 'ManajemenKelas\AssesorController@edit')->name('assesor.edit');