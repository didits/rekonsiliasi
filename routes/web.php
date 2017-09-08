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
    return view('admin.nonmaster.dashboard_user.input_data_dummy1');
});

Route::resource('input_listrik', 'Input');
Route::resource('input_datamaster', 'AreaController');

Route::get('populate/area',array('as'=>'populate.area','uses'=>'AjaxController@populateArea'));
Route::get('populate/rayon/{id_area}',array('as'=>'populate.rayon','uses'=>'AjaxController@populateRayon'));
Route::get('populate/penyulang/{id_rayon}',array('as'=>'populate.penyulang','uses'=>'AjaxController@populatePenyulang'));
Route::get('populate/gd/{id_penyulang}',array('as'=>'populate.gd','uses'=>'AjaxController@populateGD'));

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

    Route::get('/list_gardu_induk/{id_organisasi}', [
        'as'        => 'input.list_gardu_induk',
        'uses'      => 'Input@list_gardu_induk'
    ]);

    Route::get('/list_trafo_gi/{id}', [
        'as'        => 'input.list_trafo_gi',
        'uses'      => 'Input@list_trafo_gi'
    ]);

    Route::get('/list_penyulang/{id}', [
        'as'        => 'input.list_penyulang',
        'uses'      => 'Input@list_penyulang'
    ]);

    Route::get('/list_gd/{id}', [
        'as'        => 'input.list_gd',
        'uses'      => 'Input@list_gd'
    ]);

    Route::get('/input_data/{id}/{nama}', [
        'as'        => 'input.input_data',
        'uses'      => 'Input@input_data'
    ]);

//    Route::get('/input_data_keluar/{id}/{nama}', [
//        'as'        => 'input.input_data_keluar',
//        'uses'      => 'Input@input_data_keluar'
//    ]);

    Route::get('/input_gardu/{id_gardu}', [
        'as'        => 'input.input_gardu',
        'uses'      => 'Input@input_gardu'
    ]);

    Route::get('/list_laporan_gardu/{id_gardu}', [
        'as'        => 'input.list_laporan_gardu',
        'uses'      => 'Input@list_laporan_gardu'
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

    Route::get('/list_hasil_laporan_semua_penyulang/{id_gardu}', [
        'as'        => 'laporan.list_hasil_laporan_semua_penyulang',
        'uses'      => 'Laporan@list_hasil_laporan_semua_penyulang'
    ]);

});

//area
Route::group(['middleware' => 'auth', 'prefix' => 'area'], function () {

    Route::get('/getStructure/{id}', [
        'as'        => 'area.get_structure',
        'uses'      => 'AreaController@getStructureKelistrikan'
    ]);

    Route::get('/', [
        'as'        => 'area.index',
        'uses'      => 'AreaController@list_rayon'
    ]);

    Route::get('delete/{id_organisasi}/{tipe}/{id}', [
        'as'        => 'area.delete',
        'uses'      => 'AreaController@delete'
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

    Route::post('/input_gardu', [
        'as'        => 'area.create',
        'uses'      => 'AreaController@create'
    ]);

    Route::post('/edit_datamaster', [
        'as'        => 'area.edit_datamaster',
        'uses'      => 'AreaController@edit_datamaster'
    ]);

    Route::get('/hapus_datamaster/{id_organisasi}/{tipe}/{id}', [
        'as'        => 'area.hapus_datamaster',
        'uses'      => 'AreaController@hapus_datamaster'
    ]);

    Route::get('/list_datamaster_gi/{id_organisasi}/{id_gardu_induk}', [
        'as'        => 'area.lihat_gi',
        'uses'      => 'AreaController@lihat_gi'
        ]);

    Route::get('/list_datamaster_trafo_gi/{id_organisasi}/{id_trafo_gi}', [
        'as'        => 'area.lihat_trafo_gi',
        'uses'      => 'AreaController@lihat_trafo_gi'
    ]);

    Route::get('/list_datamaster_penyulang/{id_organisasi}/{id_penyulang}', [
        'as'        => 'area.lihat_penyulang',
        'uses'      => 'AreaController@lihat_penyulang'
    ]);

    Route::get('/list_datamaster_gardu/{id_organisasi}/{id_gardu}', [
        'as'        => 'area.lihat_gardu',
        'uses'      => 'AreaController@lihat_gardu'
    ]);

    Route::get('/list_datamaster_gardu_distribusi/{id_organisasi}/{id_trafo}', [
        'as'        => 'area.trafo_gi',
        'uses'      => 'AreaController@lihat_trafo_gi'
    ]);


    Route::get('/list_datamaster_rayon/{id_organisasi}', [
//        'as'        => 'area.list_gardu_induk',
//        'uses'      => 'AreaController@list_gardu_induk'
        'as'        => 'area.list_datamaster',
        'uses'      => 'AreaController@list_datamaster'
    ]);

    Route::get('/list_datamaster_list_trafo_gi/{id_organisasi}/{id_gardu_induk}', [
        'as'        => 'area.list_trafo_gi',
        'uses'      => 'AreaController@list_trafo_gi'
    ]);

    Route::get('/list_datamaster_list_trafo_gi_transfer/{id_organisasi}/{id_gi}', [
        'as'        => 'area.list_trafo_gi_transfer',
        'uses'      => 'AreaController@list_trafo_gi_transfer'
    ]);

    Route::get('/list_datamaster_list_penyulang/{id_organisasi}/{id_trafo_gi}', [
        'as'        => 'area.list_penyulang',
        'uses'      => 'AreaController@list_penyulang'
    ]);

    Route::get('/list_datamaster_list_penyulang_transfer/{id_organisasi}/{id_trafo_gi}', [
        'as'        => 'area.list_penyulang_transfer',
        'uses'      => 'AreaController@list_penyulang_transfer'
    ]);

    Route::get('/tabel_master', [
        'as'        => 'area.tabel_master',
        'uses'      => 'AreaController@tabel_master'
    ]);

    Route::get('/laporan_master', [
        'as'        => 'area.laporan_master',
        'uses'      => 'AreaController@list_master_rayon'
    ]);

    Route::get('/laporan_master_list_gi/{id_organisasi}', [
        'as'        => 'area.list_master_gi',
        'uses'      => 'AreaController@list_master_gi'
    ]);

    Route::get('/laporan_master_list/{id_organisasi}/{tipe}/{id}', [
        'as'        => 'area.list_master',
        'uses'      => 'AreaController@list_master'
    ]);

    Route::get('/view_datamaster/{id_organisasi}/{unit}/{id_unit}', [
        'as'        => 'area.view_datamaster',
        'uses'      => 'AreaController@view_datamaster'
    ]);
});

//distribusi
Route::group(['middleware' => 'auth', 'prefix' => 'distribusi'], function () {

    Route::get('/', [
        'as'        => 'distribusi.index',
        'uses'      => 'DistribusiController@list_area'
    ]);

    Route::get('/list_rayon/{id_organisasi}', [
        'as'        => 'distribusi.list_rayon',
        'uses'      => 'DistribusiController@list_rayon'
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

    Route::post('/import_organisasi', 'AdminController@importOrganisasi');
});