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
                $('.number_item_cart').html(tong_so_luong);
            })
            .fail(err => {
                console.log(err);
            });
    })
});