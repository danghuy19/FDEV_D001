<section class="panel">
    @csrf
    <header class="panel-heading">
        Chat support
    </header>
    <div class="panel-body">
        <div class="list_room_chat">

        </div>
    </div>
</section>
<script>
    var list_room = [];
    var cur_user = '{{session('user_info')->tai_khoan}}';

    function process_chat_message(id_room){
        if($('#room_' + id_room + ' .message_chat').val()){
                //console.log(123);
                var token = $('input[name="_token"]').val();
                var data_mess = {
                    message: $('#room_' + id_room + ' .message_chat').val(),
                    id_room: id_room,
                    id_user: cur_user
                };

                var data_string = JSON.stringify(data_mess);
                $.post('/message', {
                    message: data_string,
                    _token: token
                })
                    .then((response) => {
                        //console.log(response);
                    });
            }
    }

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('e836754de27fb45a4173', {
        cluster: 'mt1'
    });

    var channel = pusher.subscribe('chat_support');
    channel.bind('send_message', function(data) {
        //alert(JSON.stringify(data));
        
        // var html_item_chat = `
        //     <div class="item_chat">
        //     ${data.message}
        //     </div>
        // `;

        data_mess = JSON.parse(data.message);
        //console.log(data_mess);

        if(list_room.includes(data_mess.id_room)){
            var id_room_receive = data_mess.id_room;

            var class_item_chat = '';

            if(data_mess.id_user == cur_user){
                class_item_chat = 'your_self';
            }

            $(`#room_${data_mess.id_room} .list_message_chat`).append(`<div class="item_chat ${class_item_chat}">${data_mess.message}</div>`);
        }
        else {
            list_room.push(data_mess.id_room);

            var html = `<div class="col-xs-6 col-md-4 item_room_chat" id="room_${data_mess.id_room}">
                    <div class="col-xs-12 container_item_room_chat">
                        <div class="container_message">
                            <div class="title_room">Phòng chat ${data_mess.id_room}</div>
                            <div class="list_message_chat">
                                <div class="item_chat">${data_mess.message}</div>    
                            </div>
                        </div>
                        <div class="form_chat">
                            <div class="include_input_chat">
                                <input type="text" class="message_chat">
                            </div>
                            <div class="button_chat" onclick="process_chat_message('${data_mess.id_room}')">
                                Gửi tin nhắn
                            </div>
                        </div>
                    </div>
                </div>`

            $('.list_room_chat').append(html);
        }

        // $('.list_message_chat').append(html_item_chat);
    });

    channel.bind('close_popup_admin', function(data) {
        console.log('process close popup message')
        data_mess = JSON.parse(data.message);
        console.log(data_mess);
        $('.list_room_chat #room_' + data_mess.id_room).remove();
    });


</script>