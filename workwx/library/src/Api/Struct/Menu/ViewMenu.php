<?php

namespace addons\workwx\library\src\Api\Struct\Menu;

use addons\workwx\library\src\Utils\Utils;

class ViewMenu
{
    public $type = "view";
    public $name = null; // string
    public $url = null;  // string

    /**
     * viewMenu constructor.
     *
     * @param null $name
     * @param null $url
     */
    public function __construct($name = null, $url = null)
    {
        $this->name = $name;
        $this->url = $url;
    }

    /**
     * @param $arr
     *
     * @return ViewMenu
     */
    public static function Array2Menu($arr)
    {
        $menu = new viewMenu();

        $menu->type = "view";
        $menu->name = Utils::arrayGet($arr, "name");
        $menu->url = Utils::arrayGet($arr, "url");

        return $menu;
    }
}