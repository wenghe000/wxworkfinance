<?php

namespace addons\workwx\library\src\Api\Struct\CheckinOption;

use addons\workwx\library\src\Utils\Utils;

class LocInfo
{
    public $lat = null;        // uint
    public $lng = null;        // uint
    public $loc_title = null;  // string
    public $loc_detail = null; // string
    public $distance = null;   // uint

    /**
     * @param $arr
     *
     * @return LocInfo
     */
    public static function ParseFromArray($arr)
    {
        $info = new LocInfo();

        $info->lat = Utils::arrayGet($arr, "lat");
        $info->lng = Utils::arrayGet($arr, "lng");
        $info->loc_title = Utils::arrayGet($arr, "loc_title");
        $info->loc_detail = Utils::arrayGet($arr, "loc_detail");
        $info->distance = Utils::arrayGet($arr, "distance");

        return $info;
    }
}