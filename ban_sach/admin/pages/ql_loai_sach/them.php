

<div class="row">
    <!-- page header -->
    <div class="col-lg-12">
        <h1 class="page-header">Thêm loại sách mới</h1>
    </div>
    <!--end page header -->
</div>

<?php
$dbh = new PDO('mysql:host=localhost;dbname=ban_sach_online_db;charset=utf8', 'root', '');
//echo '<pre>',print_r($_POST),'</pre>';
if(isset($_POST['ten_loai_sach'])){
    $ten_loai_sach = $_POST['ten_loai_sach'];
    $id_loai_cha = $_POST['id_loai_cha'];
    $trang_thai = (isset($_POST['trang_thai']))?1:0;

    $sql = "INSERT INTO bs_loai_sach(ten_loai_sach, id_loai_cha, trang_thai)
            VALUES('$ten_loai_sach', '$id_loai_cha', '$trang_thai')";
    $result = $dbh->exec($sql);
    if($result !== false){
        ?>
        <script>
            alert('thêm loại sách mới thành công');
            window.location.href = '?page=' + '<?php echo $_GET['page'] ?>';
        </script>
        <?php
    }
    else{
        ?>
        <script>
            alert('thêm loại sách mới thất bại, vui lòng kiểm tra và thử lại');
        </script>
        <?php 
    }
}
?>

<?php
    
    $sql = "SELECT * FROM bs_loai_sach WHERE id_loai_cha = 0";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $ds_loai_sach_cap_1 = $sth->fetchAll(PDO::FETCH_OBJ);
    //echo '<pre>',print_r($ds_loai_sach_cap_1),'</pre>';

    foreach($ds_loai_sach_cap_1 as $loai_sach_cap_1){
        $sql = "SELECT * FROM bs_loai_sach WHERE id_loai_cha = " . $loai_sach_cap_1->id;
        $sth = $dbh->prepare($sql);
        $sth->execute();
        $ds_loai_sach_cap_2 = $sth->fetchAll(PDO::FETCH_OBJ);

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
                                <input name="ten_loai_sach" class="form-control">
                                <p class="help-block">Example block-level help text here.</p>
                            </div>
                            <div class="form-group">
                                <label>Loại cha</label>
                                <select name="id_loai_cha" id=""  class="form-control">
                                    <?php
                                    foreach($ds_loai_sach_cap_1 as $loai_con_cap_1){
                                        ?>
                                        <option value="<?php echo $loai_con_cap_1->id; ?>">
                                            <?php echo $loai_con_cap_1->ten_loai_sach; ?>
                                        </option>
                                        <?php

                                        if(count($loai_con_cap_1->ds_loai_con) > 0){
                                            foreach($loai_con_cap_1->ds_loai_con as $loai_con_cap_2){
                                                ?>
                                                <option value="<?php echo $loai_con_cap_2->id; ?>">
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
                                    <input name="trang_thai" type="checkbox" checked>
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