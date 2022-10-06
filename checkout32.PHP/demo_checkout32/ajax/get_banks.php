<?php
require_once '../config.php';

$banks = '';
if (isset($_POST['payment_method'])) {
    $banks = SeamlessCheckout::getBanksByPaymentMethod($_POST['payment_method']);
}
echo json_encode($banks);