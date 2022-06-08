<?php

// use Illuminate\Routing\Route;

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

Route::resource('contact', 'ContactController', [
	'except' => ['create']
]);
Route::get('api/contact', 'ContactController@apiContact')->name('api.contact');


Route::resource('siswa', 'SiswaController', [
	'except' => ['create']
]);
Route::get('api/siswa', 'SiswaController@apiSiswa')->name('api.siswa');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
