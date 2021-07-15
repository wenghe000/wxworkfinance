<?php

namespace addons\workwx\library\src\Api\Struct\CheckinOption;

use addons\workwx\library\src\Utils\Utils;

class CheckinInfo
{
    public $userid = null; // string
    public $group = null;  // CheckinGroup

    /**
     * @param $arr
     *
     * @return CheckinInfo
     */
    static public function ParseFromArray($arr)
    {
        $info = new CheckinInfo();

        $info->userid = Utils::arrayGet($arr, "userid");
        $info->group = CheckinGroup::ParseFromArray($arr["group"]);

        return $info;
    }
}