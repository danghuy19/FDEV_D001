
<?php
//echo '<pre>',print_r($_SERVER),'</pre>';

?>
<div class="row">
    <!-- page header -->
    <div class="col-lg-12">
        <h1 class="page-header">Sửa thông tin sách có ID là <?= $id_sua ?></h1>
    </div>
    <!--end page header -->
</div>

<?php
if(isset($result)){
    notice_after_process($result, 'Sửa thông tin sách thành công', 'Sửa sách thất bại, vui lòng kiểm tra và thử lại', $_GET['page']);
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
                                <label>Tên sách</label>
                                <input name="ten_sach" class="form-control" value="<?= $info_sach_sua->ten_sach ?>">
                                <p class="help-block">Example block-level help text here.</p>
                            </div>
                            <div class="form-group">
                                <label>Loại sách</label>
                                <select name="id_loai_sach" id="">
                                    <?php
                                    foreach($ds_loai_sach as $loai_sach){
                                        $selected = "";
                                        if($loai_sach->id == $info_sach_sua->id_loai_sach){
                                            $selected = 'selected="true"';
                                        }
                                        ?>
                                        <option <?= $selected ?> value="<?= $loai_sach->id ?>"><?= $loai_sach->ten_loai_sach ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <p class="help-block">Example block-level help text here.</p>
                            </div>
                            <div class="form-group">
                                <label>Tác giả</label>
                                <select name="id_tac_gia" id="">
                                    <?php
                                    foreach($ds_tac_gia as $tac_gia){
                                        $selected = "";
                                        if($tac_gia->id == $info_sach_sua->id_loai_sach){
                                            $selected = 'selected="true"';
                                        }
                                        ?>
                                        <option <?= $selected ?> value="<?= $tac_gia->id ?>"><?= $tac_gia->ten_tac_gia ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <p class="help-block">Example block-level help text here.</p>
                            </div>
                            <div class="form-group">
                                <label>Nhà xuất bản</label>
                                <select name="id_nha_xuat_ban" id="">
                                    <?php
                                    foreach($ds_nha_xuat_ban as $nha_xuat_ban){
                                        $selected = "";
                                        if($nha_xuat_ban->id == $info_sach_sua->id_loai_sach){
                                            $selected = 'selected="true"';
                                        }
                                        ?>
                                        <option <?= $selected ?> value="<?= $nha_xuat_ban->id ?>"><?= $nha_xuat_ban->ten_nha_xuat_ban ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
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