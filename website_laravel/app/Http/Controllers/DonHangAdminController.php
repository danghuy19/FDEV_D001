<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class DonHangAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cur_page = 0;
        if(isset($_GET['page'])){
            $cur_page = $_GET['page'];
        }

        $index_lay_don_hang = $cur_page * 10;
        $ds_don_hang = DB::table('bs_don_hang')->orderBy('id', 'DESC')->skip($index_lay_don_hang)->limit(10)->get();
        $tong_so_luong = DB::table('bs_don_hang')->select(DB::raw('COUNT(*) as tong_so_luong'))->first();
        //echo '<pre>',print_r($tong_so_luong),'</pre>';
        $so_trang = ceil($tong_so_luong->tong_so_luong / 10);
        return view('page_admin.trang_ds_don_hang')
            ->with('ds_don_hang', $ds_don_hang)
            ->with('so_trang', $so_trang)
            ->with('cur_page', $cur_page);
    }

    function pagination($current_page){
        $index_lay_don_hang = $current_page * 10;
        $ds_don_hang = DB::table('bs_don_hang')->orderBy('id', 'DESC')->skip($index_lay_don_hang)->limit(10)->get();
        $tong_so_luong = DB::table('bs_don_hang')->select(DB::raw('COUNT(*) as tong_so_luong'))->first();

        $so_trang = ceil($tong_so_luong->tong_so_luong / 10);

        return response()->json([
            'ds_don_hang' => $ds_don_hang,
            'so_trang' => $so_trang
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $array_trang_thai = [
            0 => 'Đã huỷ',
            1 => 'Giao thành công',
            2 => 'Đang chờ duyệt',
            3 => 'Đã duyệt'
        ];

        $thong_tin_don_hang = DB::table('bs_don_hang')->where('id', $id)->first();
        return view('page_admin.trang_cap_nhat_don_hang')
                ->with('array_trang_thai', $array_trang_thai)
                ->with('thong_tin_don_hang', $thong_tin_don_hang);
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
        $array_trang_thai = [
            0 => 'Đã huỷ',
            1 => 'Giao thành công',
            2 => 'Đang chờ duyệt',
            3 => 'Đã duyệt'
        ];

        $thong_tin_don_hang_old = DB::table('bs_don_hang')->where('id', $id)->first();

        $trang_thai = $request->get('trang_thai');

        DB::table('bs_don_hang')
        ->where('id', $id)
        ->update([
            'trang_thai' => $trang_thai
        ]);

        DB::table('notice')
        ->insert([
            'id_don_hang' => $thong_tin_don_hang_old->id,
            'trang_thai_old' => $thong_tin_don_hang_old->trang_thai,
            'trang_thai_new' => $trang_thai,
            'email' => $thong_tin_don_hang_old->email_nguoi_nhan
        ]);

        $thong_tin_don_hang = DB::table('bs_don_hang')->where('id', $id)->first();

        return view('page_admin.trang_cap_nhat_don_hang')
                ->with('array_trang_thai', $array_trang_thai)
                ->with('thong_tin_don_hang', $thong_tin_don_hang)
                ->with('NoticeSuccess', 'Cập nhật đơn hàng thành công');
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
    }

    public function api_notice($email){
        //echo $email;
        $array_trang_thai = [
            0 => 'Đã huỷ',
            1 => 'Giao thành công',
            2 => 'Đang chờ duyệt',
            3 => 'Đã duyệt'
        ];

        $notice = DB::table('notice')
        ->where('email', $email)
        ->first();

        if($notice){
            DB::table('notice')->where('id', $notice->id)->delete();
            $message = 'Đơn hàng ' . $notice->id . ' của bạn trạng thái được chuyển từ ' . $array_trang_thai[$notice->trang_thai_old] . ' sang ' . $array_trang_thai[$notice->trang_thai_new];
            return response()->json(['status' => 'success', 'message' => $message]);
        }
        else {
            return response()->json(['status' => 'success']);
        }
    }
}
