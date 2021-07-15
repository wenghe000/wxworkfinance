<?php

namespace addons\workwx\library\src\Api\Struct\ServiceCorp;

use addons\workwx\library\src\Utils\Utils;

class AgentBriefEx
{
    public $agentid = null;         // uint
    public $name = null;            // string
    public $round_logo_url = null;  // string
    public $square_logo_url = null; // string
    public $appid = null;           // uint
    public $privilege = null;       // AgentPrivilege

    /**
     * @param $arr
     *
     * @return AgentBriefEx
     */
    static public function ParseFromArray($arr)
    {
        $info = new AgentBriefEx();

        $info->agentid = Utils::arrayGet($arr, "agentid");
        $info->name = Utils::arrayGet($arr, "name");
        $info->round_logo_url = Utils::arrayGet($arr, "round_logo_url");
        $info->square_logo_url = Utils::arrayGet($arr, "square_logo_url");
        $info->appid = Utils::arrayGet($arr, "appid");

        if (array_key_exists("privilege", $arr)) {
            $info->privilege = AgentPrivilege::ParseFromArray($arr["privilege"]);
        }

        return $info;
    }
}