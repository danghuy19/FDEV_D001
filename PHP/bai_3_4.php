<?php
class nhan_vien {
    public $ho_ten, $so_con, $ngay_sinh, $ngay_vao_lam, $gioi_tinh, $he_so_luong, $luong_can_ban = 4500000;

    function __construct($ho_ten, $so_con, $ngay_sinh, $ngay_vao_lam, $gioi_tinh, $he_so_luong){
        $this->ho_ten = $ho_ten;
        $this->so_con = $so_con;
        $this->ngay_sinh = $ngay_sinh;
        $this->ngay_vao_lam = $ngay_vao_lam;
        $this->gioi_tinh = $gioi_tinh;
        $this->he_so_luong = $he_so_luong;
    }

    function tham_nien(){
        $array_date_ngay_sinh = explode('-', $this->ngay_sinh);
        $so_tuoi = date('Y') - date('Y', mktime(0,0,0,1,1,(int)$array_date_ngay_sinh[0]));
        if($so_tuoi >= 18){
            $array_date_ngay_vao_lam = explode('-', $this->ngay_vao_lam);
            $tham_nien = date('Y') - date('Y', mktime(0,0,0,1,1,(int)$array_date_ngay_vao_lam[0]));
            if($tham_nien <= $so_tuoi - 18){
                return $tham_nien;
            }
            else {
                echo 'hơi sai sai à nha';
                return 0;
            }
        }
        else {
            echo 'sai quá sai';
            return 0;
        }
        
    }

    function tien_luong(){
        return $this->luong_can_ban * $this->he_so_luong;
    }

    function tro_cap(){
        return $tro_cap = $this->so_con * 1000000;
    }

    function tien_thuong(){
        return $this->tham_nien() * $this->tien_luong() * 0.05;
    }
}

class nv_vp extends nhan_vien {
    public $ho_ten, $so_con, $ngay_sinh, $ngay_vao_lam, $gioi_tinh, $he_so_luong, $luong_can_ban = 4500000;
    private $so_ngay_vang, $dm_vang = 2;

    function __construct($ho_ten, $so_con, $ngay_sinh, $ngay_vao_lam, $gioi_tinh, $he_so_luong, $so_ngay_vang){
        parent::__construct($ho_ten, $so_con, $ngay_sinh, $ngay_vao_lam, $gioi_tinh, $he_so_luong);
        $this->so_ngay_vang = $so_ngay_vang;
    }

    function tien_phat(){
        $tien_phat = 0;
        if($this->so_ngay_vang > $this->dm_vang){
            $tien_phat = ($this->so_ngay_vang - $this->dm_vang) * 250000;
        }
        return $tien_phat;
    }

    function tro_cap(){
        $tro_cap = 0;
        if($this->gioi_tinh == "Nữ"){
            $tro_cap = $this->so_con * 1200000;
        }
        else{
            $tro_cap = $this->so_con * 1000000;
        }
        return $tro_cap;
    }

    function thuc_lanh(){
        return parent::tien_luong() - $this->tien_phat() + $this->tro_cap() + parent::tien_thuong();
    }
}

class nv_sx extends nhan_vien {
    public $ho_ten, $so_con, $ngay_sinh, $ngay_vao_lam, $gioi_tinh, $he_so_luong, $luong_can_ban = 4500000;
    private $so_san_pham, $tang_ca, $dm_san_pham = 1000, $don_gia_san_pham = 12000;

    function __construct($ho_ten, $so_con, $ngay_sinh, $ngay_vao_lam, $gioi_tinh, $he_so_luong, $so_san_pham, $tang_ca){
        parent::__construct($ho_ten, $so_con, $ngay_sinh, $ngay_vao_lam, $gioi_tinh, $he_so_luong);
        $this->so_san_pham = $so_san_pham;
        $this->tang_ca = $tang_ca;
    }

    function tien_thuong(){
        $tien_thuong = 0;
        if($this->so_san_pham > $this->dm_san_pham){
            $tien_thuong = ($this->so_san_pham - $this->dm_san_pham) * $this->don_gia_san_pham * 0.05;
        }
        else{
            $tien_thuong = ($this->so_san_pham - $this->dm_san_pham) * $this->don_gia_san_pham * 0.01;
        }
        return $tien_thuong;
    }

    function tien_luong(){
        return $this->so_san_pham * $this->don_gia_san_pham + $this->tien_thuong();
    }

    function tro_cap(){
        $tro_cap = 0;
        if($this->tang_ca == 1){
            $tro_cap = $this->so_con * 1000000 + 200000;
        }
        else {
            $tro_cap = parent::tro_cap();
        }
        return $tro_cap;
    }

    function thuc_lanh(){
        return $this->tien_luong() + $this->tro_cap();
    }
}

echo '<pre>',print_r($_POST),'</pre>';
// $array_date_ngay_vao_lam = explode('-', $_POST['ngay_vao_lam']);
// echo date('Y', mktime(0,0,0,1,1,$array_date_ngay_vao_lam[0]));
// echo date('Y');

//$nv_vp = new nv_vp($_POST['ho_ten'], $_POST['so_con'], $_POST['ngay_sinh'], $_POST['ngay_vao_lam'], $_POST['gioi_tinh'], $_POST['he_so_luong'], $_POST['so_ngay_vang']);
//echo $nv_vp->thuc_lanh();
// $nv_sx = new nv_sx($_POST['ho_ten'], $_POST['so_con'], $_POST['ngay_sinh'], $_POST['ngay_vao_lam'], $_POST['gioi_tinh'], $_POST['he_so_luong'], $_POST['so_san_pham'], $_POST['tang_ca']);
// echo $nv_sx->thuc_lanh();

$tien_luong = 0;
$tien_tro_cap = 0;
$thuc_lanh = 0;
if(isset($_POST['loai_nhan_vien'])){
    if($_POST['loai_nhan_vien'] == 'van_phong'){
        $nv_vp = new nv_vp($_POST['ho_ten'], $_POST['so_con'], $_POST['ngay_sinh'], $_POST['ngay_vao_lam'], $_POST['gioi_tinh'], $_POST['he_so_luong'], $_POST['so_ngay_vang']);
        $tien_luong = $nv_vp->tien_luong();
        $tien_tro_cap = $nv_vp->tro_cap();
        $thuc_lanh = $nv_vp->thuc_lanh();
    }
    else{
        $nv_sx = new nv_sx($_POST['ho_ten'], $_POST['so_con'], $_POST['ngay_sinh'], $_POST['ngay_vao_lam'], $_POST['gioi_tinh'], $_POST['he_so_luong'], $_POST['so_san_pham'], $_POST['tang_ca']);
        $tien_luong = $nv_sx->tien_luong();
        $tien_tro_cap = $nv_sx->tro_cap();
        $thuc_lanh = $nv_sx->thuc_lanh();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th colspan="4">Quản lý nhân viên</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Họ và tên:</td>
                        <td>
                            <input type="text" name="ho_ten" id="input" class="form-control" value="<?php echo (isset($_POST['ho_ten']))?$_POST['ho_ten']:''; ?>" title="">
                        </td>
                        <td>Số con:</td>
                        <td>
                            <input type="text" name="so_con" id="input" class="form-control" value="<?php echo (isset($_POST['so_con']))?$_POST['so_con']:''; ?>" title="">
                        </td>
                    </tr>
                    <tr>
                        <td>Ngày sinh:</td>
                        <td>
                            <input type="date" name="ngay_sinh" id="input" class="form-control" value="<?php echo (isset($_POST['ngay_sinh']))?$_POST['ngay_sinh']:''; ?>" title="">
                        </td>
                        <td>Ngày vào làm:</td>
                        <td>
                            <input type="date" name="ngay_vao_lam" id="input" class="form-control" value="<?php echo (isset($_POST['ngay_vao_lam']))?$_POST['ngay_vao_lam']:''; ?>" title="">
                        </td>
                    </tr>
                    <tr>
                        <td>Giới tính:</td>
                        <td>
                            <label for="nam">Nam</label>
                            <input type="radio" id="nam" value="Nam" name="gioi_tinh" 
                            <?php 
                                if(isset($_POST['gioi_tinh'])){
                                    if($_POST['gioi_tinh'] == 'Nam'){
                                        echo 'checked="true"';
                                    }
                                }
                            ?> />
                            <label for="nu">Nữ</label>
                            <input type="radio" id="nu" value="Nữ" name="gioi_tinh" 
                            <?php 
                                if(isset($_POST['gioi_tinh'])){
                                    if($_POST['gioi_tinh'] == 'Nữ'){
                                        echo 'checked="true"';
                                    }
                                }
                            ?>
                            />
                        </td>
                        <td>Hệ số lương:</td>
                        <td>
                            <input type="text" name="he_so_luong" id="input" class="form-control" value="<?php echo (isset($_POST['he_so_luong']))?$_POST['he_so_luong']:''; ?>" title="">
                        </td>
                    </tr>
                    <tr>
                        <td>Loại nhân viên</td>
                        <td>
                            <label for="van_phong">văn phòng</label>
                            <input type="radio" id="van_phong" value="van_phong" name="loai_nhan_vien"
                            <?php 
                                if(isset($_POST['loai_nhan_vien'])){
                                    if($_POST['loai_nhan_vien'] == 'van_phong'){
                                        echo 'checked="true"';
                                    }
                                }
                            ?> />
                        </td>
                        <td colspan="2">
                            <label for="san_xuat">sản xuất</label>
                            <input type="radio" id="san_xuat" value="san_xuat" name="loai_nhan_vien"
                            <?php 
                                if(isset($_POST['loai_nhan_vien'])){
                                    if($_POST['loai_nhan_vien'] == 'san_xuat'){
                                        echo 'checked="true"';
                                    }
                                }
                            ?> />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            Số ngày vắng <input type="text" name="so_ngay_vang" id="input" class="form-control" value="<?php echo (isset($_POST['so_ngay_vang']))?$_POST['so_ngay_vang']:''; ?>" title="">
                        </td>
                        <td>
                            Số sản phẩm <input type="text" name="so_san_pham" id="input" class="form-control" value="<?php echo (isset($_POST['so_san_pham']))?$_POST['so_san_pham']:''; ?>" title="">
                        </td>
                        <td>
                            Tăng ca:
                            <label for="co">Có</label>
                            <input type="radio" id="co" value="1" name="tang_ca"
                            <?php 
                                if(isset($_POST['tang_ca'])){
                                    if($_POST['tang_ca'] == '1'){
                                        echo 'checked="true"';
                                    }
                                }
                            ?> />
                            <label for="khong">Không</label>
                            <input type="radio" id="khong" value="0" name="tang_ca"
                            <?php 
                                if(isset($_POST['tang_ca'])){
                                    if($_POST['tang_ca'] === '0'){
                                        echo 'checked="true"';
                                    }
                                }
                            ?> />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Tiền lương:
                            <input type="text" name="tien_luong" id="input" class="form-control" value="<?php echo $tien_luong; ?>" title="">
                        </td>
                        <td colspan="2">
                            Trợ cấp:
                            <input type="text" name="tro_cap" id="input" class="form-control" value="<?php echo $tien_tro_cap; ?>" title="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            Thực lãnh:
                            <input type="text" name="thuc_Lanh" id="input" class="form-control" value="<?php echo $thuc_lanh; ?>" title="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <button type="submit" class="btn btn-primary">Tính lương</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</body>
</html>