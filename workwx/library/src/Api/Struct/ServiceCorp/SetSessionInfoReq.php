<?php

namespace addons\workwx\library\src\Api\Struct\ServiceCorp;

use addons\workwx\library\src\Utils\Error\ParameterError;
use addons\workwx\library\src\Utils\Utils;

class SetSessionInfoReq
{
    public $pre_auth_code = null; // string
    public $session_info = null;  // SessionInfo

    /**
     * @return array
     * @throws ParameterError
     */
    public function FormatArgs()
    {
        Utils::checkNotEmptyStr($this->pre_auth_code, "pre_auth_code");

        $args = array();

        $args["pre_auth_code"] = $this->pre_auth_code;
        $args["session_info"] = $this->session_info->FormatArgs();

        return $args;
    }
}