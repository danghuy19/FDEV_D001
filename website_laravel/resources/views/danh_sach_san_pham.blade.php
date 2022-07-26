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
    @if($cau_chao_status == 'success')
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
        
    </form>

    <div class="ds_san_pham">
        
        @for($i = 0; $i < count($ds_san_pham); $i++)
            <div class="item_san_pham">
                <div class="ten_sach">{{$ds_san_pham[$i]->ten_sach}}</div>
                <div class="don_gia">{{$ds_san_pham[$i]->don_gia}}</div>
            </div>
        @endfor
    </div>
@stop