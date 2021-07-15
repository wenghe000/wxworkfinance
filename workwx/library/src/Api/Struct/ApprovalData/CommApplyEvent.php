<?php

namespace addons\workwx\library\src\Api\Struct\ApprovalData;

use addons\workwx\library\src\Utils\Utils;

class CommApplyEvent
{
    public $apply_data = null; // string

    /**
     * @param $arr
     *
     * @return CommApplyEvent
     */
    static public function ParseFromArray($arr)
    {
        $info = new CommApplyEvent();

        $info->apply_data = Utils::arrayGet($arr, "apply_data");

        return $info;
    }
}