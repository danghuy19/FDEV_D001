<form action="" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
    @csrf
    <div class="col-md-5 col-lg-5 form_thanh_toan">

        <div class="form-group">
            <legend>Thông tin người nhận sách</legend>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                Họ tên:
            </div>
            <div class="col-md-9">
                <input type="text" name="ho_ten" id="ho_ten" class="form-control" value="" required="required" title="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                Email:
            </div>
            <div class="col-md-9">
                <input type="text" name="email" id="email" class="form-control" value="" required="required" title="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                Điện thoại:
            </div>
            <div class="col-md-9">
                <input type="text" name="dien_thoai" id="dien_thoai" class="form-control" value="" required="required"
                    title="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                Địa chỉ:
            </div>
            <div class="col-md-9">
                <input type="text" name="dia_chi" id="dia_chi" class="form-control" value="" required="required"
                    title="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-9 col-sm-offset-3">
                <button type="submit" class="btn btn-primary" style="padding: 5px 30px">Thanh Toán</button>
            </div>
        </div>
    </div>
    <div class="col-md-7 col-lg-7">
        <div class="table-responsive">

            @include('modules.mod_gio_hang')

        </div>
    </div>
</form>