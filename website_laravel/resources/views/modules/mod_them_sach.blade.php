{{-- {!! Form::open(array('route' => 'savecreatesach', 'class' => 'register_form', 'files'=>true)) !!}

    {!! Form::text('ten_sach', null, ['class' => 'form-control']) !!}

    {!! Form::file('ds_hinh[]', ["multiple" => true]) !!}

    {!! Form::submit('Lưu sách', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!} --}}

@if(session()->has('NoticeSuccess'))
<script>
    alert("{{session('NoticeSuccess')}}");
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
                <label class="col-sm-2 control-label">Mã SKU</label>
                <div class="col-sm-4">
                    <input type="text" name="sku" class="form-control">
                    <span class="help-block"></span>
                </div>
                <label class="col-sm-2 control-label" class="form-control">Loại sách</label>
                <div class="col-sm-4">
                    <select name="id_loai_sach" id=""  class="form-control">
                        @foreach($ds_loai_sach as $loai_sach)
                        <option value="{{$loai_sach->id}}">
                            {{$loai_sach->ten_loai_sach}}
                        </option>
                            @if(count($loai_sach->ds_loai_con) > 0)
                                @foreach($loai_sach->ds_loai_con as $loai_con)
                                <option value="{{$loai_con->id}}">
                                    |== {{$loai_con->ten_loai_sach}}
                                </option>
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                    {{-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> --}}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Tên sách</label>
                <div class="col-sm-4">
                    <input name="ten_sach" type="text" class="form-control">
                    {{-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> --}}
                </div>
                <label class="col-sm-2 control-label">Đọc thử</label>
                <div class="col-sm-4">
                    <input name="doc_thu" type="text" class="form-control">
                    {{-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> --}}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Số trang:</label>
                <div class="col-sm-4">
                    <input name="so_trang" type="text" class="form-control">
                    {{-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> --}}
                </div>
                <label class="col-sm-2 control-label">Tác giả:</label>
                <div class="col-sm-4">
                    <select name="id_tac_gia" id="" class="form-control">
                        @foreach($ds_tac_gia as $tac_gia)
                        <option value="{{$tac_gia->id}}">
                            {{$tac_gia->ten_tac_gia}}
                        </option>
                        @endforeach
                    </select>
                    {{-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> --}}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Nhà xuất bản:</label>
                <div class="col-sm-4">
                    <select name="id_nha_xuat_ban" id="" class="form-control">
                        @foreach($ds_nxb as $nxb)
                        <option value="{{$nxb->id}}">
                            {{$nxb->ten_nha_xuat_ban}}
                        </option>
                        @endforeach
                    </select>
                    {{-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> --}}
                </div>
                <label class="col-sm-2 control-label">Ngày xuất bản</label>
                <div class="col-sm-4">
                    <input name="ngay_xuat_ban" type="date" class="form-control">
                    {{-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> --}}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Trọng lượng:</label>
                <div class="col-sm-4">
                    <input name="trong_luong" type="text" class="form-control">
                    {{-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> --}}
                </div>
                <label class="col-sm-2 control-label">Kích thước</label>
                <div class="col-sm-4">
                    <input name="kich_thuoc" type="text" class="form-control">
                    {{-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> --}}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Giá bìa</label>
                <div class="col-sm-4">
                    <input name="gia_bia" type="text" class="form-control">
                    {{-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> --}}
                </div>
                <label class="col-sm-2 control-label">Đơn giá</label>
                <div class="col-sm-4">
                    <input name="don_gia" type="text" class="form-control">
                    {{-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> --}}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Trạng thái</label>
                <div class="col-sm-4">
                    <select name="trang_thai" id="" class="form-control">
                        <option value="1">
                            Đang bán
                        </option>
                        <option value="0">
                            Ẩn đi
                        </option>
                    </select>
                    {{-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> --}}
                </div>
                <label class="col-sm-2 control-label">Nổi bật</label>
                <div class="col-sm-4">
                    <select name="noi_bat" id="" class="form-control">
                        <option value="0">
                            Không nổi bật
                        </option>
                        <option value="1">
                            Nổi bật
                        </option>
                    </select>
                    {{-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> --}}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Giới thiệu</label>
                <div class="col-sm-4">
                    <textarea class="form-control ckeditor" name="editor1" rows="6"></textarea>
                </div>
                <script>
                    // Replace the <textarea id="editor1"> with an CKEditor instance.
                    $(() => {
                        CKEDITOR.replace( 'editor1', {
                            on: {
                                focus: onFocus,
                                blur: onBlur,
            
                                // Check for availability of corresponding plugins.
                                pluginsLoaded: function( evt ) {
                                    var doc = CKEDITOR.document, ed = evt.editor;
                                    if ( !ed.getCommand( 'bold' ) )
                                        doc.getById( 'exec-bold' ).hide();
                                    if ( !ed.getCommand( 'link' ) )
                                        doc.getById( 'exec-link' ).hide();
                                }
                            }
                        });
                    })
                </script>

                <label class="col-sm-2 control-label">Hình sách</label>
                <div class="col-sm-4">
                    <input type="file" name="hinh_sach" id="hinh_sach"  class="form-control">
                    <div id="image-holder">
                        <img src="" alt="thumb-image">
                    </div>
                    {{-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> --}}
                    <script>
                        
                        $("#hinh_sach").on('change', function () {
                        
                            if (typeof (FileReader) != "undefined") {
                    
                                var image_holder = $("#image-holder");
                                image_holder.empty();
                    
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    $("<img />", {
                                        "src": e.target.result,
                                        "class": "thumb-image"
                                    }).appendTo(image_holder);
                    
                                }
                                image_holder.show();
                                reader.readAsDataURL($(this)[0].files[0]);
                            } else {
                                alert("This browser does not support FileReader.");
                            }
                        });
                    
                    </script>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Lưu thông tin sách</button>
                </div>
            </div>
        </form>
    </div>
</section>