<?php


class Msgaudit
{

    /**
     * Msgaudit constructor.
     * @param null $corpId
     * @param null $secret
     * @param null $privateKey
     */
    public function call($corpId = null, $secret = null, $privateKey = null)
    {
        $this->corpId = $corpId;
        $this->secret = $secret;
        $this->privateKey = $privateKey;
        $this->obj = new WxworkFinanceSdk($this->corpId, $this->secret, [
            "timeout" => -2,
        ]);
    }


    public function getChatData($seq = 0, $limit = 100)
    {
        $chats = json_decode($this->obj->getChatData($seq, $limit), true);
        $list = [];
        if($chats['errcode']===0){
            $chatdata = isset($chats['chatdata'])?$chats['chatdata']:[];
            foreach ($chatdata as $val) {
                try {
                    $decryptRandKey = null;
                    openssl_private_decrypt(base64_decode($val['encrypt_random_key']), $decryptRandKey, $this->privateKey, OPENSSL_PKCS1_PADDING);
                    $result = $this->obj->decryptData($decryptRandKey, $val['encrypt_chat_msg']);
                    $result = json_decode($result, true);
                    $result['seq'] = $val['seq'];
                    $list[] = $result;
                } catch (Exception $e) {
                    $path = RUNTIME_PATH. 'log/workwx/'.date('Ym');
                    $ERR_LOG_FILE = $path .'/'.date('d').'.log';
                    $msg = '['.date('Ymd H:i:s').'] '.$val['seq'].': ';
                    $msg .= $e->getMessage()."\r\n";
                    file_put_contents($ERR_LOG_FILE, $msg , FILE_APPEND);
                    file_put_contents($ERR_LOG_FILE, $val['seq'].': '.json_encode($result)."\r\n" , FILE_APPEND);
                    file_put_contents($ERR_LOG_FILE, $e->__toString()."\r\n\r\n" , FILE_APPEND);
                    //echo $e->__toString(); //把错误消息转换为字符串形式
                }
            }
        }
        return $list;
    }

    public function downloadMedia($sdkFileId, $filename)
    {
        $this->obj->downloadMedia($sdkFileId, $filename);
    }

}

$msgaudit = new Msgaudit();
return $msgaudit;

