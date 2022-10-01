<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    //
    public function save_message(Request $request){
        //require __DIR__ . '/vendor/autoload.php';

        $message = $request->get('message');
        //echo $message;
        $options = array(
            'cluster' => 'mt1',
            'useTLS' => false
        );
    
        $pusher = new \Pusher\Pusher(
            'e836754de27fb45a4173',
            'aa9c27531fe9a73c107b',
            '233726',
            $options
        );
        
        $data['message'] = $message;
        $pusher->trigger('chat_support', 'send_message', $data);
    }

    public function index(){
        return view('page_admin.trang_chat_support');
    }

    public function message_turn_off(Request $request){

        //echo 123;
        $message = $request->get('message');
        //echo $message;
        $options = array(
            'cluster' => 'mt1',
            'useTLS' => false
        );
    
        $pusher = new \Pusher\Pusher(
            'e836754de27fb45a4173',
            'aa9c27531fe9a73c107b',
            '233726',
            $options
        );
        
        $data['message'] = $message;
        $pusher->trigger('chat_support', 'close_popup_admin', $data);
    }
}
