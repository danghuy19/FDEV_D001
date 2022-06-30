<?php
session_start();
//echo '<pre>',print_r($_POST),'</pre>';
$string_data_user = file_get_contents('data/user.json');
$mang_user = json_decode($string_data_user);
//echo '<pre>',print_r($mang_user),'</pre>';

if(isset($_SESSION['user_info']) || isset($_COOKIE['user_info'])){
    header('location: xin_chao.php');
    die();
}

if(isset($_POST['tai_khoan']) && isset($_POST['mat_khau']) && isset($_POST['re_mat_khau']) && isset($_POST['ho_ten'])){
    if($_POST['tai_khoan'] && $_POST['mat_khau'] && $_POST['re_mat_khau'] && $_POST['ho_ten']){
        if($_POST['mat_khau'] == $_POST['re_mat_khau']){
            $flag_exist = 0;
            foreach($mang_user as $user_exist){
                if($user_exist->tai_khoan == $_POST['tai_khoan']){
                    $flag_exist = 1;
                    break;
                }
            }

            if($flag_exist == 0){
                $user_new = new stdClass;
                $user_new->tai_khoan = $_POST['tai_khoan'];
                $user_new->mat_khau = $_POST['mat_khau'];
                $user_new->ho_ten = $_POST['ho_ten'];
                $mang_user[] = $user_new;
                $string_data_user_new = json_encode($mang_user);
                file_put_contents('data/user.json', $string_data_user_new);
                echo 'Tạo tài khoản thành công. Sau 5 giây bạn sẽ tự động đăng nhập và chuyển sang trang thông tin';
                sleep(5);
                $_SESSION['user_info'] = $user_new;
                header('location: xin_chao.php');
            }
            else{
                echo 'Username đã tồn tại, vui lòng dùng username khác';
            }
        }
        else {
            echo 'Mật khẩu không khớp, vui lòng kiểm tra lại';
        }
    }
    else{
        echo 'Vui lòng nhập đầy đủ thông tin';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>

    
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    
</head>
<body>
    <div class="container">
        
        <form action="" method="POST" class="form-horizontal" role="form">
                <div class="form-group">
                    <legend>Đăng ký tài khoản</legend>
                </div>
        
                <div class="form-group">
                    <div class="col-sm-2">
                        Tài khoản
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="tai_khoan" class="form-control" value="<?php echo (isset($_POST['tai_khoan']))?$_POST['tai_khoan']:''; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2">
                        Email
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="email" class="form-control" value="<?php echo (isset($_POST['tai_khoan']))?$_POST['tai_khoan']:''; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2">
                        Password
                    </div>
                    <div class="col-sm-10">
                        <input type="password" name="mat_khau" class="form-control" value="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2">
                        Re-password
                    </div>
                    <div class="col-sm-10">
                        <input type="password" name="re_mat_khau" class="form-control" value="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2">
                        Họ tên
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="ho_ten" class="form-control" value="<?php echo (isset($_POST['ho_ten']))?$_POST['ho_ten']:''; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2">
                        Ngày sinh
                    </div>
                    <div class="col-sm-10">
                        <input type="date" name="ngay_sinh" class="form-control" value="<?php echo (isset($_POST['ho_ten']))?$_POST['ho_ten']:''; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2">
                        Điện thoại
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="dien_thoai" class="form-control" value="<?php echo (isset($_POST['ho_ten']))?$_POST['ho_ten']:''; ?>">
                    </div>
                </div>
        
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
        </form>
        
    </div>
</body>
</html>