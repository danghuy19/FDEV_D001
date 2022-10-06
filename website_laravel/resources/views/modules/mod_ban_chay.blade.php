<!-- list sách bán chạy nhất -->
<section class="ds_sp_noi_bat container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="title_module">
                Sách bán chạy nhất
            </div>

            @if(isset($list_sach_ban_chay))
                @foreach($list_sach_ban_chay as $sach_ban_chay)
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 item_sp_noi_bat">
                        <a href="/sach/{{$sach_ban_chay->id}}">
                            <div class="hinh_sach">
                                <img src="images/sach/{{$sach_ban_chay->hinh}}">
                            </div>
                        </a>
                        <div class="thong_tin_tom_tat_sach">
                            <a href="/sach/{{$sach_ban_chay->id}}">
                                <div class="ten_sach">{{$sach_ban_chay->ten_sach}}</div>
                                <div class="tac_gia">{{$sach_ban_chay->ten_tac_gia}}</div>
                                <div class="don_gia_ban">{{$sach_ban_chay->don_gia}} ₫</div>
                                <div class="don_gia_bia">{{$sach_ban_chay->gia_bia}} ₫ </div>
                            </a>
                            <a href="them_vao_gio_hang.php?id_sach={{$sach_ban_chay->id}}">
                                <div class="btn_mua_ngay" data-id-sach="{{$sach_ban_chay->id}}">Mua Ngay</div>
                            </a>
                        </div>

                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section> <!-- END list sách bán chạy nhất -->