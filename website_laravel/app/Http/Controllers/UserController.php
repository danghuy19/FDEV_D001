<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Form;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Session;

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

        //$files_hinh = $request->file('avatar');
        //echo "<pre>",print_r($files_hinh),"</pre>";
        $cur_time = time();
        $name_file = $request->file('avatar')->getClientOriginalName();
        $arr_name_file = explode('.', $name_file);

        $username = $request->input('username');
        $password = $request->input('password');
        $email = $request->input('email');
        $date_of_birth = $request->input('date_of_birth');


        $public_path = public_path();
        $image_name = $arr_name_file[0] . '_' . $cur_time . $arr_name_file[count($arr_name_file) - 1];
        if($request->file('avatar')->isValid()){
            $request->file('avatar')->move($public_path . '/images', $image_name);
        }

        $user_new = (object)[];
        $user_new->username = $username;
        $user_new->password = $password;
        $user_new->email = $email;
        $user_new->date_of_birth = $date_of_birth;
        $user_new->image_name = $image_name;

        $data_string_user = file_get_contents(resource_path('data_temp/users.json'));
        $list_user = json_decode($data_string_user);
        $list_user[] = $user_new;
        file_put_contents(resource_path('data_temp/users.json'), json_encode($list_user));

        Session::put('user_info', $user_new);

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
