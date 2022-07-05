
<?php
//echo '<pre>',print_r($_SERVER),'</pre>';
$id_sua = '';
if(isset($_GET['id_sua'])){
    $id_sua = $_GET['id_sua'];
}
else {
    ?>
    <script>
        window.location.href = '?page=loai-sach';
    </script>
    <?php
}
?>
<div class="row">
    <!-- page header -->
    <div class="col-lg-12">
        <h1 class="page-header">Sửa thông tin loại sách có ID là <?= $id_sua ?></h1>
    </div>
    <!--end page header -->
</div>

<?php
$info_loai_sach_sua = $xl_loai_sach->load_info_loai_sach($id_sua);
//echo '<pre>',print_r($info_loai_sach_sua),'</pre>';

//echo '<pre>',print_r($_POST),'</pre>';
if(isset($_POST['ten_loai_sach'])){
    $ten_loai_sach = $_POST['ten_loai_sach'];
    $id_loai_cha = $_POST['id_loai_cha'];
    $trang_thai = (isset($_POST['trang_thai']))?1:0;

    $xl_loai_sach->sua_loai_sach($ten_loai_sach, $id_loai_cha, $trang_thai, $id_sua);
    if($result !== false){
        ?>
        <script>
            alert('Sửa thông tin loại sách thành công');
            window.location.href = '?page=' + '<?php echo $_GET['page'] ?>';
        </script>
        <?php
    }
    else{
        ?>
        <script>
            alert('Sửa loại sách thất bại, vui lòng kiểm tra và thử lại');
        </script>
        <?php 
    }
}
?>

<?php
    
    $ds_loai_sach_cap_1 = $xl_loai_sach->load_toan_bo_danh_sach_loai_sach(0);

    foreach($ds_loai_sach_cap_1 as $loai_sach_cap_1){
        $ds_loai_sach_cap_2 = $xl_loai_sach->load_toan_bo_danh_sach_loai_sach($loai_sach_cap_1->id);
        $loai_sach_cap_1->ds_loai_con = $ds_loai_sach_cap_2;
    }

    //echo '<pre>',print_r($ds_loai_sach_cap_1),'</pre>';
?>

<div class="row">
    <div class="col-lg-12">
        <!-- Form Elements -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Basic Form Elements
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label>Tên loại</label>
                                <input name="ten_loai_sach" class="form-control" value="<?= $info_loai_sach_sua->ten_loai_sach ?>">
                                <p class="help-block">Example block-level help text here.</p>
                            </div>
                            <div class="form-group">
                                <label>Loại cha</label>
                                <select name="id_loai_cha" id=""  class="form-control">
                                    <option value="0">Không có loại cha</option>
                                    <?php
                                    foreach($ds_loai_sach_cap_1 as $loai_con_cap_1){
                                        ?>
                                        <option value="<?php echo $loai_con_cap_1->id; ?>"
                                            <?php echo ($loai_con_cap_1->id == $info_loai_sach_sua->id_loai_cha)?'selected':'' ?>>
                                            <?php echo $loai_con_cap_1->ten_loai_sach; ?>
                                        </option>
                                        <?php

                                        if(count($loai_con_cap_1->ds_loai_con) > 0){
                                            foreach($loai_con_cap_1->ds_loai_con as $loai_con_cap_2){
                                                ?>
                                                <option value="<?php echo $loai_con_cap_2->id; ?>"
                                                <?php echo ($loai_con_cap_2->id == $info_loai_sach_sua->id_loai_cha)?'selected':'' ?>>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $loai_con_cap_2->ten_loai_sach; ?>
                                                </option>
                                                <?php 
                                            }
                                        }
                                    }
                                    ?>
                                    
                                </select>
                                <p class="help-block">Example block-level help text here.</p>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <br/>
                                <label class="switch">
                                    <input name="trang_thai" type="checkbox" <?php echo ($info_loai_sach_sua->trang_thai)?'checked':'' ?>>
                                    <span class="slider round"></span>
                                </label>
                                <p class="help-block">Example block-level help text here.</p>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit Button</button>
                            <button type="reset" class="btn btn-success">Reset Button</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Form Elements -->
    </div>
</div>