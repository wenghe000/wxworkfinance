<?php

namespace addons\workwx\library\src\Api\Struct\Message;

use addons\workwx\library\src\Utils\Error\QyApiError;
use addons\workwx\library\src\Utils\Utils;

class MarkdownMessageContent
{
    public $msgtype = "markdown";
    private $content = null; // string

    /**
     * TextMessageContent constructor.
     *
     * @param null $content
     */
    public function __construct($content = null)
    {
        $this->content = $content;
    }

    /**
     * @throws QyApiError
     */
    public function CheckMessageSendArgs()
    {
        $len = strlen($this->content);
        if ($len == 0 || $len > 2048) {
            throw new QyApiError("invalid content length " . $len);
        }
    }

    /**
     * @param $arr
     */
    public function MessageContent2Array(&$arr)
    {
        Utils::setIfNotNull($this->msgtype, "msgtype", $arr);

        $contentArr = array("content" => $this->content);
        Utils::setIfNotNull($contentArr, $this->msgtype, $arr);
    }
}