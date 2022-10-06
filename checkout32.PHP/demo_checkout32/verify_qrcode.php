<?php
require 'config.php';
session_start();

$error = '';
$qr_data = '';
if (isset($_SESSION['SEAMLESS'])) {
    $qr_data = $_SESSION['SEAMLESS']['qr_data'];
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
            <h2>Thanh toán QRCODE</h2>
        </div>
    </div>
    <?php if (!empty($error)) {
        echo '<div class="alert alert-danger">' . $error . '</div>';
    }
    ?>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <div class="col-md-6 col-md-offset-3">
                        <img src='data:image/png;base64,<?php echo $qr_data;?>'/>
                    </div>
                    <div class="col-md-12">
                        <p style="font-size: 18px;font-weight: bold;">You need to scan QR Code by Mobile Banking App to complete the payment.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="asset/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
</script>
</html>
