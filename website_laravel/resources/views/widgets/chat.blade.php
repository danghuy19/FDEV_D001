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
            //console.log(123);
            var token = $('input[name="_token"]').val();
            var data_mess = $('#message_chat').val();
            $.post('/message', {
                message: data_mess,
                _token: token
            })
                .then((response) => {
                    console.log(response);
                });
        })
    })
</script>