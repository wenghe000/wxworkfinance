<?php

namespace addons\workwx\library\src\Api\Struct\Message;

use addons\workwx\library\src\Utils\Error\QyApiError;
use addons\workwx\library\src\Utils\Utils;

class NewsMessageContent
{
    public $msgtype = "news";
    public $articles = array(); // NewsArticle array

    /**
     * NewsMessageContent constructor.
     *
     * @param $articles
     */
    public function __construct($articles)
    {
        $this->articles = $articles;
    }

    /**
     * @throws QyApiError
     */
    public function CheckMessageSendArgs()
    {
        $size = count($this->articles);
        if ($size < 1 || $size > 8) throw new QyApiError("1~8 articles should be given");

        foreach ($this->articles as $item) {
            $item->CheckMessageSendArgs();
        }
    }

    /**
     * @param $arr
     */
    public function MessageContent2Array(&$arr)
    {
        Utils::setIfNotNull($this->msgtype, "msgtype", $arr);

        $articleList = array();
        foreach ($this->articles as $item) {
            $articleList[] = $item->Article2Array();
        }
        $arr[$this->msgtype]["articles"] = $articleList;
    }
}