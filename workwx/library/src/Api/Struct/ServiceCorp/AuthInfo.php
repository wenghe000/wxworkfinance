<?php

namespace addons\workwx\library\src\Api\Struct\ServiceCorp;

use addons\workwx\library\src\Api\Struct\AgentBriefEx;

class AuthInfo
{
    public $agent = null; // AgentBriefEx array

    /**
     * @param $arr
     *
     * @return AuthInfo
     */
    static public function ParseFromArray($arr)
    {
        $info = new AuthInfo();

        foreach ($arr["agent"] as $item) {
            $info->agent[] = AgentBriefEx::ParseFromArray($item);
        }

        return $info;
    }
}