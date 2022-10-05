<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SachController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::resource('sach', SachController::class);

Route::apiResources([
    'sach' => SachController::class,
    'users' => UserController::class
]);

Route::post('/binh-luan', function(Request $request){
    //echo 123;
    $id_sach = $request->get('id_sach');
    $id_nguoi_dung = $request->get('id_nguoi_dung');
    $noi_dung = $request->get('noi_dung');
    $id_binh_luan_cha = 0;
    $ngay_binh_luan = date('Y-m-d H:i:s');

    if($id_nguoi_dung){
        //do nothing here
    }
    else {
        return response()->json(['message' => "you don't have permission"], 400);
    }

    

    $id_binh_luan = DB::table('bs_binh_luan')
    ->insertGetId([
        'id_sach' => $id_sach,
        'id_nguoi_dung' => $id_nguoi_dung,
        'noi_dung' => $noi_dung,
        'id_binh_luan_cha' => $id_binh_luan_cha,
        'ngay_binh_luan' => $ngay_binh_luan,
        'trang_thai' => 1	
    ]);

    $info_binh_luan_moi = DB::table('bs_binh_luan')
    ->where('id', $id_binh_luan)
    ->first();

    //echo '<pre>',print_r($info_binh_luan_moi),'</pre>';
    return response()->json(['binh_luan_info' => $info_binh_luan_moi], 200);
});