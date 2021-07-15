<?php

namespace addons\workwx\library\src\Api\Struct\ServiceProvider;

use addons\workwx\library\src\Utils\Utils;

class SetAgentScopeReq
{
    public $agentid = null;     // uint
    public $allow_user = null;  // string array
    public $allow_party = null; // uint array
    public $allow_tag = null;   // uint array

    /**
     * @return array
     */
    public function FormatArgs()
    {
        $args = array();

        Utils::setIfNotNull($this->agentid, "agentid", $args);
        Utils::setIfNotNull($this->allow_user, "allow_user", $args);
        Utils::setIfNotNull($this->allow_party, "allow_party", $args);
        Utils::setIfNotNull($this->allow_tag, "allow_tag", $args);

        return $args;
    }
}