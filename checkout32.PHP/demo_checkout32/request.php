<?php
require 'config.php';
session_start();

$error = '';
$fields = array(
    'BANK_NAME' => false,
    'BANK_ACCOUNT' => false,
    'ISSUE_MONTH' => false,
    'ISSUE_YEAR' => false,
    'EXPIRED_MONTH' => false,
    'EXPIRED_YEAR' => false,
);
if (isset($_SESSION['SEAMLESS'])) {
    $payment_method = $_SESSION['SEAMLESS']['payment_method'];
    $bank_code = $_SESSION['SEAMLESS']['bank_code'];
    $request_fields_result = SeamlessCheckout::getRequestField(array(
        'payment_method' => $payment_method,
        'bank_code' => $bank_code,
    ));
    if (isset($request_fields_result) && $request_fields_result['error_code'] == '00') {
        $request_fields = $request_fields_result['response']['bank']['payment_method'][$payment_method];
        if ($request_fields != 'NOT_REQUIRED') {
            foreach ($request_fields['field'] as $field) {
                $fields[$field] = true;
            }
        }
    } else {
        $error = 'Lỗi kết nối';
    }
}
if (!empty($_POST)) {
    $input_set_request_checkout = array(
        'order_code' => 'TEST_SEAMLESSCHECKOUT_' . time(),
        'total_amount' => $_POST['amount'],
        'payment_method' => $payment_method,
        'payment_type' => '',
        'order_description' => 'test order',
        'tax_amount' => 0,
        'discount_amount' => 0,
        'fee_shipping' => 0,
        'bank_code' => $bank_code,
        'return_url' => ROOT_PATH . DS . 'return_url.php',
        'cancel_url' => ROOT_PATH . DS . 'cancel_url.php',
        'notify_url' => ROOT_PATH . DS . 'notify_url.php',
        'time_limit' => 10080,
        'buyer_fullname' => $_SESSION['SEAMLESS']['buyer_fullname'],
        'buyer_email' => $_SESSION['SEAMLESS']['buyer_email'],
        'buyer_mobile' => $_SESSION['SEAMLESS']['buyer_mobile'],
        'buyer_address' => $_SESSION['SEAMLESS']['buyer_address'],
        'cur_code' => 'vnd',
        'lang_code' => 'vi',
        'affiliate_code' => '',
        'card_number' => empty($_POST['card_number']) ? '' : $_POST['card_number'],
        'card_fullname' => empty($_POST['card_fullname']) ? '' : $_POST['card_fullname'],
        'card_month' => empty($_POST['card_month']) ? '' : $_POST['card_month'],
        'card_year' => empty($_POST['card_year']) ? '' : $_POST['card_year'],
    );
    $result_set_request_field = SeamlessCheckout::setExpressCheckout($input_set_request_checkout);
    if ($result_set_request_field['error_code'] == '00') {
        $auth_site = $result_set_request_field['auth_site'];
        $auth_url = $result_set_request_field['auth_url'];
        $token = $result_set_request_field['token'];
        switch ($auth_site) {
            case 'NL':
                $_SESSION['SEAMLESS']['auth_url'] = $auth_url;
                $_SESSION['SEAMLESS']['token'] = $token;
                header("Location: verify_otp.php");
                break;
            case 'BANK':
            case 'IB_BANK':
                header("Location: " . $auth_url);
                break;
            case 'QRCODE':
                $_SESSION['SEAMLESS']['qr_data'] = $result_set_request_field['qr_data'];
                header("Location: verify_qrcode.php");
                break;
        }
    } else {
        $error = $result_set_request_field['description'];
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
            <h2>Thông tin thanh toán</h2>
        </div>
    </div>
    <?php if (!empty($error)) {
        echo '<div class="alert alert-danger">' . $error . '</div>';
    }
    ?>
    <form action="" method="post">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">Thông tin thanh toán</div>
                    <div class="panel-body">
                        <?php if ($fields['BANK_NAME']) {?>
                        <div class="form-group padding-bot-30">
                            <div class="col-md-4"><label for="card_fullname">Họ tên chủ thẻ/tài khoản</label></div>
                            <div class="col-md-8"><input type="text" class="form-control" name="card_fullname" id="card_fullname" required></div>
                        </div>
                        <?php }?>
                        <?php if ($fields['BANK_ACCOUNT']) {?>
                        <div class="form-group padding-bot-30">
                            <div class="col-md-4"><label for="card_number">Số thẻ/tài khoản</label></div>
                            <div class="col-md-8"><input type="number" class="form-control" name="card_number" id="card_number" required></div>
                        </div>
                        <?php }?>
                        <?php if ($fields['ISSUE_MONTH']) {?>
                        <div class="form-group padding-bot-30">
                            <div class="col-md-4"><label for="card_month">Tháng phát hành</label></div>
                            <div class="col-md-8"><input type="text" pattern="\d*" maxlength="2" class="form-control" name="card_month" id="card_month"  placeholder="Nhập tháng phát hành: 01, 02,..." required></div>
                        </div>
                        <?php }?>
                        <?php if ($fields['ISSUE_YEAR']) {?>
                        <div class="form-group padding-bot-30">
                            <div class="col-md-4"><label for="card_year">Năm phát hành</label></div>
                            <div class="col-md-8"><input type="text" pattern="\d*" maxlength="2" class="form-control" name="card_year" id="card_year" placeholder="Nhập năm phát hành: 18,19,..." required></div>
                        </div>
                        <?php }?>
                        <?php if ($fields['EXPIRED_MONTH']) {?>
                            <div class="form-group padding-bot-30">
                                <div class="col-md-4"><label for="card_month">Tháng hết hạn</label></div>
                                <div class="col-md-8"><input type="text" pattern="\d*" maxlength="2" class="form-control" name="card_month" id="card_month" placeholder="Nhập tháng hết hạn: 01, 02,..." required></div>
                            </div>
                        <?php }?>
                        <?php if ($fields['EXPIRED_YEAR']) {?>
                            <div class="form-group padding-bot-30">
                                <div class="col-md-4"><label for="card_year">Năm hết hạn</label></div>
                                <div class="col-md-8"><input type="text" pattern="\d*" maxlength="2" class="form-control" name="card_year" id="card_year" placeholder="Nhập năm hết hạn: 18,19,..." required></div>
                            </div>
                        <?php }?>
                        <div class="form-group padding-bot-30">
                            <div class="col-md-4"><label for="amount">Số tiền</label></div>
                            <div class="col-md-8"><input type="number" class="form-control" name="amount" id="amount" required></div>
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
