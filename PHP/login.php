<?php
session_start();

$string_data_user = file_get_contents('data/user.json');
$mang_user = [];
if($string_data_user){
    $mang_user = json_decode($string_data_user);
}

//echo '<pre>',print_r($mang_user),'</pre>';
//unset($_SESSION['user_info']);

if(isset($_POST['uname']) && isset($_POST['psw'])){

    $flag = 0;
    for($i = 0  ; $i < count($mang_user); $i++){
        if($_POST['uname'] == $mang_user[$i]->uname && $_POST['psw'] == $mang_user[$i]->psw){
            $mang_user[$i]->psw = '';
            if($_POST['remember']){
                setcookie('user_info', json_encode($mang_user[$i]), time() + 365 * 86400 );
            }
            else {
                echo 'đăng nhập thành công, Xin chào bạn Hùng Nguyễn';
                $_SESSION['user_info'] = $mang_user[$i];
            }
            $flag = 1;
            header('location: xin_chao.php');
            break;
        }
    }

    if($flag == 0){
        echo 'Tài khoản hoặc mật khẩu không chính xác';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        form {
            border: 3px solid #f1f1f1;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #04AA6D;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        .cancelbtn {
            width: auto;
            padding: 10px 18px;
            background-color: #f44336;
        }

        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
        }

        img.avatar {
            width: 40%;
            border-radius: 50%;
        }

        .container_form {
            padding: 16px;
        }

        span.psw {
            float: right;
            padding-top: 16px;
        }

        .form_login {
            max-width: 600px;
            margin: auto;
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }

            .cancelbtn {
                width: 100%;
            }
        }
    </style>

    
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    
</head>

<body>

    <div class="container">
        
        <?php
        $show_or_hide_form = 1;
        if(isset($_SESSION['user_info']) || isset($_COOKIE['user_info'])){
            header('location: xin_chao.php');
            $show_or_hide_form = 0;
        }

        if($show_or_hide_form == 1){
            ?>
            <h2>Login Form</h2>

            <form class="form_login" action="" method="post">
                <div class="imgcontainer">
                    <img src="images/img_avatar2.png" alt="Avatar" class="avatar">
                </div>

                <div class="container_form">
                    <label for="uname"><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="uname" required>

                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="psw" required>

                    <button type="submit">Login</button>
                    <label>
                        <input type="checkbox" checked="checked" name="remember" value="1"> Remember me
                    </label>
                </div>

                <div class="container_form" style="background-color:#f1f1f1">
                    <button type="button" class="cancelbtn">Cancel</button>
                    <span class="psw">Forgot <a href="#">password?</a></span>
                </div>
            </form>
            <?php
        }
        ?>
    </div>

</body>

</html>