<?php

namespace addons\workwx\library\src\Api\Struct\ServiceProvider;

use addons\workwx\library\src\Utils\Utils;

class LoginAgentInfo
{
    public $agentid = null;   // uint
    public $auth_type = null; // uint

    /**
     * @param $arr
     *
     * @return LoginAgentInfo
     */
    static public function ParseFromArray($arr)
    {
        $info = new LoginAgentInfo();

        $info->agentid = Utils::arrayGet($arr, "agentid");
        $info->auth_type = Utils::arrayGet($arr, "auth_type");

        return $info;
    }
}