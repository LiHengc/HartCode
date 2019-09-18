Hart QR Code
==============
快速生产带背景的二维码，他为你提供了以下功能
- 生产原始二维码，可配置url或则text，以及二维码大小
- 生产带背景带二维码，背景大小是你传入带背景大小，可配置原始二维码大小，原始二维码在背景当中当位置
- 可以直接返回二维码，也可以保存到路径当中

## 安装

选择 [Composer](https://getcomposer.org/) 进行安装

``` bash
$ composer require liheng/hart-qr-code
```


## [使用](https://github.com/LiHengc/HartCode)
```php
use Hart\QrCode\HartQrcode;

//初始化
/*
 * $url = 'http://www.baidu.com' 
 * $path = "v1.png"; 背景地址
 * $save = false; 是否保存到目录
 */
$hartqrCode = new HartQrcode($url, $path, $save);

//创建原始二维码 必须
$hartqrCode->create_qrcode($size = 200);

//获取原始二维码
$hartqrCode->get_qrcode();

//创建带背景图的二维码 
$hartqrCode->create_bg_qrcode($x = 260, $y = 700, $qrcode_size = 300);

//获取带背景图带二维码
$hartqrCode->get_bg_qrcode();

//获取带背景图的二维码路径 如果没有创建带背景图的二维码 则获取的是原始二维码地址
$hartqrCode->get_qrcode_path();

```


## lssues
如果有哪里不足或者报错，以及更好的意见请通过[lssues](https://github.com/LiHengc/HartCode/issues)提交
