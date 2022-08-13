<div class="table-responsive">
    @if(count($gio_hang) > 0)
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
                @foreach($gio_hang as $sp_gio_hang)
                <tr id="san_pham_{{$sp_gio_hang->id}}">
                    <td> {{$sp_gio_hang->sku}} </td>
                    <td style="min-width: 100px;">
                        <a href="/sach/{{$sp_gio_hang->id}}">{{$sp_gio_hang->ten_sach}}</a>
                    </td>
                    <td id="don_gia_{{$sp_gio_hang->id}}">{{$sp_gio_hang->don_gia}}</td>
                    <td><input id="so_luong_{{$sp_gio_hang->id}}" onchange="thay_doi_so_luong_gio_hang({{$sp_gio_hang->id}})" type="number" name="so_luong[]" value="{{$sp_gio_hang->so_luong}}"></td>
                    <td class="thanh_tien" id="thanh_tien_{{$sp_gio_hang->id}}" style="text-align: right;">{{$sp_gio_hang->don_gia * $sp_gio_hang->so_luong}} ₫</td>
                </tr>
                @endforeach
                
                <tr class="tong_tien">
                    <td colspan="4" style="text-align: right;">Tổng cộng: </td>
                    <td id="tong_tien" style="text-align: right;">@convert_money($tong_tien) ₫</td>
                </tr>
                <tr>
                    <td colspan="5">
                        <div class="ds_nut_dieu_khien">
                            {{-- <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span>
                                Cập nhật</button> --}}
                            <a href="trang_gio_hang.php?task=huy_gio_hang">
                                <div class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Hủy giỏ
                                    hàng</div>
                            </a>
                            <a href="trang_thanh_toan.php">
                                <div class="btn btn-primary"><span class="glyphicon glyphicon-credit-card"></span> Thanh
                                    toán</div>
                            </a>
                        </div>
                    </td>
                </tr>
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
</div>
<script>
    function thay_doi_so_luong_gio_hang(id_sp){
        //console.log(id_sp);
        //console.log($('#so_luong_' + id_sp).val());
        var so_luong = $('#so_luong_' + id_sp).val();
        $.get('/update-gio-hang/' + id_sp + '?so_luong=' + so_luong)
            .done((data) => {
                //console.log(data);
                if(data){
                    $('#thanh_tien_' + id_sp).html( ($('#don_gia_' + id_sp).html() * 1 * so_luong) + ' đ')
                    var ds_thanh_tien = $('.thanh_tien');
                    //console.log(ds_thanh_tien);
                    var tong_tien = 0;
                    for(var i = 0; i < ds_thanh_tien.length; i++){
                        //console.log(parseInt($(ds_thanh_tien[i]).html()));
                        tong_tien += parseInt($(ds_thanh_tien[i]).html());
                    }
                    //console.log(tong_tien);
                    $('#tong_tien').html(tong_tien + ' đ');
                }
            })
            .fail((err) => {
                console.log(err);
            })
    }

    $(() => {

    })
</script>