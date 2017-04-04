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
    return view('admin.nonmaster.dashboard_user.index');
});
 
Route::get('/login', function () {
    return view('admin.nonmaster.dashboard_user.login');
});

Route::get('/profil', function () {
    return view('admin.nonmaster.dashboard_user.profile');
});

Route::get('/edit_profil', function () {
    return view('admin.nonmaster.dashboard_user.profile_edit');
});

Route::get('/input_area', function () {
    return view('admin.nonmaster.dashboard_user.area');
});

Route::get('/input_rayon', function () {
    return view('admin.nonmaster.dashboard_user.rayon');
});

Route::get('/input_data', function () {
    return view('admin.nonmaster.dashboard_user.input_data');
});

Route::get('/datamaster', function () {
    return view('admin.nonmaster.dashboard_user.datamaster');
});

Route::get('/list_datamaster', function () {
    return view('admin.nonmaster.dashboard_user.list_datamaster');
});

Route::get('/list_datamaster_rayon', function () {
    return view('admin.nonmaster.dashboard_user.list_datamaster_rayon');
});

Route::get('/laporan', function () {
    return view('admin.nonmaster.laporan.ktt');
});

Route::get('/laporan_area', function () {
    return view('admin.nonmaster.laporan.area');
});

Route::get('/laporan_rayon', function () {
    return view('admin.nonmaster.laporan.rayon');
});

Route::get('/laporan_GI', function () {
    return view('admin.nonmaster.laporan.gi');
});

Route::resource('input_listrik', 'Input');

Route::match(['get'],'/listrik/list_data', [
    'as'        => 'listrik.list_data',
    'uses'      => 'Input@list_data'
]);