## 博客地址

https://www.zhangweijiang.com

## 企业微信-会话内容存档PHP扩展

https://www.zhangweijiang.com/article/152.html


## 依赖
企业微信提供的sdk;

PHP VERSION >= 7.0

openssl扩展

## 安装步骤及要求
```
# php的安装目录
INSATLL_PATH_PATH="/alidata/server/php"
# workwx的php扩展的目录(项目TP5的目录在/alidata/www/seo下，workwx扩展放extend下)
WXWORK_FINANCE_PATH="/alidata/www/seo/extend/workwx/library/src/Api/Struct/Msgaudit"
# php扩展的c语言sdk目录
WXWORK_FINANCE_C_SDK_PATH="${WXWORK_FINANCE_PATH}/c_sdk"
# 进入workwx的php扩展的目录
cd $WXWORK_FINANCE_PATH
# 通过phpize可以建立php的外挂模块
$INSATLL_PATH_PATH/bin/phpize
# 配置编译环境
./configure --with-php-config=$INSTALL_PHP_PATH/bin/php-config --with-wxwork-finance-sdk=$WXWORK_FINANCE_C_SDK_PATH
# 编译和安装       
make && make install
```
    php.ini 增加 extension=wxwork_finance_sdk.so

## API
```php
    WxworkFinanceSdkExcption::__construct();
```

```php
    WxworkFinanceSdk::__construct(string $corpId, string $secret, array $options);
    string $corpId 企业号

    string $secret 秘钥

    array $options = [ // 可选参数
        'proxy_host' => string,
        'proxy_password' => string,
        'timeout' => 10, // 默认超时时间为10s
    ]
```

```php
   string WxworkFinanceSdk::getChatData(int $seq, int $limit);
    * 拉取聊天数据
    $seq 起始位置
    $limit 获取条数
```

```php
   bool WxworkFinanceSdk::downloadMedia(string $fileId, string $savePath = '')
```

```php
  string WxworkFinanceSdk::decryptData(string $randomKey, string $encryptStr);
```

 ## 示例

 安装tp5环境

复制以下代码到application/index/controller下

```
		// 企业ID
		$corpId = "w****";
		// 会话内容存档Secret
        $secret = "****";
        // 消息加密私钥
        $privateKey = "-----BEGIN PRIVATE KEY-----
***
-----END PRIVATE KEY-----";
        $msgaudit = include_once(EXTEND_PATH . 'workwx/library/src/Api/Struct/Msgaudit/Msgaudit.php');
        $msgaudit->call($corpId, $secret, $privateKey);
        // 从第几条取几条数据出来
        $chatList = $msgaudit->getChatData(0, 20);
        $workwx_name = 'hrhgtest';
        $dir = ROOT_PATH . "public/uploads/workwx/{$workwx_name}/";
        $domain = $this->request->domain();
        foreach($chatList as &$val){
            if(isset($val['msgtype'])){
                $path = $dir . $val['msgtype'].'/'.date('Ym').'/'.date('d').'/';
                if(!is_dir($path)){
                    $flag = mkdir($path,0777,true);
                }
                switch ($val['msgtype']) {
                    case 'image':
                        // 图片
                        $sdkFileId = $val[$val['msgtype']]["sdkfileid"];
                        $val[$val['msgtype']]['mediaUrl'] = $domain. "/uploads/workwx/{$workwx_name}/{$val['msgtype']}/".date('Ym')."/".date('d')."/{$val['msgid']}.png";
                        $filename = "{$path}{$val['msgid']}.png";
                        break;
                    case 'emotion':
                        // 表情
                        $sdkFileId = $val[$val['msgtype']]["sdkfileid"];
                        if($val['emotion']['type']==1){
                            $fileext = 'gif';
                        }else{
                            $fileext = 'png';
                        }
                        $val[$val['msgtype']]['mediaUrl'] = $domain. "/uploads/workwx/{$workwx_name}/{$val['msgtype']}/".date('Ym')."/".date('d')."/{$val['msgid']}.{$fileext}";
                        $filename = "{$path}{$val['msgid']}.{$fileext}";
                        break;
                    case 'voice':
                        // 声音
                        $sdkFileId = $val['voice']["sdkfileid"];
                        $val[$val['msgtype']]['mediaUrl'] = $domain. "/uploads/workwx/{$workwx_name}/{$val['msgtype']}/".date('Ym')."/".date('d')."/{$val['msgid']}.amr";
                        $filename = "{$path}{$val['msgid']}.amr";
                        break;
                    case 'video':
                        // 视频
                        $sdkFileId = $val['video']["sdkfileid"];
                        $val[$val['msgtype']]['mediaUrl'] = $domain."/uploads/workwx/{$workwx_name}/{$val['msgtype']}/".date('Ym')."/".date('d')."/{$val['msgid']}.mp4";
                        $filename = "{$path}{$val['msgid']}.mp4";
                        break;
                    case 'file':
                        // 文件
                        $sdkFileId = $val['file']["sdkfileid"];
                        $val[$val['msgtype']]['mediaUrl'] = $domain. "/uploads/workwx/{$workwx_name}/{$val['msgtype']}/".date('Ym')."/".date('d')."/{$val['msgid']}.{$val['file']['fileext']}";
                        $filename = "{$path}{$val['msgid']}.{$val['file']['fileext']}";
                        break;
                    default:
                        break;
                }
                if(isset($filename) && !file_exists($filename)){
                    $msgaudit->downloadMedia($sdkFileId, $filename);
                }
            }
        }
        unset($val);
        dump($chatList);
```

