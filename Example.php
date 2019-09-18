<?php

require_once "vendor/autoload.php";

use Hart\QrCode\HartQrcode;

$hartqrCode = new HartQrcode('http://www.baidu.com', 'v1.png', false);
$hartqrCode->create_qrcode();
$hartqrCode->create_bg_qrcode();
$hartqrCode->get_bg_qrcode();
