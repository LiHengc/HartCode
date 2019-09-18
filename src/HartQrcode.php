<?php


namespace Hart\QrCode;

use Endroid\QrCode\QrCode;

define('DS', DIRECTORY_SEPARATOR);
defined('VENDOR_PATH') or define('VENDOR_PATH', $_SERVER['DOCUMENT_ROOT'] . DS . 'vendor' . DS);

class HartQrcode
{
    private $url;
    private $save_path;
    private $en_qrcode_name;
    private $suttfix = '.png';
    private $bgfile;
    private $qrcode;
    private $bg_qrcode;
    private $save;


    /**
     * HartQrcode constructor.
     * @param string $url
     * @param string $bgfile
     * @throws \Exception
     */
    public function __construct($url = 'http://www.baidu.com', $bgfile = "", $save = false)
    {
        error_reporting(0);

        $this->url = $url;

        $this->save = $save;

        $this->bgfile = $_SERVER['DOCUMENT_ROOT'] . DS . $bgfile;

        $this->save_path = $this->get_root_path();

        $this->en_qrcode_name = self::randString(11);

        self::checkPath($this->save_path);

    }


    /**
     *
     */
    public function __destruct()
    {
        // TODO: Implement __destruct() method.

        try {

            if (!$this->save){

                unlink($this->save_path . $this->en_qrcode_name . $this->suttfix);

            }

        } catch (\Exception $e) {

        }
    }

    /**
     * @param int $size
     * @throws \Endroid\QrCode\Exception\InvalidPathException
     */
    public function create_qrcode($size = 200)
    {
        $qrCode = new QrCode();

        $qrCode->setText($this->url)
            ->setSize($size)//大小

            ->setLabelFontPath(VENDOR_PATH . 'endroid' . DS . 'qrcode' . DS . 'assets' . DS . 'noto_sans.otf')
            ->setErrorCorrectionLevel('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
            ->setLabelFontSize(16);

        $qrCode->writeFile($this->save_path . $this->en_qrcode_name . $this->suttfix);

        $this->qrcode = $qrCode->writeString();

    }

    /**
     * @param int $x
     * @param int $y
     * @param int $qrcode_size
     * @throws \Exception
     */
    public function create_bg_qrcode($x = 260, $y = 700, $qrcode_size = 300)
    {
        $backgroup_img = imagecreatefromstring(file_get_contents($this->bgfile));

        if (!$backgroup_img) {

            throw  new \Exception("背景图路径错误,请填写项目相对路径");

        }

        $QRcode = imagecreatefromstring(file_get_contents($this->save_path . $this->en_qrcode_name . $this->suttfix));

        if (!$QRcode) {

            throw  new \Exception("请先生产二维码");

        }
        //获取新的尺寸

        list($width, $height) = getimagesize($this->save_path . $this->en_qrcode_name . $this->suttfix);

        $new_width = $qrcode_size;

        $new_height = $qrcode_size;

        //重新组合图片并调整大小

        imagecopyresampled($backgroup_img, $QRcode, $x, $y, 0, 0, $new_width, $new_height, $width, $height);//输出图片

        imagepng($backgroup_img, $this->save_path . $this->en_qrcode_name . $this->suttfix);

        $bg_qrcode = file_get_contents($this->save_path . $this->en_qrcode_name . $this->suttfix);

        $this->bg_qrcode = $bg_qrcode;

    }

    /**
     *
     */
    public function get_qrcode()
    {
        ob_clean();

        header("content-type: image/png");

        echo $this->qrcode;

        die;
    }

    /**
     *
     */
    public function get_bg_qrcode()
    {
        ob_clean();

        header("content-type: image/png");

        echo $this->bg_qrcode;

        die;
    }

    /**
     * @return string
     */
    public function get_qrcode_path()
    {
        return $this->save_path . $this->en_qrcode_name . $this->suttfix;
    }

    /**
     * @return string
     */
    public function get_root_path()
    {
        if ($_SERVER['DOCUMENT_ROOT']) {

            return $_SERVER['DOCUMENT_ROOT'] . "/qrcodetmp/";

        } else {

            return __DIR__ . '/qrcodetmp/';

        }
    }

    /**
     * @param String $path
     * @return bool
     * @throws \Exception
     */
    public static function checkPath($path)
    {
        if (is_dir($path) || mkdir($path, 0755, true)) {

            return true;

        } else {

            throw new \Exception("没有权限进行写操作");

        }

    }

    /**
     * @param int $length
     * @return String
     */
    public static function randString($length)
    {
        $allstring = "QAZWSXEDCRFVTGBYHNUJMIKOLP1234567890qazwsxedcrfvtgbyhnujmikolp";

        $netstring = "";

        for ($length; $length > 0; $length--) {

            $randStart = 0;

            $randEnd = strlen($allstring);

            $rand = rand($randStart, $randEnd);

            $str = substr($allstring, $rand, 1);

            $netstring .= $str;

        }

        return $netstring;
    }


}
