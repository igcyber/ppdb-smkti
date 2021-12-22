<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/pendaftar-awal', 'EarlyRegisterController@index')->name('index.pendaftar')->middleware('auth');

Route::post('/admin/pendaftar-awal/simpan', 'EarlyRegisterController@store')->name('store.pendaftar')->middleware('auth');

Route::get('/admin/pendaftar-awal/edit/{id}', 'EarlyRegisterController@edit')->name('edit.pendaftar');

Route::get('/generate/reg_id/{id}', 'EarlyRegisterController@generate')->name('generateID');

Route::post('/update/reg_id/{id}', 'EarlyRegisterController@update')->name('updateID');

Route::get('/admin/pendaftar-awal/{id}', 'EarlyRegisterController@delete')->name('delete.pendaftar');

Route::get('pendaftar-awal', 'EarlyRegisterController@form')->name('form');

Route::post('pendaftar-awal/register', 'EarlyRegisterController@register')->name('siswa.pendaftar');

Route::get('/changeStatus', 'EarlyRegisterController@change')->name('changeStatus');

Route::get('/export-excel', 'EarlyRegisterController@exportExcel')->name('exportExcel');

Route::post('/import-excel', 'EarlyRegisterController@importExcel')->name('importExcel');




