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

Route::get('/datamaster', function () {
    return view('admin.nonmaster.dashboard_user.datamaster');
});

Route::get('/pemakaiansendiri', function () {
    return view('admin.nonmaster.dashboard_user.pemakaiansendiri');
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
Route::resource('input_datamaster', 'AreaController');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');
Route::get('/admin', 'HomeController@index');
Route::get('/logout', 'AuthController@logout');

//rayon
Route::group(['middleware' => 'auth', 'prefix' => 'rayon'], function () {

    Route::get('/', [
        'as'        => 'rayon.index',
        'uses'      => 'Input@list_data'
    ]);

    Route::get('/profil', [
        'as'        => 'rayon.profil',
        'uses'      => 'RayonController@profil'
    ]);

    Route::get('/listrik/olah_data', [
        'as'        => 'listrik.olah_data',
        'uses'      => 'Input@olah_data'
    ]);

    Route::get('/input_data/{tipe}', [
        'as'        => 'input_listrik.tambah',
        'uses'      => 'Input@create'
    ]);

    Route::match(['get'],'/listrik/list_data', [
        'as'        => 'listrik.list_data',
        'uses'      => 'Input@list_data'
    ]);

    Route::match(['get'],'/listrik/hasil_pengolahan', [
        'as'        => 'listrik.hasil_pengolahan',
        'uses'      => 'Input@hasil_pengolahan'
    ]);

    Route::match(['get'],'/listrik/{id}', [
        'as'        => 'listrik.update',
        'uses'      => 'Input@update'
    ]);

});

//area
Route::group(['middleware' => 'auth', 'prefix' => 'area'], function () {

    Route::get('/', [
        'as'        => 'area.index',
        'uses'      => 'AreaController@list_rayon'
    ]);

    Route::get('/profil', [
        'as'        => 'area.profil',
        'uses'      => 'AreaController@profil'
    ]);

    Route::get('/list_rayon', [
        'as'        => 'area.list_rayon',
        'uses'      => 'AreaController@list_rayon'
    ]);
});

//distribusi
Route::group(['middleware' => 'auth', 'prefix' => 'distribusi'], function () {
    Route::get('/', [
        'as'        => 'distribusi.index',
        'uses'      => 'DistribusiController@index'
    ]);
});

//admin
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('/', [
        'as'        => 'admin.index',
        'uses'      => 'AdminController@index'
    ]);

    Route::get('/management_rayon', [
        'as'        => 'admin.management_rayon',
        'uses'      => 'AdminController@managementRayon'
    ]);
});