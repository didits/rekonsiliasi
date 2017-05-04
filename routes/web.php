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

Route::get('/gardu', function () {
    return view('admin.nonmaster.dashboard_user.gardu');
}); 

Route::get('/input_rayon', function () {
    return view('admin.nonmaster.dashboard_user.list_gardu');
});


Route::get('/pemakaiansendiri', function () {
    return view('admin.nonmaster.dashboard_user.pemakaiansendiri');
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

Route::get('/input_dummy', function () {
    return view('admin.nonmaster.dashboard_user.input_data_dummy');
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
        'uses'      => 'Input@index'
//        'uses'      => 'AreaController@index'
    ]);

    Route::get('/profil', [
        'as'        => 'rayon.profil',
        'uses'      => 'RayonController@profil'
    ]);

    Route::get('/listrik/olah_data', [
        'as'        => 'listrik.olah_data',
        'uses'      => 'Input@olah_data'
    ]);

//    Route::get('/input_data/{tipe}', [
//        'as'        => 'input_listrik.tambah',
//        'uses'      => 'Input@create'
//    ]);

    Route::get('/list_gardu/{id_organisasi}', [
        'as'        => 'input.list_gardu',
        'uses'      => 'Input@list_gardu'
    ]);

    Route::get('/list_penyulang/{id}', [
        'as'        => 'input.list_penyulang',
        'uses'      => 'Input@list_penyulang'
    ]);

    Route::get('/input_data/{id_penyulang}', [
        'as'        => 'input.input_data',
        'uses'      => 'Input@input_data'
    ]);

    Route::get('/input_gardu/{id_gardu}', [
        'as'        => 'input.input_gardu',
        'uses'      => 'Input@input_gardu'
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
 
    Route::get('/datamaster', [
        'as'        => 'area.datamaster',
        'uses'      => 'AreaController@datamaster'
    ]);

    Route::get('/pemakaiansendiri', [
        'as'        => 'area.pemakaiansendiri',
        'uses'      => 'AreaController@pemakaiansendiri'
    ]);

    Route::get('/list_rayon', [
        'as'        => 'area.list_rayon',
        'uses'      => 'AreaController@list_rayon'
    ]);


    Route::get('/list_datamaster_rayon/{id_organisasi}', [
        'as'        => 'area.list_gardu',
        'uses'      => 'AreaController@list_gardu'
        ]);

    Route::get('/list_datamaster_trafo/{id_organisasi}/{id_gardu}', [
        'as'        => 'area.list_trafo',
        'uses'      => 'AreaController@list_trafo'
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