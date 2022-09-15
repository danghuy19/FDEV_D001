{{-- {!! Form::open(array('route' => 'savecreatesach', 'class' => 'register_form', 'files'=>true)) !!}

    {!! Form::text('ten_sach', null, ['class' => 'form-control']) !!}

    {!! Form::file('ds_hinh[]', ["multiple" => true]) !!}

    {!! Form::submit('Lưu sách', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!} --}}

@if (isset($NoticeSuccess))
    <script>
        alert("{{$NoticeSuccess}}");
    </script>
@endif
<section class="panel">
    <header class="panel-heading">
        Form Elements
    </header>
    <div class="panel-body">
        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="col-sm-2 control-label">ID đơn hàng</label>
                <div class="col-sm-10">
                    {{$thong_tin_don_hang->id}}
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Họ tên người đặt</label>
                <div class="col-sm-10">
                    <input type="text" name="ho_ten_nguoi_nhan" class="form-control" value="{{$thong_tin_don_hang->ho_ten_nguoi_nhan}}">
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Email người đặt</label>
                <div class="col-sm-10">
                    {{-- <input type="text" name="email_nguoi_nhan" class="form-control" value="{{$thong_tin_don_hang->email_nguoi_nhan}}"> --}}
                    {{$thong_tin_don_hang->email_nguoi_nhan}}
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Trạng thái</label>
                <div class="col-sm-4">
                    <select name="trang_thai" id="" class="form-control">
                        @foreach($array_trang_thai as $key => $trang_thai)
                        <option value="{{$key}}" @if($key == $thong_tin_don_hang->trang_thai) selected @endif>{{$trang_thai}}</option>
                        @endforeach
                    </select>
                    {{-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> --}}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Lưu thông tin đơn hàng</button>
                </div>
            </div>
        </form>
    </div>
</section>
