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

Route::get('/danh-sach-san-pham', function(){
    $user_id = Session::get('user_id');
    $cau_chao = '<div><b>Xin chào các bạn</b></div>';
    $cau_chao_status = 'failed';
    $ds_san_pham = json_decode(file_get_contents(storage_path() . "/test_data.json"));
    //$ds_san_pham = json_decode($ds_san_pham);
    return view('danh_sach_san_pham')
        ->with('cau_chao_test', $cau_chao)
        ->with('cau_chao_status', $cau_chao_status)
        ->with('ds_san_pham', $ds_san_pham)
        ->with('user_id', $user_id);
    // return 'test info';
});

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



//Route::controller('/test-route-controller', 'App\Http\Controllers\test_controller');
//remove from laravel higher than version 5