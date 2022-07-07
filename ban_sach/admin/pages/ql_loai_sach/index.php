<?php
add_confirm_box_before_delete();

if(isset($result)){
    notice_after_process($result, 'Đã xoá thành công loại sách có id là ' . $_GET['id_xoa'], 'Có lỗi xảy ra trong lúc xoá loại sách id là ' . $_GET['id_xoa'], 'loai-sach');
}
?>

<link rel="stylesheet" href="http://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<script src="http://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>


<div class="row">
    <!-- Page Header -->
    <div class="col-lg-12">
        <h1 class="page-header">Quản lý loại sách</h1>
        
        <a href="?page=loai-sach&chuc_nang=them">
            <button type="button" class="btn btn-primary">Thêm loại sách mới</button>
        </a>
        <div class="contain_form_tim_kiem">
            
            <form action="" method="POST" class="form-horizontal" role="form">
                <div class="form-group">
                    <legend>Tìm kiếm</legend>
                </div>
        
                <div class="form-group">
                    <div class="col-sm-10">
                        <input type="text" name="tim_kiem" id="inputtim_kiem" class="form-control" value="" title="">
                    </div>
                </div>
        
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
            
        </div>
        
    </div>
    <!--End Page Header -->
    <div class="main_content">

        <div class="table-responsive">
            <table id="ds_loai_sach" class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên loại</th>
                        <th>Tên loại cha</th>
                        <th>Trạng thái</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($ds_loai_sach as $loai_sach) {
                    ?>
                        <tr>
                            <td><?php echo $loai_sach->id ?></td>
                            <td><?php echo $loai_sach->ten_loai_sach ?></td>
                            <td><?php echo $loai_sach->id_loai_cha ?></td>
                            <td><?php echo $loai_sach->trang_thai ?></td>
                            <td>

                                <a href="?page=loai-sach&chuc_nang=sua&id_sua=<?php echo $loai_sach->id; ?>">
                                    <button type="button" class="btn btn-info">
                                        Sửa
                                    </button>
                                </a>

                                <a href="?page=loai-sach&id_xoa=<?php echo $loai_sach->id; ?>" onclick="return check_before_delete();">
                                    <button type="button" class="btn btn-danger">
                                        Xoá
                                    </button>
                                </a>

                            </td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
        <script>
            // $(document).ready( function () {
            //     console.log($('#ds_loai_sach'));
            //     $('#ds_loai_sach').DataTable();
            // });
        </script>

    </div>
</div>