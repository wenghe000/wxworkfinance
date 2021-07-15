<?php

namespace addons\workwx\library\src\Api\Struct\CheckinOption;

class CheckinOption
{
    public $info = null; // CheckinInfo array

    /**
     * @param $arr
     *
     * @return CheckinOption
     */
    static public function ParseFromArray($arr)
    {
        $info = new CheckinOption();

        foreach ($arr["info"] as $item) {
            $info->info[] = CheckinInfo::ParseFromArray($item);
        }

        return $info;
    }
}