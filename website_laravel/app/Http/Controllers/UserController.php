<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Form;
use App\Http\Requests\CreateUserRequest;

class UserController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        //
        //return 'store function';

        $files_hinh = $request->file('avatar');
        //echo "<pre>",print_r($files_hinh),"</pre>";
        $cur_time = time();
        $name_file = $request->file('avatar')->getClientOriginalName();
        $arr_name_file = explode('.', $name_file);


        $public_path = public_path();
        if($request->file('avatar')->isValid()){
            $request->file('avatar')->move($public_path . '/images', $arr_name_file[0] . '_' . $cur_time . $arr_name_file[count($arr_name_file) - 1]);
        }

        return view('redirect_page')
            ->with('message_notice', 'Đăng ký thành công! Bạn sẽ nhận được email thông báo')
            ->with('type_notice', 'success')
            ->with('url_redirect', '/');
        //return redirect('/', 302);
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

    public function createNewAccount(){
        return view('trang_dang_ky');
    }
}
