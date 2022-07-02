<script>
    function check_before_delete(){
        var kq = confirm('Bạn có chắc chắn muốn xoá loại sách này không?');
        if(kq){
            return true;
        }
        else {
            return false;
        }
    }
</script>
<div class="row">
    <?php
    $dbh = new PDO('mysql:host=localhost;dbname=ban_sach_online_db;charset=utf8', 'root', '');
    //echo '<pre>',print_r($_GET),'</pre>';
    if(isset($_GET['id_xoa'])){
        $sql = "DELETE FROM bs_loai_sach WHERE id = " . $_GET['id_xoa'];
        $result = $dbh->exec($sql);
        if($result !== false){
            ?>
            <script>
                alert('Đã xoá thành công loại sách có id là <?php echo $_GET['id_xoa']; ?>');
                window.location.href = '?page=loai-sach';
            </script>
            <?php
        }
        else{
            ?>
            <script>
                alert('Có lỗi xảy ra trong lúc xoá loại sách id là <?php echo $_GET['id_xoa']; ?>')
            </script>
            <?php
        }
    }


    $sql = "SELECT * FROM bs_loai_sach";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $ds_loai_sach = $sth->fetchAll(PDO::FETCH_OBJ);
    //echo '<pre>',print_r($ds_loai_sach),'</pre>';
    ?>

    <!-- Page Header -->
    <div class="col-lg-12">
        <h1 class="page-header">Quản lý loại sách</h1>
        
        <a href="?page=loai-sach&chuc_nang=them">
            <button type="button" class="btn btn-primary">Thêm loại sách mới</button>
        </a>
        
    </div>
    <!--End Page Header -->
    <div class="main_content">

        <div class="table-responsive">
            <table class="table table-hover table-striped">
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

                                <button type="button" class="btn btn-info">
                                    Sửa
                                </button>

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

    </div>
</div>