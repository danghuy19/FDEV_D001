<?php
require 'config.php';
session_start();
if (!empty($_POST)) {
    $_SESSION['SEAMLESS'] = array(
            'payment_method' => $_POST['payment_method'],
            'bank_code' => $_POST['bank_code'],
            'buyer_fullname' => $_POST['buyer_fullname'],
            'buyer_email' => $_POST['buyer_email'],
            'buyer_mobile' => $_POST['buyer_mobile'],
            'buyer_address' => $_POST['buyer_address'],
    );
    header("Location: request.php");
    die();
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
                    <h2>Demo CheckoutSeamless</h2>
                </div>
            </div>
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-info">
                            <div class="panel-heading">Phương thức thanh toán</div>
                            <div class="panel-body">
                                <div class="form-group padding-bot-30">
                                    <div class="col-md-4">
                                        <label for="payment_method">Phương thức</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select class="form-control" name="payment_method" id="payment_method" onchange="get_bank()">
                                            <option value="ATM_ONLINE">Thanh toán bằng thẻ ATM</option>
                                            <option value="IB_ONLINE">Thanh toán bằng tài khoản ngân hàng/Internet Banking</option>
                                            <option value="QRCODE">Thanh toán bằng QRCODE</option>
                                            <option value="CASH_IN_SHOP">Thanh toán tiền mặt tại quầy</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group padding-bot-30">
                                    <div class="col-md-4">
                                        <label for="bank_code">Ngân hàng</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select class="form-control" name="bank_code" id="bank_code">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-info">
                            <div class="panel-heading">Thông tin người mua</div>
                            <div class="panel-body">
                                <div class="form-group padding-bot-30">
                                    <div class="col-md-4"><label for="buyer_fullname">Họ tên</label></div>
                                    <div class="col-md-8"><input type="text" class="form-control" name="buyer_fullname" id="buyer_fullname" value="User Test" required></div>
                                </div>
                                <div class="form-group padding-bot-30">
                                    <div class="col-md-4"><label for="buyer_email">Email</label></div>
                                    <div class="col-md-8"><input type="email" class="form-control" name="buyer_email" id="buyer_email" value="test@gmail.com" required></div>
                                </div>
                                <div class="form-group padding-bot-30">
                                    <div class="col-md-4"><label for="buyer_mobile">Số điện thoại</label></div>
                                    <div class="col-md-8"><input type="number" class="form-control" name="buyer_mobile" id="buyer_mobile" value="0312345678" required></div>
                                </div>
                                <div class="form-group padding-bot-30">
                                    <div class="col-md-4"><label for="buyer_address">Địa chỉ</label></div>
                                    <div class="col-md-8"><input type="text" class="form-control" name="buyer_address" id="buyer_address" value="HN" required></div>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right">Tiếp tục</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </body>
    <script src="asset/jquery-3.4.1.min.js"></script>
    <script type="text/javascript">
        function get_bank()
        {
            $.post(
                'ajax/get_banks.php',
                {payment_method : $('#payment_method').val()},
                function(result){
                    var banks = jQuery.parseJSON(result);
                    $('#bank_code').empty();
                    $.each(banks, function (bank_code, bank_name) {
                        $('#bank_code')
                            .append($('<option>', {
                            value: bank_code,
                            text : bank_code + ' - ' + bank_name
                        }));
                    });
                },
                'text'
            );
        }
        get_bank();
    </script>
</html>
