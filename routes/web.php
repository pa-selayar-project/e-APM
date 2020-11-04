<?php
Auth::routes();
Route::get('/', function(){
    return view('auth.login');
});
Route::post('logout', 'Auth\LoginController@logout');
Route::group(['middleware' => ['auth', 'CheckRole:1']], function () {
    Route::resource('admin/observasi/kriteria', 'observasiController');
    Route::resource('admin/observasi/penilaian', 'LkeobservasiController');
    Route::resource('admin/menu', 'MenuController');
    Route::resource('admin/submenu', 'SubmenuController');
    Route::resource('admin/menu_profil', 'MenuProfilController');
    Route::resource('admin/apm/kriteria', 'KriteriaController');
    Route::resource('admin/apm/area', 'AreaController');
    Route::get('admin/apm/eviden/get_data/{id}', 'EvidenController@get_data');
    Route::resource('admin/apm/eviden', 'EvidenController');
    Route::resource('admin/apm/assesmen', 'AssesmenController');
    Route::resource('admin/users', 'UserController');
    Route::resource('admin/role_menu', 'RoleMenuController');
    Route::get('admin/apm/lke/apm', 'EvidenController@apm');
    Route::get('admin/apm/lke/kriteria_apm/{id}', 'EvidenController@kriteria_apm');
    Route::post('admin/apm/eviden/import', 'EvidenController@import');
    Route::post('admin/apm/assesmen/import', 'AssesmenController@import');
    Route::post('admin/observasi/penilaian/import', 'LkeobservasiController@import');
});

Route::group(['middleware' => ['auth', 'CheckRole:1,2,3']], function () {
    Route::get('dashboard', 'HomeController@index');
    Route::get('lke/get_data/{id}', 'lke1Controller@get_data');
    Route::resource('user/lke/apm', 'lke1Controller');
    Route::patch('lke/hapus_pdf/{id}', 'lke1Controller@hapus_pdf');
    Route::resource('profil', 'ProfilController');
});

Route::group(['middleware' => ['auth', 'CheckRole:3']], function () {
    Route::get('assesor/apm', 'EvidenController@apm');
    Route::get('assesor/apm/kriteria/{id}', 'EvidenController@kriteria_apm');
});
