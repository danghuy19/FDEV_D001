<?php

use Illuminate\Support\Facades\Route;

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
    return view('trang_chu');
});

Route::get('/danh-sach-san-pham', function(){
    return view('danh_sach_san_pham');
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


//Route::controller('/test-route-controller', 'App\Http\Controllers\test_controller');
//remove from laravel higher than version 5