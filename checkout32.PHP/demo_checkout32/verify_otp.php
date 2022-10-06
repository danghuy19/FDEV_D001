<?php
require 'config.php';
session_start();

$error = '';
$success = false;
if (isset($_SESSION['SEAMLESS'])) {
    $payment_method = $_SESSION['SEAMLESS']['payment_method'];
    $bank_code = $_SESSION['SEAMLESS']['bank_code'];
    $auth_url = $_SESSION['SEAMLESS']['auth_url'];
    $token = $_SESSION['SEAMLESS']['token'];
    if (!empty($_POST)) {
        $input_authen_transaction = array(
            'token' => $token,
            'otp' => (empty($_POST['otp'])) ? '' : $_POST['otp'],
            'auth_url' => $auth_url
        );
        $result_authen_transaction = SeamlessCheckout::authenTransaction($input_authen_transaction);
        if ($result_authen_transaction['error_code'] == '00') {
            $success = true;
        } else {
            $error = $result_authen_transaction['description'];
        }
    }
}
?>

<html>
<head>
    <title>Demo Checkout3.2</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="asset/bootstrap-3.4.1-dist/css/bootstrap.css">
    <style>
        .padding-bot-30 {
            padding-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row padding-bot-30">
        <div class="text-center">
            <h2>Xác thực thanh toán</h2>
        </div>
    </div>
    <?php if (!empty($error)) {
        echo '<div class="alert alert-danger">' . $error . '</div>';
    }
    ?>
    <?php if ($success) {
        echo '<div class="alert alert-success">Thanh toán thành công</div>';
    }
    ?>
    <form action="" method="post">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <div class="form-group padding-bot-30">
                            <div class="col-md-4"><label for="card_fullname">OTP</label></div>
                            <div class="col-md-8"><input type="text" maxlength="8" class="form-control" name="otp" id="otp" required></div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Thanh toán</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
<script src="asset/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
</script>
</html>
