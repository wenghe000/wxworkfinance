<?php

namespace addons\workwx\library\src\Api\Struct\ServiceProvider;

use addons\workwx\library\src\Utils\Error\ParameterError;
use addons\workwx\library\src\Utils\Utils;

class GetRegisterCodeReq
{
    public $template_id = null;  // string
    public $corp_name = null;    // string
    public $admin_name = null;   // string
    public $admin_mobile = null; // string

    /**
     * @return array
     * @throws ParameterError
     */
    public function FormatArgs()
    {
        Utils::checkNotEmptyStr($this->template_id, "template_id");

        $args = array();

        Utils::setIfNotNull($this->template_id, "template_id", $args);
        Utils::setIfNotNull($this->corp_name, "corp_name", $args);
        Utils::setIfNotNull($this->admin_name, "admin_name", $args);
        Utils::setIfNotNull($this->admin_mobile, "admin_mobile", $args);

        return $args;
    }
}