<?php

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/pendaftar-awal', 'EarlyRegisterController@index')->name('index.pendaftar');

Route::post('/admin/pendaftar-awal/simpan', 'EarlyRegisterController@store')->name('store.pendaftar');

Route::get('/admin/pendaftar-awal/{id}', 'EarlyRegisterController@delete')->name('delete.pendaftar');

Route::get('pendaftar-awal', 'EarlyRegisterController@form')->name('form');

Route::post('pendaftar-awal/register', 'EarlyRegisterController@register')->name('siswa.pendaftar');

Route::get('/changeStatus', 'EarlyRegisterController@change')->name('changeStatus');




