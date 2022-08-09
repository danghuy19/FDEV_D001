<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::get('/', 'App\Http\Controllers\NormalPageController@index');

Route::get('/logout', 'App\Http\Controllers\NormalPageController@logout');

Route::get('/danh-sach-san-pham', 'App\Http\Controllers\SachController@index');

Route::get('/sach-theo-loai/{id_loai_sach}', 'App\Http\Controllers\SachController@sach_theo_loai');

Route::get('/sach/{id_sach}', 'App\Http\Controllers\SachController@show');


Route::get('/search', [
    'as' => 'search_page',
    'uses' => 'App\Http\Controllers\SachController@search_page'
]);

Route::get('/call-controller', 'App\Http\Controllers\test_controller@test_run');


Route::get('/call-controller-2', [
    'as' => 'call-test-2',
    'uses' => 'App\Http\Controllers\test_controller@test_run_2'
]);

Route::match(['GET', 'POST', 'PUT', 'DELETE'], '/test-match', 'App\Http\Controllers\test_controller@test_run_3');

Route::any('/call-by-all-method', function(){
    return 'test xem sao với route any';
});

Route::get('/dang-ky', 'App\Http\Controllers\UserController@createNewAccount');

Route::post('/dang-ky', [
    'as' => 'savecreatenewaccount',
    'uses' => 'App\Http\Controllers\UserController@store'
]);

Route::post('/dang-nhap', [
    'as' => 'loginaccount',
    'uses' => 'App\Http\Controllers\UserController@login'
]);

Route::get('/them-sach', 'App\Http\Controllers\SachController@createNewSach');

Route::post('/save-sach', [
    'as' => 'savecreatesach',
    'uses' => 'App\Http\Controllers\SachController@store'
]);

Route::get('/add-gio-hang/{id_sach}', "App\Http\Controllers\SachController@add_gio_hang");



//Route::controller('/test-route-controller', 'App\Http\Controllers\test_controller');
//remove from laravel higher than version 5