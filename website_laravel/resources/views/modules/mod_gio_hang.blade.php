<div class="table-responsive include_table_cart">
    @if(session()->has('gio_hang'))
        @if(count(session('gio_hang')) > 0)
        <form action="" method="post" name="form_gio_hang">
            <table class="table table-hover gio_hang">
                <thead>
                    <tr>
                        <th>Mã sách</th>
                        <th>Tên sách</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(session('gio_hang') as $sp_gio_hang)
                    <tr id="san_pham_{{$sp_gio_hang->id}}">
                        <td> {{$sp_gio_hang->sku}} </td>
                        <td style="min-width: 100px;">
                            <a href="/sach/{{$sp_gio_hang->id}}">{{$sp_gio_hang->ten_sach}}</a>
                        </td>
                        <td id="don_gia_{{$sp_gio_hang->id}}">{{$sp_gio_hang->don_gia}}</td>
                        <td>
                            @if($allow_update_cart)
                            <input class="so_luong_input" id="so_luong_{{$sp_gio_hang->id}}" onchange="thay_doi_so_luong_gio_hang({{$sp_gio_hang->id}})" type="number" name="so_luong[]" value="{{$sp_gio_hang->so_luong}}">
                            @else
                            {{$sp_gio_hang->so_luong}}
                            @endif
                        </td>
                        <td class="thanh_tien" id="thanh_tien_{{$sp_gio_hang->id}}" style="text-align: right;">{{$sp_gio_hang->don_gia * $sp_gio_hang->so_luong}} ₫</td>
                    </tr>
                    @endforeach
                    
                    <tr class="tong_tien">
                        <td colspan="4" style="text-align: right;">Tổng cộng: </td>
                        <td id="tong_tien" style="text-align: right;">@convert_money(session('tong_tien')) ₫</td>
                    </tr>

                    @if($allow_update_cart)
                    <tr>
                        <td colspan="5">
                            <div class="ds_nut_dieu_khien">
                                {{-- <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span>
                                    Cập nhật</button> --}}
                                <a onclick='xoa_gio_hang(event)'>
                                    <div class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Hủy giỏ
                                        hàng</div>
                                </a>
                                <a href="/thanh-toan">
                                    <div class="btn btn-primary"><span class="glyphicon glyphicon-credit-card"></span> Thanh
                                        toán</div>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </form>
        @else
        <div class="container">
            <div class="notice">
                Không có sản phẩm nào trong giỏ hàng
            </div>
        </div>
        @endif
    @endif
</div>
<script>
    function xoa_gio_hang(e){
        e.preventDefault();
        //console.log(123);
        var kq = confirm('bạn có chắc chắn muốn xoá toàn bộ giỏ hàng không?');
        if(kq){

            $.get('/xoa-gio-hang')
            .done((data) => {
                //console.log(data);
                if(data){
                    $('.number_item_cart').remove();
                    $('.include_table_cart').html(`<div class="container">
                        <div class="notice">
                            Không có sản phẩm nào trong giỏ hàng
                        </div>
                    </div>`);
                }
            })
            .fail((err) => {
                console.log(err);
            })

            
        } else {
            //do nothing
        }
    }


    function process_gio_hang_client(id_sp, so_luong){
        $('#thanh_tien_' + id_sp).html( ($('#don_gia_' + id_sp).html() * 1 * so_luong) + ' đ')
        var ds_thanh_tien = $('.thanh_tien');
        var ds_so_luong = $('.so_luong_input');
        //console.log(ds_thanh_tien);
        var tong_tien = 0;
        var tong_so_luong = 0;
        for(var i = 0; i < ds_thanh_tien.length; i++){
            //console.log(parseInt($(ds_thanh_tien[i]).html()));
            tong_tien += parseInt($(ds_thanh_tien[i]).html());
            tong_so_luong += parseInt($(ds_so_luong[i]).val());
        }
        //console.log(tong_tien);
        $('#tong_tien').html(tong_tien + ' đ');
        $('.number_item_cart').html(tong_so_luong);
    }

    function thay_doi_so_luong_gio_hang(id_sp){
        //console.log(id_sp);
        //console.log($('#so_luong_' + id_sp).val());
        var so_luong = $('#so_luong_' + id_sp).val();
        if(so_luong > 0){
            $.get('/update-gio-hang/' + id_sp + '?so_luong=' + so_luong)
            .done((data) => {
                //console.log(data);
                if(data){
                    process_gio_hang_client(id_sp, so_luong);
                }
            })
            .fail((err) => {
                console.log(err);
            })
        }
        else {
            var kq = confirm('bạn có muốn xoá sách có id ' + id_sp + ' khỏi giỏ hàng không?');
            if(kq){
                $.get('/xoa-item-gio-hang/' + id_sp)
                .done((data) => {
                    //console.log(data);
                    if(data){
                        $('#san_pham_' + id_sp).remove();
                        process_gio_hang_client(id_sp, 0);
                    }
                })
                .fail((err) => {
                    console.log(err);
                })
            }
            else{
                $.get('/update-gio-hang/' + id_sp + '?so_luong=' + 1)
                .done((data) => {
                    //console.log(data);
                    if(data){
                        $('#so_luong_' + id_sp).val(1);
                        process_gio_hang_client(id_sp, 1);
                    }
                })
                .fail((err) => {
                    console.log(err);
                })
            }
        }
    }

    $(() => {

    })
</script>