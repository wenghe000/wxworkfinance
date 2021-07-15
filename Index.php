<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;
use \WxworkFinanceSdk;
use wechat\Qywechat;
class Index
{
    public $corpId = "";
    public $secret = "";

    public $privateKey = "";
    public function index()
    {      
        $sq = input("sq") ?: 0;
        
        $dir = ROOT_PATH . "public/uploads/workwx/";
        $domain = "";  // 资源文件域名（如图片本地化的域名地址）

        $msgaudit = include_once(EXTEND_PATH . 'wxwork/library/src/Api/Struct/Msgaudit/Msgaudit.php');
        $msgaudit->call($this->corpId, $this->secret, $this->privateKey);
        // 从第几条取几条数据出来
        $chatList = $msgaudit->getChatData($sq, 50);

        $data = [];
        foreach($chatList as &$val){
            if(isset($val['msgtype'])){
               $path = $dir . $val['msgtype'].'/'.date('Ymd') . '/';
                if(!is_dir($path)){
                    $flag = $this->mkdirs($path);
                }

                $show = $content = '';
                switch ($val['msgtype']) {
                    case 'image':
                        // 图片
                        $sdkFileId = $val[$val['msgtype']]["sdkfileid"];
                        $val[$val['msgtype']]['mediaUrl'] = $domain. "/public/uploads/workwx/{$val['msgtype']}/".date('Ymd')."/{$val['msgid']}.png";
                        $filename = "{$path}{$val['msgid']}.png";

                        $show = $val[$val['msgtype']]['mediaUrl'];
                        $content = json_encode($val[$val['msgtype']]);
                        break;
                    // case 'emotion':
                    //     // 表情
                    //     $sdkFileId = $val[$val['msgtype']]["sdkfileid"];
                    //     if($val['emotion']['type']==1){
                    //         $fileext = 'gif';
                    //     }else{
                    //         $fileext = 'png';
                    //     }
                    //     $val[$val['msgtype']]['mediaUrl'] = $domain. "/public/uploads/workwx/{$val['msgtype']}/".date('Ymd')."/{$val['msgid']}.{$fileext}";
                    //     $filename = "{$path}{$val['msgid']}.{$fileext}";


                    //     $show = $val[$val['msgtype']]['mediaUrl'];
                    //     $content = json_encode($val[$val['msgtype']]);
                    //     break;
                    // case 'voice':
                    //     // 声音
                    //     $sdkFileId = $val['voice']["sdkfileid"];
                    //     $val[$val['msgtype']]['mediaUrl'] = $domain. "/public/uploads/workwx/{$val['msgtype']}/".date('Ymd')."/{$val['msgid']}.amr";
                    //     $filename = "{$path}{$val['msgid']}.amr";

                    //     $show = $val[$val['msgtype']]['mediaUrl'];
                    //     $content = json_encode($val[$val['msgtype']]);
                    //     break;
                    // case 'video':
                    //     // 视频
                    //     $sdkFileId = $val['video']["sdkfileid"];
                    //     $val[$val['msgtype']]['mediaUrl'] = $domain."/public/uploads/workwx/{$val['msgtype']}/".date('Ymd')."/{$val['msgid']}.mp4";
                    //     $filename = "{$path}{$val['msgid']}.mp4";


                    //     $show = $val[$val['msgtype']]['mediaUrl'];
                    //     $content = json_encode($val[$val['msgtype']]);
                    //     break;
                    // case 'file':
                    //     // 文件
                    //     $sdkFileId = $val['file']["sdkfileid"];
                    //     $val[$val['msgtype']]['mediaUrl'] = $domain. "/public/uploads/workwx/{$val['msgtype']}/".date('Ymd')."/{$val['msgid']}.{$val['file']['fileext']}";
                    //     $filename = "{$path}{$val['msgid']}.{$val['file']['fileext']}";


                    //     $show = $val[$val['msgtype']]['mediaUrl'];
                    //     $content = json_encode($val[$val['msgtype']]);
                    //     break;
                    case 'text':
                        $show = $val[$val['msgtype']]['content'];

                        $this->createReply($val);
                        $content = json_encode($val[$val['msgtype']]);
                        break;
                    default:
                        // $show = $val[$val['msgtype']]['content'];
                        if($val['msgtype'] == "docmsg"){
                            $content = json_encode($val["doc"]);
                        }else{
                            $content = isset($val[$val['msgtype']]) ? json_encode($val[$val['msgtype']]) : '';
                        }
                        break;
                }
                if(isset($filename) && !file_exists($filename)){
                    $msgaudit->downloadMedia($sdkFileId, $filename);
                }
                $data[] = [
                    'msgid'   => $val['msgid'],
                    'action'  => $val['action'],
                    'from'    => $val['from'],
                    'tolist'  => json_encode($val['tolist']),
                    'roomid'  => isset($val['roomid']) ? $val['roomid']: '',
                    'msgtime' => $val['msgtime'],
                    'msgtype' => $val['msgtype'],
                    'show'    => $show,
                    'content' => $content,
                    'seq'     => $val['seq'],
                    'addtime' => time(),
                    'adddate' => date('Y-m-d H:i:s'),
                ];

            }
        }

        return $sq + 50;
    }

    public function gettoken()
    {
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid='.$this->corpId.'&corpsecret='.$this->secret.'';
        $token = $this->curl_get($url);
        $token = json_decode($token);
        $arr['access_token'] = $token->access_token;
        $arr['time'] = time();
        $this->access_token = $arr;
        return $arr;
    }

    public function curl_get($url, $second=30,$aHeader=array())
    {
        $ch = curl_init();

        if(stripos($url,"https://")!==FALSE){
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_SSLVERSION, 1);
        }
        curl_setopt($ch,CURLOPT_TIMEOUT,$second);
        curl_setopt($ch,CURLOPT_TIMEOUT,$second);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_URL,$url);
       
        if(count($aHeader) >= 1 ){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
        }
        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $response;
    }

    public function curl_post($url, $vars, $second=30,$aHeader=array())
    {
        $ch = curl_init();

        if(stripos($url,"https://")!==FALSE){
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_SSLVERSION, 1); 
        }
        curl_setopt($ch,CURLOPT_TIMEOUT,$second);
        curl_setopt($ch,CURLOPT_TIMEOUT,$second);//设置cURL允许执行的最长秒数。
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_URL,$url);
    
        if(count($aHeader) >= 1 ){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
        }
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch,CURLOPT_POSTFIELDS,$vars);
        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $response; 
    }

    public function mkdirs($dir)
    {
        if (!is_dir($dir)) {
            if (!$this->mkdirs(dirname($dir))) {
                return FALSE;
            }
            if (!mkdir($dir, 0777, true)) {
                return FALSE;
            }
        }  

        return TRUE;
    }

    public function phpinfo()
    {
        phpinfo();
    }
}
