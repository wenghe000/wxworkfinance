<?php

namespace addons\workwx\library\src\Api\Struct\Pay;

class QueryWorkWxRedpackReq
{
    public $nonce_str = null; // string
    public $sign = null; // string
    public $mch_billno = null; // string
    public $mch_id = null; // string
    public $appid = null; // string
}