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

Route::get('/', 'lke1Controller@frontEnd');

Auth::routes();
Route::post('logout', 'Auth\LoginController@logout');
Route::get('home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth', 'CheckRole:1']], function () {
    Route::resource('menu', 'MenuController');
    Route::resource('submenu', 'SubmenuController');
    Route::resource('menu_profil', 'MenuProfilController');
    Route::resource('profil', 'ProfilController');
    Route::resource('kriteria', 'KriteriaController');
    Route::resource('area', 'AreaController');
    Route::resource('eviden', 'EvidenController');
    Route::resource('assesmen', 'AssesmenController');
    Route::post('eviden/import', 'EvidenController@import');
    Route::post('assesmen/import', 'AssesmenController@import');
});

Route::group(['middleware' => ['auth', 'CheckRole:1,2']], function () {
    Route::resource('sklist', 'SklistsController');
    Route::resource('soplist', 'SoplistController');
    Route::resource('kgblist', 'KgblistController');
    Route::resource('kplist', 'KplistController');
    Route::resource('sclist', 'SclistController');
    Route::resource('stlist', 'StlistController');
    Route::resource('lke_1', 'lke1Controller');
    Route::post('lke_1/hapus_pdf/{id}', 'lke1Controller@hapus_pdf');
});
