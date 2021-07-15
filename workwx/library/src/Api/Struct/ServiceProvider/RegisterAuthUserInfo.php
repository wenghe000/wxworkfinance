<?php

namespace addons\workwx\library\src\Api\Struct\ServiceProvider;

use addons\workwx\library\src\Utils\Utils;

class RegisterAuthUserInfo
{
    public $email = null;  // string
    public $mobile = null; // string
    public $userid = null; // string

    /**
     * @param $arr
     *
     * @return RegisterAuthUserInfo
     */
    static public function ParseFromArray($arr)
    {
        $info = new RegisterAuthUserInfo();

        $info->email = Utils::arrayGet($arr, "email");
        $info->mobile = Utils::arrayGet($arr, "mobile");
        $info->userid = Utils::arrayGet($arr, "userid");

        return $info;
    }
}