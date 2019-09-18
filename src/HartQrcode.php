<?php


namespace Hart\QrCode;


class HartQrcode
{
    private $name;

    public function __construct($name = 'World')
    {
        $this->name = $name;
    }

    public function hello()
    {
        return 'Hello ' . $this->name;
    }

    /**
     * @return string
     */
    public function yii()
    {
        return 'yii ' . $this->name;
    }

}
