<?php

namespace addons\workwx\library\src\Api\Struct\CheckinOption;

use addons\workwx\library\src\Utils\Utils;

class WifiMacInfo
{
    public $wifiname = null; // string
    public $wifimac = null;  // string

    /**
     * @param $arr
     *
     * @return WifiMacInfo
     */
    public static function ParseFromArray($arr)
    {
        $info = new WifiMacInfo();

        $info->wifiname = Utils::arrayGet($arr, "wifiname");
        $info->wifimac = Utils::arrayGet($arr, "wifimac");

        return $info;
    }
}