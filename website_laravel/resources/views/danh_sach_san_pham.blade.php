@extends('templates.template_green')

@section('main-content')
    <style>
        .cau_chao.success {
            color: #090;
        }

        .cau_chao.failed {
            color: #f00;
        }
    </style>

    Danh sách sản phẩm
    {{-- @if($cau_chao_status == 'success')
        <div class="cau_chao success">
            @{{isset($cau_chao_test)?$cau_chao_test:'Xin chào'}}
        </div>
    @else
        <div class="cau_chao failed">
            @{{isset($cau_chao_test)?$cau_chao_test:'Xin chào'}}
        </div>
    @endif

    {{$user_id}}

    <form action="/test-match" method="POST">
        @csrf
        <!-- Equivalent for @csrf directive -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="text" name="test_value" id="input" class="form-control" value="" >
        <button type="submit">Send Test</button>
        
    </form> --}}

    {{-- @include('modules.mod_search_form') --}}

    <div class="container-fluid include_page">
        @include('modules.sidebar_sp_theo_loai')

        <div class="ds_san_pham col-sm-12 col-md-9">
            
            @for($i = 0; $i < count($ds_san_pham); $i++)
            <div class="col-sm-6 col-md-3 col-lg-3">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 item_sp_noi_bat">
                    <a href="sach/{{$ds_san_pham[$i]->id}}">
                        <div class="hinh_sach">
                            <img src="images/sach/{{$ds_san_pham[$i]->hinh}}">
                        </div>
                    </a>
                    <div class="thong_tin_tom_tat_sach"><a href="sach/{{$ds_san_pham[$i]->id}}">
                            <div class="ten_sach">{{$ds_san_pham[$i]->ten_sach}}</div>
                            <div class="tac_gia">{{$ds_san_pham[$i]->ten_tac_gia}}</div>
                            <div class="trong_luong">{{$ds_san_pham[$i]->trong_luong}}g</div>
                            <div class="don_gia_ban">{{$ds_san_pham[$i]->don_gia}} ₫</div>
                            <div class="don_gia_bia">{{$ds_san_pham[$i]->gia_bia}} ₫ </div>
                        </a><a href="them_vao_gio_hang.php?id_sach={{$ds_san_pham[$i]->id}}">
                            <div class="btn_mua_ngay" data-id-sach="{{$ds_san_pham[$i]->id}}">Mua Ngay</div>
                        </a>
                    </div>

                </div>
            </div>
            @endfor
        </div>
    </div>

@stop