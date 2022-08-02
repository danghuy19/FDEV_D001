<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4><span class="glyphicon glyphicon-lock"></span> Đăng nhập</h4>
            </div>
            <div class="modal-body">
                @if($errors->loginErrors->first())
                <div class="error_message panel panel-danger">
                    <div class="panel-heading">Vui lòng kiểm tra lỗi</div>
                    @foreach ($errors->loginErrors->all() as $error)
                        <div class="panel-body item_message text-danger">{{$error}}</div>
                    @endforeach
                </div>
                @endif
                {!! Form::open(['route' => 'loginaccount', 'class' => 'form_dang_nhap']) !!}
                    <div class="form-group">
                        <label for="usrname"><span class="glyphicon glyphicon-user"></span> Tên đăng
                            nhập</label>
                        <input type="text" class="form-control" name="ten_dang_nhap" id="ten_dang_nhap"
                            placeholder="Tên đăng nhập">
                    </div>
                    <div class="form-group">
                        <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Mật
                            khẩu</label>
                        <input type="password" class="form-control" name="mat_khau" id="mat_khau"
                            placeholder="Mật khẩu">
                    </div>
                    <button type="submit" class="btn btn-success btn-block"><span
                            class="glyphicon glyphicon-off"></span> Đăng nhập</button>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span
                        class="glyphicon glyphicon-remove"></span> Thoát</button>
                <p>Bạn chưa là thành viên? <a href="dang_ky.php">Đăng ký</a></p>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        $("#myBtn").click(function() {
            $("#myModal").modal();
        });

        @if(!$errors->loginErrors->isEmpty())
            setTimeout(() => {
                $("#myBtn").click();
            }, 500);
        @endif
    });
</script>
<!-- END menu bar -->