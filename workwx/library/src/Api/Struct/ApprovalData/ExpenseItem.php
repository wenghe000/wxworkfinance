<?php

namespace addons\workwx\library\src\Api\Struct\ApprovalData;

use addons\workwx\library\src\Utils\Utils;

class ExpenseItem
{
    public $expenseitem_type = null; // int
    public $time = null;             // int
    public $sums = null;             // int
    public $reason = null;           // string

    /**
     * @param $arr
     *
     * @return ExpenseItem
     */
    static public function ParseFromArray($arr)
    {
        $info = new ExpenseItem();

        $info->expenseitem_type = Utils::arrayGet($arr, "expenseitem_type");
        $info->time = Utils::arrayGet($arr, "time");
        $info->sums = Utils::arrayGet($arr, "sums");
        $info->reason = Utils::arrayGet($arr, "reason");

        return $info;
    }
}