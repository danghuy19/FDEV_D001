<div class="container_chat inactive">
    @csrf
    <div class="title_form_chat">
        <div class="title">
            Liên hệ với chúng tôi
        </div>
        <div class="btn_close btn-danger btn">
            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
        </div>
    </div>
    <div class="container_message">
        <div class="list_message_chat"></div>
    </div>
    <div class="form_chat">
        <div class="include_input_chat">
            <input type="text" id="message_chat">
        </div>
        <div class="button_chat btn btn-primary">
            Gửi tin nhắn
        </div>
    </div>
</div>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var cur_user = 'anonymous_' + sessionid;

    var pusher = new Pusher('e836754de27fb45a4173', {
    cluster: 'mt1'
    });

    var channel = pusher.subscribe('chat_support');
    channel.bind('send_message', function(data) {
    //alert(JSON.stringify(data));
    var data_message = JSON.parse(data.message);

    if(data_message.id_room == sessionid){
        var class_item_chat = '';

        if(data_message.id_user == cur_user){
            class_item_chat = 'your_self';
        }

        var html_item_chat = `
        <div class="item_chat ${class_item_chat}">
        ${data_message.message}
        </div>
        `;

        $('.list_message_chat').append(html_item_chat);
    }
    });

    $(() => {
        var an_hien_form = 0;

        $('.button_chat').click(() => {
            if($('#message_chat').val()){
                //console.log(123);
                var token = $('input[name="_token"]').val();
                var data_mess = {
                    message: $('#message_chat').val(),
                    id_room: sessionid,
                    id_user: cur_user
                };

                var data_string = JSON.stringify(data_mess);
                $.post('/message', {
                    message: data_string,
                    _token: token
                })
                    .then((response) => {
                        $('#message_chat').val('');
                        //console.log(response);
                    });
            }
            
        })

        $('#message_chat').on('keypress', (e) => {
            if(e.keyCode == 13){
                if($('#message_chat').val()){
                    //console.log(123);
                    var token = $('input[name="_token"]').val();
                    var data_mess = {
                        message: $('#message_chat').val(),
                        id_room: sessionid,
                        id_user: cur_user
                    };

                    var data_string = JSON.stringify(data_mess);
                    $.post('/message', {
                        message: data_string,
                        _token: token
                    })
                        .then((response) => {
                            $('#message_chat').val('');
                            //console.log(response);
                        });
                }
            }
        })

        $('.title_form_chat').click(() => {
            //console.log('click');
            if(an_hien_form == 0){
                an_hien_form = 1;
                $('.container_chat').removeClass('inactive');
                $('.container_chat').addClass('active');
            }
            else {
                an_hien_form = 0;
                $('.container_chat').removeClass('active');
                $('.container_chat').addClass('inactive');
            }
        })
    })

    window.onbeforeunload = function (event) {
        //event.prevenDefault();

        var token = $('input[name="_token"]').val();
        var data_mess = {
            message: 'delete popup chat admin support',
            id_room: sessionid
        };

        var data_string = JSON.stringify(data_mess);

        $.post('/message-turn-off', {
            message: data_string,
            _token: token
        })
            .then((response) => {
                console.log(response);
                window.close();
            });

        return kq;
    };
</script>