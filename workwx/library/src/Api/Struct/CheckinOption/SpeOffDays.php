<?php

namespace addons\workwx\library\src\Api\Struct\CheckinOption;

use addons\workwx\library\src\Utils\Utils;

class SpeOffDays
{
    public $timestamp = null;   // uint
    public $notes = null;       // string
    public $checkintime = null; // CheckinTime array

    /**
     * @param $arr
     *
     * @return SpeOffDays
     */
    public static function ParseFromArray($arr)
    {
        $info = new SpeOffDays();

        $info->timestamp = Utils::arrayGet($arr, "timestamp");
        $info->notes = Utils::arrayGet($arr, "notes");

        foreach ($arr["checkintime"] as $item) {
            $info->checkintime[] = CheckinTime::ParseFromArray($item);
        }

        return $info;
    }
}