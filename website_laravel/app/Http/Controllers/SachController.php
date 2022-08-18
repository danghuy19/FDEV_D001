<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class SachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_id = Session::get('user_id');
        // $cau_chao = '<div><b>Xin chào các bạn</b></div>';
        // $cau_chao_status = 'failed';

        $ds_san_pham = DB::table('bs_sach')
            ->select('bs_sach.id', 'ten_sach', 'hinh', 'id_tac_gia', 'trong_luong', 'don_gia', 'gia_bia', 'ten_tac_gia')
            ->join('bs_tac_gia', 'bs_sach.id_tac_gia', '=', 'bs_tac_gia.id')
            ->where('don_gia','>=', 1000000)
            ->where('trong_luong', '>=', 500)
            ->orWhere('don_gia', '<=', 100000)
            ->get();
        //$ds_san_pham = json_decode(file_get_contents(storage_path() . "/test_data.json"));
        //$ds_san_pham = json_decode($ds_san_pham);
        return view('danh_sach_san_pham')
            // ->with('cau_chao_test', $cau_chao)
            // ->with('cau_chao_status', $cau_chao_status)
            ->with('ds_san_pham', $ds_san_pham)
            ->with('user_id', $user_id);
        // return 'test info';
    }

    public function sach_theo_loai($id_loai_sach){
        //echo $id_loai_sach;
        $user_id = Session::get('user_id');

        $ds_sach_theo_loai = DB::table('bs_sach')
            ->join('bs_tac_gia', 'bs_sach.id_tac_gia','=','bs_tac_gia.id')
            ->where('id_loai_sach','=', $id_loai_sach)
            ->get();

        //echo '<pre>',print_r($ds_sach_theo_loai),'</pre>';

        

        return view('danh_sach_san_pham')
        // ->with('cau_chao_test', $cau_chao)
        // ->with('cau_chao_status', $cau_chao_status)
        //->with('ds_loai_sach', $list_loai_sach)
        ->with('ds_san_pham', $ds_sach_theo_loai)
        ->with('user_id', $user_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return 'create function';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $files_hinh = $request->file('ds_hinh');
        //echo "<pre>",print_r($files_hinh),"</pre>";

        $cur_time = time();

        if(count($files_hinh) > 0){
            foreach($files_hinh as $hinh){
                //echo "<pre>",print_r($hinh),"</pre>";
                $name_file = $hinh->getClientOriginalName();
                $arr_name_file = explode('.', $name_file);

                $public_path = public_path();
                if($hinh->isValid()){
                    $hinh->move($public_path . '/images/sach_test', $arr_name_file[0] . '_' . $cur_time . $arr_name_file[count($arr_name_file) - 1]);
                }
            }
        }

        return 'store function successfull';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_sach)
    {
        //
        //return 'show function';
        //echo $id_sach;
        $thong_tin_sach = DB::table('bs_sach')
            ->select(DB::raw('bs_sach.*, ten_loai_sach, ten_tac_gia, ten_nha_xuat_ban'))
            ->join('bs_tac_gia', 'bs_sach.id_tac_gia','=','bs_tac_gia.id')
            ->join('bs_loai_sach', 'bs_sach.id_loai_sach','=','bs_loai_sach.id')
            ->join('bs_nha_xuat_ban', 'bs_sach.id_nha_xuat_ban','=','bs_nha_xuat_ban.id')
            ->where('bs_sach.id', $id_sach)
            ->first();
        
        //echo '<pre>',print_r($thong_tin_sach),'</pre>';
        $noi_dung_doc_thu = file_get_contents($thong_tin_sach->doc_thu);
        //echo $noi_dung_doc_thu .'<br/>';
        //echo $thong_tin_sach->doc_thu . '<br/>';
        $mang_duong_dan_doc_thu = explode("/", $thong_tin_sach->doc_thu);
        array_pop($mang_duong_dan_doc_thu);
        array_pop($mang_duong_dan_doc_thu);

        $duong_dan = '/'.implode("/", $mang_duong_dan_doc_thu);
        //echo $duong_dan;

        $noi_dung_doc_thu = str_replace("images/doc_thu/", $duong_dan."/", $noi_dung_doc_thu);
        //$noi_dung_doc_thu = str_replace("../", $duong_dan."/", $noi_dung_doc_thu);

        //echo $noi_dung_doc_thu;

        return view('trang_chi_tiet_sach')->with('thong_tin_sach', $thong_tin_sach)
            ->with('noi_dung_doc_thu', $noi_dung_doc_thu);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return 'edit function';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        return 'update function';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return 'destroy function';
    }

    public function createNewSach(){
        Session::put('user_id', '100');
        return view('them_sach');
    }

    public function search_page(){
        $user_id = Session::get('user_id');
        $keyword = $_GET['keyword'];

        $ds_sach_tim_kiem = DB::table('bs_sach')
        ->select(DB::raw('bs_sach.*, ten_tac_gia'))
        ->join('bs_tac_gia', 'bs_sach.id_tac_gia', '=', 'bs_tac_gia.id')
        ->where('ten_sach', 'like', "%$keyword%")
        ->orWhere('bs_sach.gioi_thieu', 'like', "%$keyword%")
        ->get();

        return view('danh_sach_san_pham')
                ->with('keyword', $keyword)
                ->with('ds_san_pham', $ds_sach_tim_kiem)
                ->with('user_id', $user_id);
    }

    public function add_gio_hang($id_sach){
        //echo $id_sach;
        $gio_hang = [];
        
        if(Session::has('gio_hang')){
            $gio_hang = Session::get('gio_hang');

            $flag = 0;
            for($i = 0; $i < count($gio_hang); $i++){
                if($gio_hang[$i]->id == $id_sach){
                    $gio_hang[$i]->so_luong += 1;
                    $flag = 1;
                    break;
                }
            }

            if($flag == 0){
                $thong_tin_sach = DB::table('bs_sach')->where('id', $id_sach)->first();
                $thong_tin_sach = json_decode(json_encode($thong_tin_sach));
                $thong_tin_sach->so_luong = 1;
                $gio_hang[] = $thong_tin_sach;
            }
        }
        else{
            $thong_tin_sach = DB::table('bs_sach')->where('id', $id_sach)->first();
            $thong_tin_sach = json_decode(json_encode($thong_tin_sach));
            $thong_tin_sach->so_luong = 1;
            $gio_hang[] = $thong_tin_sach;
        }

        $tong_so_luong = 0;
        $tong_tien = 0;
        for($i = 0; $i < count($gio_hang); $i++){
            $tong_so_luong += $gio_hang[$i]->so_luong;
            $tong_tien += $gio_hang[$i]->so_luong * $gio_hang[$i]->don_gia;
        }

        //echo '<pre>',print_r($gio_hang),'</pre>';
        Session::put('gio_hang', $gio_hang);
        Session::put('tong_so_luong', $tong_so_luong);
        Session::put('tong_tien', $tong_so_luong);
        echo json_encode($gio_hang);
    }

    function update_gio_hang($id_sach){
        try {
            $so_luong = $_GET['so_luong'];

            //echo $id_sach . ' - ' . $so_luong;
            if(Session::has('gio_hang')){
                $gio_hang = Session::get('gio_hang');

                $tong_tien = 0;
                $tong_so_luong = 0;
                foreach($gio_hang as $sp){
                    if($sp->id == $id_sach){
                        $sp->so_luong = $so_luong;
                    }
                    
                    $tong_so_luong += $sp->so_luong;
                    $tong_tien += $sp->so_luong * $sp->don_gia;
                }

                Session::put('gio_hang', $gio_hang);
                Session::put('tong_so_luong', $tong_so_luong);
                Session::put('tong_tien', $tong_tien);
            }

            echo '1';
        }
        catch(Exception $e){
            die(0);
        }
    }


    function xoa_item_gio_hang($id_sach){
        if(Session::has('gio_hang')){
            $gio_hang = Session::get('gio_hang');

            for($i = 0; $i < count($gio_hang); $i++){
                if($gio_hang[$i]->id == $id_sach){
                    array_splice($gio_hang, $i, 1);
                    break;
                }
            }


            $tong_so_luong = 0;
            $tong_tien = 0;
            foreach($gio_hang as $sp){
                $tong_so_luong += $sp->so_luong;
                $tong_tien += $sp->so_luong * $sp->don_gia;
            }

            Session::put('gio_hang', $gio_hang);
            Session::put('tong_so_luong', $tong_so_luong);
            Session::put('tong_tien', $tong_tien);
            //echo '<pre>',print_r($gio_hang),'</pre>';
            //array_splice($array, 0, 1);
            echo 1;
        }
    }

    function xoa_gio_hang(){
        if(Session::has('gio_hang')){
            Session::forget('gio_hang');
            Session::forget('tong_so_luong');
            Session::forget('tong_tien');
        }

        echo 1;
    }

}
