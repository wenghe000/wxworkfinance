<?php

namespace addons\workwx\library\src\Api\Struct\ServiceProvider;

use addons\workwx\library\src\Utils\Utils;

class LoginUserInfo
{
    public $userid = null; // string
    public $name = null;   // string
    public $avatar = null; // string
    public $email = null;  // string

    /**
     * @param $arr
     *
     * @return LoginUserInfo
     */
    static public function ParseFromArray($arr)
    {
        $info = new LoginUserInfo();

        $info->userid = Utils::arrayGet($arr, "userid");
        $info->name = Utils::arrayGet($arr, "name");
        $info->avatar = Utils::arrayGet($arr, "avatar");
        $info->email = Utils::arrayGet($arr, "email");

        return $info;
    }
}
