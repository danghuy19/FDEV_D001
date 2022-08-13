<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class NormalPageController extends Controller
{
    //
    function index(){
        $user_info = Session::get('user_info');

        $noi_bat = '1';
        $list_sach_noi_bat = DB::select('SELECT s.*, ten_tac_gia
        FROM bs_sach s JOIN bs_tac_gia tg ON s.id_tac_gia = tg.id
        WHERE noi_bat = ?', [$noi_bat]);

        return view('trang_chu')
            ->with('user_info', $user_info)
            ->with('list_sach_noi_bat', $list_sach_noi_bat);
    }

    function logout(Request $request){
        Session::forget('user_info');

        return redirect($request->server('HTTP_REFERER'), 302);
    }

    function gio_hang(){
        $gio_hang = [];
        if(Session::has('gio_hang')){
            $gio_hang = Session::get('gio_hang');
        }

        $tong_tien = 0;
        foreach($gio_hang as $sp){
            $tong_tien += $sp->so_luong * $sp->don_gia;
        }

        return view('trang_gio_hang')
        ->with('gio_hang', $gio_hang)
        ->with('tong_tien', $tong_tien);
    }
}
