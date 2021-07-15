<?php

namespace addons\workwx\library\src\Api\Struct\ServiceProvider;

use addons\workwx\library\src\Utils\Utils;

class SetAgentScopeRsp
{
    public $invaliduser = null;  // string array
    public $invalidparty = null; // uint array
    public $invalidtag = null;   // uint array

    /**
     * @param $arr
     *
     * @return SetAgentScopeRsp
     */
    static public function ParseFromArray($arr)
    {
        $info = new SetAgentScopeRsp();

        $info->invaliduser = Utils::arrayGet($arr, "invaliduser");
        $info->invalidparty = Utils::arrayGet($arr, "invalidparty");
        $info->invalidtag = Utils::arrayGet($arr, "invalidtag");

        return $info;
    }
}