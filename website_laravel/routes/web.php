<?php

use App\Http\Middleware\EnsureAdminRole;
use App\Http\Middleware\RuleSaveBook;
use App\Http\Middleware\LanguageRule;

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

Route::get('/update-gio-hang/{id_sach}', "App\Http\Controllers\SachController@update_gio_hang");

Route::get('/xoa-item-gio-hang/{id_sach}', "App\Http\Controllers\SachController@xoa_item_gio_hang");

Route::get('/xoa-gio-hang', "App\Http\Controllers\SachController@xoa_gio_hang");

Route::get('/gio-hang', "App\Http\Controllers\NormalPageController@gio_hang");

Route::get('/thanh-toan', "App\Http\Controllers\NormalPageController@thanh_toan");

Route::post('/thanh-toan', [
    "as" => "save_thanh_toan",
    "uses" => "App\Http\Controllers\NormalPageController@thanh_toan_store"
]);


Route::get('/tin-tuc', 'App\Http\Controllers\NormalPageController@tin_tuc');
Route::get('/tin-tuc/{language}', 'App\Http\Controllers\NormalPageController@tin_tuc_language')->middleware([LanguageRule::class]);

Route::get('/lien-he', 'App\Http\Controllers\NormalPageController@lien_he');

Route::post('/lien-he', 'App\Http\Controllers\NormalPageController@lien_he_store');

Route::get('/view-don-hang/{email}', 'App\Http\Controllers\NormalPageController@view_don_hang');

Route::get('/don-hang/{email}', 'App\Http\Controllers\NormalPageController@api_don_hang');

Route::get('/notice/{email}', 'App\Http\Controllers\DonHangAdminController@api_notice');
//Route::controller('/test-route-controller', 'App\Http\Controllers\test_controller');
//remove from laravel higher than version 5


/* Route admin */
Route::get('/admin', 'App\Http\Controllers\AdminController@index')->middleware(EnsureAdminRole::class);
Route::get('/analytics-doanh-thu/{nam}', 'App\Http\Controllers\AdminController@thong_ke')->middleware(EnsureAdminRole::class);

Route::get('/login-admin', 'App\Http\Controllers\AdminController@login_admin');

/* Route process manage Sach */
Route::get('/admin/ql-sach', 'App\Http\Controllers\SachAdminController@index')->middleware(EnsureAdminRole::class);
Route::get('/admin/sach/delete/{id}', 'App\Http\Controllers\SachAdminController@destroy')->middleware(EnsureAdminRole::class);

Route::get('/admin/ql-sach/create', 'App\Http\Controllers\SachAdminController@create')->middleware(EnsureAdminRole::class);
Route::post('/admin/ql-sach/create', 'App\Http\Controllers\SachAdminController@store')->middleware(EnsureAdminRole::class);

Route::get('/admin/ql-sach/edit/{id}', 'App\Http\Controllers\SachAdminController@edit')->middleware(EnsureAdminRole::class);
Route::post('/admin/ql-sach/edit/{id}', 'App\Http\Controllers\SachAdminController@update')->middleware([EnsureAdminRole::class, RuleSaveBook::class]);

Route::get('/admin/ql-don-hang', 'App\Http\Controllers\DonHangAdminController@index')->middleware(EnsureAdminRole::class);
Route::get('/admin/ql-don-hang/pagination/{current_page}', 'App\Http\Controllers\DonHangAdminController@pagination');

Route::get('/admin/ql-don-hang/edit/{id}', 'App\Http\Controllers\DonHangAdminController@edit')->middleware(EnsureAdminRole::class);
Route::post('/admin/ql-don-hang/edit/{id}', 'App\Http\Controllers\DonHangAdminController@update')->middleware([EnsureAdminRole::class]);

// generate data website url
Route::get('/generate-data/{table}', 'App\Http\Controllers\GenerateDataController@index')->middleware(EnsureAdminRole::class);


Route::get('/api/save-product-crawl', 'App\Http\Controllers\GenerateDataController@save_crawl');