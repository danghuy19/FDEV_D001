<div class="container">
    <div class="container_list_don_hang">
        <div class="list_don_hang">
            {{-- @foreach($ds_don_hang as $don_hang)
            <div class="item_don_hang">
                <div class="title_don_hang">
                    Đơn Hàng: SD_{{$don_hang->id}}
                </div>
                <div class="info_don_hang">
                    <div class="list_san_pham_don_hang">
                        @foreach($don_hang->ds_item as $item_sp)
                        <div class="item_san_pham_don_hang">
                            <div class="image_item col-sm-2">
                                <img src="/images/sach/{{$item_sp->hinh}}" alt="">
                            </div>
                            <div class="ten_item col-sm-5">
                                {{$item_sp->ten_sach}}
                            </div>
                            <div class="so_luong col-sm-1">
                                {{$item_sp->so_luong}}
                            </div>
                            <div class="don_gia col-sm-2">
                                {{$item_sp->don_gia}}
                            </div>
                            <div class="thanh_tien col-sm-2">
                                {{$item_sp->thanh_tien}}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="tong_tien">
                        <div class="item_san_pham_don_hang">
                            <div class="image_item col-sm-2">
                            </div>
                            <div class="ten_item col-sm-5">
                            </div>
                            <div class="so_luong col-sm-1">
                            </div>
                            <div class="don_gia col-sm-2">
                            </div>
                            <div class="thanh_tien col-sm-2">
                                {{$don_hang->tong_tien}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach --}}
        </div>
        <div class="load_more_hidden" data-page='0'></div>
    </div>
</div>
<script>
    var email = 'hungnguyenxuan118@gmail.com';
    var flag = 0;

    $(() => {
        //console.log($('.load_more_hidden').attr('data-page'));

        $( window ).scroll(function() {
            //console.log($(this).scrollTop(), $('.load_more_hidden').offset().top, window.screen.height);
            if($(this).scrollTop() >= $('.load_more_hidden').offset().top - window.screen.height/2){
                //alert('load them item');
                if(flag == 0){
                    flag = 1;
                    var page = $('.load_more_hidden').attr('data-page');
                    $.get('/don-hang/' + email + '/?page=' + page)
                        .then((data) => {

                            $('.load_more_hidden').attr('data-page', page = page * 1 + 1);

                            //console.log(data);

                            var html_append = '';
                            for(var i = 0; i < data.length; i++){
                                html_append += `
                                <div class="item_don_hang">
                                    <div class="title_don_hang">
                                        Đơn Hàng: SD_${data[i].id}
                                    </div>
                                    <div class="info_don_hang">
                                        <div class="list_san_pham_don_hang">
                                `
                                
                                for(var j = 0; j < data[i].ds_item.length; j++){
                                    html_append += `
                                    <div class="item_san_pham_don_hang">
                                        <div class="image_item col-sm-2">
                                            <img src="/images/sach/${data[i].ds_item[j].hinh}" alt="">
                                        </div>
                                        <div class="ten_item col-sm-5">
                                            ${data[i].ds_item[j].ten_sach}
                                        </div>
                                        <div class="so_luong col-sm-1">
                                            ${data[i].ds_item[j].so_luong}
                                        </div>
                                        <div class="don_gia col-sm-2">
                                            ${data[i].ds_item[j].don_gia}
                                        </div>
                                        <div class="thanh_tien col-sm-2">
                                            ${data[i].ds_item[j].thanh_tien}
                                        </div>
                                    </div>
                                    `
                                }


                                html_append += `            
                                        </div>
                                        <div class="tong_tien">
                                            <div class="item_san_pham_don_hang">
                                                <div class="image_item col-sm-2">
                                                </div>
                                                <div class="ten_item col-sm-5">
                                                </div>
                                                <div class="so_luong col-sm-1">
                                                </div>
                                                <div class="don_gia col-sm-2">
                                                </div>
                                                <div class="thanh_tien col-sm-2">
                                                    ${data[i].id}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `
                            }

                            $('.list_don_hang').append(html_append);

                            flag = 0;
                        });
                }
                
            }
        });
    })
</script>