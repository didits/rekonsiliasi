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

Route::get('/login', function () {
    return view('admin.nonmaster.dashboard_user.index');
});
Route::get('/profil', function () {
    return view('admin.nonmaster.dashboard_user.profile');
});
Route::get('/edit_profil', function () {
    return view('admin.nonmaster.dashboard_user.profile_edit');
});
Route::get('/input_data', function () {
    return view('admin.nonmaster.dashboard_user.index');
});
Route::get('/laporan', function () {
    return view('admin.nonmaster.laporan.index');
});