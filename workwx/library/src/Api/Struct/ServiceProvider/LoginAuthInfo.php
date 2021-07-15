<?php

namespace addons\workwx\library\src\Api\Struct\ServiceProvider;

class LoginAuthInfo
{
    public $department = null; // PartyInfo Array

    /**
     * @param $arr
     *
     * @return LoginAuthInfo
     */
    static public function ParseFromArray($arr)
    {
        $info = new LoginAuthInfo();

        foreach ($arr["department"] as $item) {
            $info->department[] = PartyInfo::ParseFromArray($item);
        }
        return $info;
    }
}