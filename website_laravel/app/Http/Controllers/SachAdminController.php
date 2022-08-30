<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Exception;

class SachAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //echo '123';
        $ds_sach = DB::table('bs_sach')
        ->select(DB::raw('bs_sach.*, ten_tac_gia, ten_nha_xuat_ban'))
        ->join('bs_tac_gia', 'bs_sach.id_tac_gia', '=', 'bs_tac_gia.id')
        ->join('bs_nha_xuat_ban', 'bs_sach.id_nha_xuat_ban', '=', 'bs_nha_xuat_ban.id')
        ->get();
        //echo '<pre>',print_r($ds_sach),'</pre>';
        return view('page_admin.trang_ds_sach')->with('ds_sach', $ds_sach);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $ds_tac_gia = DB::table('bs_tac_gia')->get();
        $ds_nxb = DB::table('bs_nha_xuat_ban')->get();

        return view('page_admin.trang_them_sach')
                    ->with('ds_tac_gia', $ds_tac_gia)
                    ->with('ds_nxb', $ds_nxb);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sku = $request->get('sku');
        $id_loai_sach = $request->get('id_loai_sach');
        $doc_thu = $request->get('doc_thu');
        $so_trang = $request->get('so_trang');
        $id_tac_gia = $request->get('id_tac_gia');
        $id_nha_xuat_ban = $request->get('id_nha_xuat_ban');
        $ngay_xuat_ban = $request->get('ngay_xuat_ban');
        $trong_luong = $request->get('trong_luong');
        $kich_thuoc = $request->get('kich_thuoc');
        $gia_bia = $request->get('gia_bia');
        $don_gia = $request->get('don_gia');
        $trang_thai = $request->get('trang_thai');
        $noi_bat = $request->get('noi_bat');
        $gioi_thieu = $request->get('editor1');

        $hinh_sach = $request->file('hinh_sach');
        //echo "<pre>",print_r($hinh_sach),"</pre>";

        $cur_time = time();

        $name_file = $hinh_sach->getClientOriginalName();
        $arr_name_file = explode('.', $name_file);

        $public_path = public_path();
        $hinh = $arr_name_file[0] . '_' . $cur_time . '.' . $arr_name_file[count($arr_name_file) - 1];
        if($hinh_sach->isValid()){
            $hinh_sach->move($public_path . '/images/sach', $hinh);
        }

        $id_sach_moi = DB::table('bs_sach')
        ->insertGetId([
            'sku' => $sku,
            'id_loai_sach' => $id_loai_sach,
            'doc_thu' => $doc_thu,
            'so_trang' => $so_trang,
            'id_tac_gia' => $id_tac_gia,
            'id_nha_xuat_ban' => $id_nha_xuat_ban,
            'ngay_xuat_ban' => $ngay_xuat_ban,
            'trong_luong' => $trong_luong,
            'kich_thuoc' => $kich_thuoc,
            'gia_bia' => $gia_bia,
            'don_gia' => $don_gia,
            'trang_thai' => $trang_thai,
            'noi_bat' => $noi_bat,
            'gioi_thieu' => $gioi_thieu,
            'hinh' => $hinh
        ]);

        return redirect('/admin/ql-sach/create')->with('NoticeSuccess', 'Thêm sách mới thành công');
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
        //echo $id;
        $ds_tac_gia = DB::table('bs_tac_gia')->get();
        $ds_nxb = DB::table('bs_nha_xuat_ban')->get();

        $thong_tin_sach = DB::table('bs_sach')->where('id', $id)->first();

        return view('page_admin.trang_them_sach')
                    ->with('ds_tac_gia', $ds_tac_gia)
                    ->with('ds_nxb', $ds_nxb)
                    ->with('thong_tin_sach', $thong_tin_sach);
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
        $sku = $request->get('sku');
        $id_loai_sach = $request->get('id_loai_sach');
        $doc_thu = $request->get('doc_thu');
        $so_trang = $request->get('so_trang');
        $id_tac_gia = $request->get('id_tac_gia');
        $id_nha_xuat_ban = $request->get('id_nha_xuat_ban');
        $ngay_xuat_ban = $request->get('ngay_xuat_ban');
        $trong_luong = $request->get('trong_luong');
        $kich_thuoc = $request->get('kich_thuoc');
        $gia_bia = $request->get('gia_bia');
        $don_gia = $request->get('don_gia');
        $trang_thai = $request->get('trang_thai');
        $noi_bat = $request->get('noi_bat');
        $gioi_thieu = $request->get('editor1');

        $hinh = $request->get('hinh');

        if($request->hasFile('hinh_sach')){
            $hinh_sach = $request->file('hinh_sach');

            $cur_time = time();

            $name_file = $hinh_sach->getClientOriginalName();
            $arr_name_file = explode('.', $name_file);

            $public_path = public_path();
            $hinh = $arr_name_file[0] . '_' . $cur_time . '.' . $arr_name_file[count($arr_name_file) - 1];
            if($hinh_sach->isValid()){
                $hinh_sach->move($public_path . '/images/sach', $hinh);
            }
        }

        $result = DB::table('bs_sach')
        ->where('id', $id)
        ->update([
            'sku' => $sku,
            'id_loai_sach' => $id_loai_sach,
            'doc_thu' => $doc_thu,
            'so_trang' => $so_trang,
            'id_tac_gia' => $id_tac_gia,
            'id_nha_xuat_ban' => $id_nha_xuat_ban,
            'ngay_xuat_ban' => $ngay_xuat_ban,
            'trong_luong' => $trong_luong,
            'kich_thuoc' => $kich_thuoc,
            'gia_bia' => $gia_bia,
            'don_gia' => $don_gia,
            'trang_thai' => $trang_thai,
            'noi_bat' => $noi_bat,
            'gioi_thieu' => $gioi_thieu,
            'hinh' => $hinh
        ]);

        return redirect('/admin/ql-sach/edit/' . $id)->with('NoticeSuccess', 'Cập nhật sách thành công');
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
        try {
            DB::table('bs_sach')->where('id', $id)->delete();
            return redirect($_SERVER['HTTP_REFERER'])->withErrors('Xoá thành công sách có ID: ' . $id, 'NoticeDelete');
        }
        catch(Exception $e){
            return redirect($_SERVER['HTTP_REFERER'])->withErrors('Xoá sách bị lỗi: ' . $e, 'NoticeDelete');
        }
    }
}
