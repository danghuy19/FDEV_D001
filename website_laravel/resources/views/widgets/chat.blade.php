<div class="container_chat">
    @csrf
    <div class="container_message">
        <div class="list_message_chat"></div>
    </div>
    <div class="form_chat">
        <div class="include_input_chat">
            <input type="text" id="message_chat">
        </div>
        <div class="button_chat">
            Gửi tin nhắn
        </div>
    </div>
</div>
<script>
    $(() => {
        $('.button_chat').click(() => {
            if($('#message_chat').val()){
                //console.log(123);
                var token = $('input[name="_token"]').val();
                var data_mess = {
                    message: $('#message_chat').val(),
                    id_room: sessionid
                };

                var data_string = JSON.stringify(data_mess);
                $.post('/message', {
                    message: data_string,
                    _token: token
                })
                    .then((response) => {
                        console.log(response);
                    });
            }
            
        })
    })
</script>