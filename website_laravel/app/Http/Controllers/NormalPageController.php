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

        return view('trang_gio_hang')->with('allow_update_cart', true);
        //->with('gio_hang', $gio_hang)
        //->with('tong_tien', $tong_tien);
    }

    function thanh_toan(){
        return view('trang_thanh_toan')->with('allow_update_cart', false);
    }

    function thanh_toan_store(Request $request){
        $gio_hang = [];
        if(Session::has('gio_hang')){
            $gio_hang = Session::get('gio_hang');
        }

        if(count($gio_hang) > 0){
            $ho_ten = $request->get('ho_ten');
            $email = $request->get('email');
            $dien_thoai = $request->get('dien_thoai');
            $dia_chi = $request->get('dia_chi');
            $trang_thai = 2;
            $tong_tien = 0;
            $ngay_dat = date("Y-m-d H:i:s");

            $tong_tien = 0;
            foreach($gio_hang as $sp){
                $tong_tien += $sp->so_luong * $sp->don_gia;
            }
            //echo $ho_ten;

            DB::transaction(function () use ($ho_ten, $email, $dien_thoai, $dia_chi, $trang_thai, $tong_tien, $ngay_dat, $gio_hang) 
            { 
                //them don hang
                $id_don_hang = DB::table('bs_don_hang')
                ->insertGetId(
                    [
                        "ho_ten_nguoi_nhan" => $ho_ten,
                        "email_nguoi_nhan" => $email,
                        "so_dien_thoai_nguoi_nhan" => $dien_thoai,
                        "dia_chi_nguoi_nhan" => $dia_chi,
                        "trang_thai" => $trang_thai,
                        "tong_tien" => $tong_tien,
                        "ngay_dat" => $ngay_dat,
                    ]
                );

                usleep(10000);
                //add them chi tiet don hang
                foreach($gio_hang as $sp){
                    DB::table('bs_chi_tiet_don_hang')
                    ->insert(
                        [
                            "id_don_hang" => $id_don_hang,
                            "id_sach" => $sp->id,
                            "so_luong" => $sp->so_luong,
                            "don_gia" => $sp->don_gia,
                            "thanh_tien" => $sp->so_luong * $sp->don_gia,
                        ]
                    );
                }

            });

            Session::forget('gio_hang');
            Session::forget('tong_so_luong');
            Session::forget('tong_tien');

            return redirect('/')->withErrors(['Đặt Hàng thành công!'], 'noticeOrder');
        }
        else{
            return redirect('/', 302);
        }
        
    }
}
