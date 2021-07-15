<?php

namespace addons\workwx\library\src\Api\Struct\ExternalContact;

use addons\workwx\library\src\Utils\Error\ParameterError;
use addons\workwx\library\src\Utils\Error\QyApiError;
use addons\workwx\library\src\Utils\Utils;

class Contact
{

    /**
     * @title 获取客户详情
     * @param $arr
     * @return Contact
     */
    static public function Array2Contact($arr)
    {
        $contact = new Contact();
        $contact->external_contact = Utils::arrayGet($arr, "external_contact");
        $contact->follow_user = Utils::arrayGet($arr, "follow_user");
        return $contact;
    }

    /**
     * @title 获取客户列表
     * @param $arr
     * @return array
     */
    static public function Array2ContactList($arr)
    {
        $contactList = $arr["external_userid"];

        return $contactList;
    }




}
