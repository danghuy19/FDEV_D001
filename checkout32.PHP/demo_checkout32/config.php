<?php
date_default_timezone_set('Asia/Bangkok'); // Set Time Zone required tu PHP 5
ini_set('display_errors', true);
require_once 'component/SeamlessCheckout.php';

define('ROOT_PATH', dirname(__FILE__));
define('DS', str_replace('\\', '/', DIRECTORY_SEPARATOR));

define('NL_ENDPOINT', 'https://www.nganluong.vn/checkoutseamless.api.nganluong.post.php');
define('MERCHANT_ID', ''); //Ma merchant ket noi Ngan Luong
define('MERCHANT_PASSWORD', ''); // Mat khau ket noi
define('RECEIVER_EMAIL', ''); //Email tai khoan Ngan Luong
define('VERSION', '3.2');