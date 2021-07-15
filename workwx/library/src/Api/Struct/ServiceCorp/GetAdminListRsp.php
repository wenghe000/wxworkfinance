<?php

namespace addons\workwx\library\src\Api\Struct\ServiceCorp;

class GetAdminListRsp
{
    public $admin = null; // AppAdmin array

    /**
     * @param $arr
     *
     * @return GetAdminListRsp
     */
    static public function ParseFromArray($arr)
    {
        $info = new GetAdminListRsp();

        foreach ($arr["admin"] as $item) {
            $info->admin[] = AppAdmin::ParseFromArray($item);
        }

        return $info;
    }
}