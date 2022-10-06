<?php
require_once 'config.php';

$success = true;
if (!empty($_GET)) {
    $error_code = $_GET['error_code'];
    $token = $_GET['token']; //token nganluong
    $order_code = $_GET['order_code']; //order_code merchant
    $order_id = $_GET['order_id']; //order_id nganluong

    if ($error_code == '00') {
        $result_get_transaction_detail = SeamlessCheckout::getTransactionDetail(array('token' => $token));
        if ($result_get_transaction_detail['error_code'] == '00' && $result_get_transaction_detail['transaction_status'] == '00') {
            //thanh toan thanh cong
            echo '<pre>';
            print_r($result_get_transaction_detail);
            echo '</pre>';
            //TODO: cap nhat trang thai don hang merchant thanh cong
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
</head>
<body>
<?php if ($success) {
    echo '<div class="alert alert-success">Thanh toán thành công</div>';
}?>
</body>
</html>
