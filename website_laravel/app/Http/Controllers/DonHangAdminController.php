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
    }
}
