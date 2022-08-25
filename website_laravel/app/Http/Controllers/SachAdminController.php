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
