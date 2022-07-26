<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NormalPageController extends Controller
{
    //
    function index(){
        $user_info = Session::get('user_info');
        return view('trang_chu')
            ->with('user_info', $user_info);
    }

    function logout(Request $request){
        Session::forget('user_info');

        return redirect($request->server('HTTP_REFERER'), 302);
    }
}
