<?php

namespace addons\workwx\library\src\Api\Struct\User;

use addons\workwx\library\src\Utils\Error\ParameterError;
use addons\workwx\library\src\Utils\Error\QyApiError;
use addons\workwx\library\src\Utils\Utils;

class User
{
    public $userid = "";          // string
    public $name = "";            // string
    public $department = [];      // uint array
    public $open_userid = "";     // string
    /**
     * @param $arr
     *
     * @return User
     */
    static public function Array2User($arr)
    {
        $user = new User();

        $user->userid = Utils::arrayGet($arr, "userid");
        $user->name = Utils::arrayGet($arr, "name");
        $user->department = Utils::arrayGet($arr, "department");
        $user->open_userid = Utils::arrayGet($arr,"open_userid");

        if (array_key_exists("extattr", $arr)) {
            $attrs = $arr["extattr"]["attrs"];
            if (is_array($attrs)) {
                $user->extattr = new ExtattrList();
                foreach ($attrs as $item) {
                    $name = $item["name"];
                    $value = $item["value"];
                    $user->extattr->attrs[] = new ExtattrItem($name, $value);
                }
            }
        }

        return $user;
    }

    /**
     * @param $arr
     *
     * @return User
     */
    static public function Array2UserDetail($arr)
    {
        $user = new User();

        $user->userid = Utils::arrayGet($arr, "userid");
        $user->name = Utils::arrayGet($arr, "name");
        $user->english_name = Utils::arrayGet($arr, "english_name","");
        $user->mobile = Utils::arrayGet($arr, "mobile");
        $user->department = Utils::arrayGet($arr, "department");
        $user->order = Utils::arrayGet($arr, "order");
        $user->position = Utils::arrayGet($arr, "position");
        $user->gender = Utils::arrayGet($arr, "gender");
        $user->email = Utils::arrayGet($arr, "email");
        $user->telephone = Utils::arrayGet($arr, "telephone");
        $user->isleader = Utils::arrayGet($arr, "isleader");
        $user->extattr = Utils::arrayGet($arr,"extattr",[]);
        $user->status = Utils::arrayGet($arr, "status");
        $user->avatar = Utils::arrayGet($arr, "avatar");
        $user->external_profile = Utils::arrayGet($arr,"external_profile");
        $user->main_department = Utils::arrayGet($arr,"main_department");
        $user->qr_code = Utils::arrayGet($arr,"qr_code");
        $user->alias = Utils::arrayGet($arr,"alias");
        $user->is_leader_in_dept = Utils::arrayGet($arr,"is_leader_in_dept");
        $user->address = Utils::arrayGet($arr,"address","");
        $user->thumb_avatar = Utils::arrayGet($arr,"thumb_avatar");


        if (array_key_exists("extattr", $arr)) {
            $attrs = $arr["extattr"]["attrs"];
            if (is_array($attrs)) {
                $user->extattr = new ExtattrList();
                foreach ($attrs as $item) {
                    $name = $item["name"];
                    $value = $item["value"];
                    $user->extattr->attrs[] = new ExtattrItem($name, $value);
                }
            }
        }

        return $user;
    }

    /**
     * * @title 获取部门成员
     * @param $arr
     * @return array
     */
    static public function Array2UserList($arr)
    {
        $userList = $arr["userlist"];

        $retUserList = array();
        if (is_array($userList)) {
            foreach ($userList as $item) {
                $user = User::Array2UserDetail($item);
                $retUserList[] = $user;
            }
        }
        return $retUserList;
    }

    /**
     * @title 获取部门成员
     * @param $arr
     * @return array
     */
    static public function Array2UserSimpleList($arr)
    {
        $userList = $arr["userlist"];

        $retUserList = array();
        if (is_array($userList)) {
            foreach ($userList as $item) {
                $user = User::Array2User($item);
                $retUserList[] = $user;
            }
        }
        return $retUserList;
    }

    /**
     * @param $user
     *
     * @throws ParameterError
     */
    static public function CheckUserCreateArgs($user)
    {
        Utils::checkNotEmptyStr($user->userid, "userid");
        Utils::checkNotEmptyStr($user->name, "name");
        Utils::checkNotEmptyArray($user->department, "department");
    }

    /**
     * @param $user
     *
     * @throws ParameterError
     */
    static public function CheckUserUpdateArgs($user)
    {
        Utils::checkNotEmptyStr($user->userid, "userid");
    }

    /**
     * @param $userIdList
     *
     * @throws ParameterError
     * @throws QyApiError
     */
    static public function CheckuserBatchDeleteArgs($userIdList)
    {
        Utils::checkNotEmptyArray($userIdList, "userid list");
        foreach ($userIdList as $userId) {
            Utils::checkNotEmptyStr($userId, "userid");
        }
        if (count($userIdList) > 200) {
            throw new QyApiError("no more than 200 userid once");
        }
    }

}
