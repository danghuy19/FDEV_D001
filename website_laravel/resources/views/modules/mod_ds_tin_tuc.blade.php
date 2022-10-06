<section class="ds_sp_noi_bat container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="title_module">
                Tin tức
            </div>

            <div class="list_language">
                <a href="/tin-tuc/vn">
                    <img src="/images/flag/vn.png" alt="">
                </a>
                <a href="/tin-tuc/en">
                    <img src="/images/flag/en.png" alt="">
                </a>
                <a href="/tin-tuc/de">
                    <img src="/images/flag/de.png" alt="">
                </a>
            </div>

            @foreach($ds_tin_tuc as $key => $tin_tuc)
                @if($key % 2 == 0)
                <div class="row">
                @endif
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 tin_tuc_block">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 hinh_tin_tuc">
                            <img src="images/tin_tuc/{{$tin_tuc->hinh_dai_dien}}">
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 thong_tin_mo_ta_tin_tuc">
                            <a href="chi_tiet_tin_tuc.php?id_tin_tuc=1">
                                <div class="tieu_de_tin">
                                    {{$tin_tuc->tieu_de_tin}} </div>
                            </a>
                            <div class="mo_ta_tom_tat">
                                {{$tin_tuc->noi_dung_tom_tat}} </div>
                        </div>
                    </div>
                @if($key % 2 == 1)
                </div>
                @endif
            @endforeach
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ul class="pagination">
                    <li><a class="number" href="{{$url_self}}?page=0"
                        title="Trang đầu">&lt;&lt;</a></li>
                    <li><a class="number" href="{{$url_self}}?page={{($cur_page > 0)?$cur_page - 1:0}}"
                        title="Trang trước">&lt;</a></li>
                    
                    
                    @for($i = 0; $i < $so_trang; $i++)
                    <li class="{{($i == $cur_page)?'active':''}}">
                        <a class="number" href="{{$url_self}}?page={{$i}}" title="Trang {{$i + 1}}">
                        {{$i + 1}}
                        </a>
                    </li>
                    @endfor
                    

                    <li><a class="number" href="{{$url_self}}?page={{($cur_page < $so_trang - 1)?$cur_page + 1:$so_trang - 1}}"
                            title="Dến trang sau">&gt;</a></li>
                    <li><a class="number" href="{{$url_self}}?page={{$so_trang - 1}}"
                            title="Trang cuối">&gt;&gt;</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>