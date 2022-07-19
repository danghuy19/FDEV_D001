<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class test_controller extends Controller
{
    //
    function test_run(){
        return 'đã chạy controller mới thành công';
    }

    function test_run_2(){
        return 'đã chạy controller theo mảng thành công';
    }

    function test_run_3(){
        return 'đã chạy Route match thành công';
    }

    // function getThuRouteController(){
    //     return 'thử route controller';
    // }

    // function postThuMethodController(){
    //     return 'thử route controller';
    // }
}
