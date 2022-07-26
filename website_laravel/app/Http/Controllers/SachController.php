<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        return 'index function';
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
}
