<?php
require_once "vendor/autoload.php";
use Hart\QrCode\HartQrcode;
$hartqrCode = new HartQrcode('ttt','v1.png',true);
$hartqrCode->create_qrcode();
$hartqrCode->create_bg_qrcode();
$hartqrCode->get_bg_qrcode();
