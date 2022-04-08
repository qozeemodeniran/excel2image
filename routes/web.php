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

// Route::get('importExportView', 'App\Http\Controllers\E2IController@importExportView');
// Route::get('export', 'App\Http\Controllers\E2IController@export')->name('export');
// Route::post('import', 'App\Http\Controllers\E2IController@import')->name('import');
// Route::post('import', 'App\Http\Controllers\E2IController@import')->name('import');
// Route::get('result', 'App\Http\Controllers\E2IController@result')->name('result');
// Route::post('result', 'App\Http\Controllers\E2IController@result')->name('result');

Route::get('import-export-view', 'App\Http\Controllers\E2IController@importExportView');
Route::post('import-to-view', 'App\Http\Controllers\E2IController@import')->name('import-to-view');
Route::get('export', 'App\Http\Controllers\E2IController@export')->name('export');
Route::post('import', 'App\Http\Controllers\E2IController@import')->name('import');

// Route::post('result', 'App\Http\Controllers\E2IController@result')->name('result');
// // Route::post('result', 'App\Http\Controllers\E2IController@result')->name('result');