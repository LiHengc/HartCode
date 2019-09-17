<?php
require_once "vendor/autoload.php";
use Hart\QrCode\HartQrcode;
$hartqrCode = new HartQrcode('ttt');

echo $hartqrCode->hello();
