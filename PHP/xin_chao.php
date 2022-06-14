<?php
session_start();
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
    <?php

    if(isset($_GET['logout'])){
        if($_GET['logout'] == 1){
            unset($_SESSION['user_info']);
            setcookie('user_info', '', time());
            header('location: login.php');
        }
    }

    if(isset($_SESSION['user_info'])){
        ?>
        <div><?php echo 'Xin chào bạn ' . $_SESSION['user_info']->fullname; ?> 
            <a href="?logout=1" class="btn btn-danger">Đăng xuất</a>
        </div>
        <?php
        $show_or_hide_form = 0;
    }
    else if (isset($_COOKIE['user_info'])){
        $mang_thong_tin = json_decode($_COOKIE['user_info']);
        ?>
        <div><?php echo 'Xin chào bạn ' . $mang_thong_tin->fullname; ?> 
            <a href="?logout=1" class="btn btn-danger">Đăng xuất</a>
        </div>
        <?php
        $show_or_hide_form = 0;
    }
    ?>

</body>
</html>
