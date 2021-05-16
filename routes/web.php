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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function()
{
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::resource('kriteria', 'KriteriaController');
    Route::resource('sub-kriteria', 'SubKriteriaController');
    Route::resource('alternatif', 'AlternatifController');
    Route::resource('bobot-kriteria', 'BobotKriteriaController');
    Route::resource('account', 'AccountController');
    Route::get('hasil-perhitungan', 'HasilController@hasil_perhitungan')->name('hasil.perhitungan');
    Route::get('unduh-hasil-perhitungan', 'HasilController@unduh_hasil_perhitungan')->name('unduh.hasil-perhitungan');
    Route::resource('bobot-kriteria', 'BobotKriteriaController');
    Route::get('edit-bobot-kriteria', 'BobotKriteriaController@editBobotKriteria')->name('bobot-kriteria.ubah');
    Route::put('update-bobot-kriteria', 'BobotKriteriaController@updateBobotKriteria')->name('bobot-kriteria.simpanUpdate');
});
