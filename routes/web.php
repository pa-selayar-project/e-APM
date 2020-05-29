<?php

Route::get('front/get_data/{id}', 'FrontController@get_data');
Route::get('/', 'FrontController@index');

Auth::routes();
Route::post('logout', 'Auth\LoginController@logout');
Route::group(['middleware' => ['auth', 'CheckRole:1']], function () {
    Route::resource('menu', 'MenuController');
    Route::resource('submenu', 'SubmenuController');
    Route::resource('menu_profil', 'MenuProfilController');
    Route::resource('kriteria', 'KriteriaController');
    Route::resource('area', 'AreaController');
    Route::get('eviden/get_data/{id}', 'EvidenController@get_data');
    Route::resource('eviden', 'EvidenController');
    Route::resource('assesmen', 'AssesmenController');
    Route::post('eviden/import', 'EvidenController@import');
    Route::post('assesmen/import', 'AssesmenController@import');
});

Route::group(['middleware' => ['auth', 'CheckRole:1,2']], function () {
    Route::get('dashboard', 'HomeController@index');
    Route::get('lke_1/get_data/{id}', 'lke1Controller@get_data');
    Route::resource('lke_1', 'lke1Controller');
    Route::patch('lke_1/hapus_pdf/{id}', 'lke1Controller@hapus_pdf');
    Route::resource('profil', 'ProfilController');
});
