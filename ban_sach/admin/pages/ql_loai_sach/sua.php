
<?php
//echo '<pre>',print_r($_SERVER),'</pre>';

?>
<div class="row">
    <!-- page header -->
    <div class="col-lg-12">
        <h1 class="page-header">Sửa thông tin loại sách có ID là <?= $id_sua ?></h1>
    </div>
    <!--end page header -->
</div>

<?php
if(isset($result)){
    notice_after_process($result, 'Sửa thông tin loại sách thành công', 'Sửa loại sách thất bại, vui lòng kiểm tra và thử lại', $_GET['page']);
}
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