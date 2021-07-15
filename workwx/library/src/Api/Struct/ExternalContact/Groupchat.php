<?php

namespace addons\workwx\library\src\Api\Struct\ExternalContact;

use addons\workwx\library\src\Utils\Error\ParameterError;
use addons\workwx\library\src\Utils\Error\QyApiError;
use addons\workwx\library\src\Utils\Utils;

class Groupchat
{

    /**
     * @title 获取客户详情
     * @param $arr
     * @return Contact
     */
    static public function Array2Groupchat($arr)
    {
        return $arr['group_chat'];
    }

    /**
     * @title 获取客户列表
     * @param $arr
     * @return array
     */
    static public function Array2GroupchatList($arr)
    {
        $groupchatList = $arr['group_chat_list'];

        return $groupchatList;
    }




}
