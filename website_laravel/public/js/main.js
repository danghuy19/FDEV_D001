$(() => {
    $('.btn_mua_ngay').click((e) => {
        e.preventDefault();
        //console.log(e);
        id_sach = $(e.target).attr('data-id-sach');
        //console.log('nút mua ngay được click với id ' + id_sach);
        $.get('http://localhost:8000/add-gio-hang/' + id_sach)
            .done((data) => {
                //console.log(data);
                var gio_hang = JSON.parse(data);
                //console.log(gio_hang);

                var tong_so_luong = 0;
                for(var i = 0; i < gio_hang.length; i++){
                    tong_so_luong += gio_hang[i].so_luong;
                }
                //console.log(tong_so_luong);
                $('.number_item_cart').removeClass('hidden');
                $('.number_item_cart').html(tong_so_luong);
            })
            .fail(err => {
                console.log(err);
            });
    })
});

// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('e836754de27fb45a4173', {
  cluster: 'mt1'
});

var channel = pusher.subscribe('chat_support');
channel.bind('send_message', function(data) {
  //alert(JSON.stringify(data));
  var data_message = JSON.parse(data.message);

  if(data_message.id_room == sessionid){
    var html_item_chat = `
      <div class="item_chat">
      ${data_message.message}
      </div>
    `;

    $('.list_message_chat').append(html_item_chat);
  }
});