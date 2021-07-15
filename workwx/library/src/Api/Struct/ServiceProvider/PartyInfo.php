<?php

namespace addons\workwx\library\src\Api\Struct\ServiceProvider;

use addons\workwx\library\src\Utils\Utils;

class PartyInfo
{
    public $id = null;       // uint
    public $writable = null; // bool

    /**
     * @param $arr
     *
     * @return PartyInfo
     */
    static public function ParseFromArray($arr)
    {
        $info = new PartyInfo();

        $info->id = Utils::arrayGet($arr, "id");
        $info->writable = Utils::arrayGet($arr, "writable");

        return $info;
    }
}