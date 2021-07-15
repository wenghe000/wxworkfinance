<?php

namespace addons\workwx\library\src\Api\Struct\ServiceProvider;

use addons\workwx\library\src\Utils\Utils;

class LoginCorpInfo
{
    public $corpid = null; // string

    /**
     * @param $arr
     *
     * @return LoginCorpInfo
     */
    static public function ParseFromArray($arr)
    {
        $info = new LoginCorpInfo();

        $info->corpid = Utils::arrayGet($arr, "corpid");

        return $info;
    }
}