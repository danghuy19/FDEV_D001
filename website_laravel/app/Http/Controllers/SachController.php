<?php

namespace App\Http\Controllers;

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
    public function show($id)
    {
        //
        return 'show function';
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
}
