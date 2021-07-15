# wxworkfinance
企业微信会话存档

# 基础
thinkphp 框架
企业微信提供的LINUX版的c语言sdk;
PHP VERSION >= 7.0

# 安装方法
1,把企业微信提供linux版c语言sdk复制到目录library/src/Api/Struct/Msgaudit中

2,执行以下命令将（/www/wwwroot/apim2ecn/表示你thinkphp的运行路径，extend是thinkphp的扩展功能路径，/www/server/php/70/bin/phpize是php编译工具路径）

cd /www/wwwroot/apim2ecn/extend/workwx/library/src/Api/Struct/Msgaudit

/www/server/php/70/bin/phpize
./configure  --with-php-config=/www/server/php/70/bin/php-config --with-wxwork-finance-sdk="/www/wwwroot/apim2ecn/extend/workwx/library/src/Api/Struct/Msgaudit/c_sdk"

make && make install

3,编辑PHP.ini
编辑php.ini，添加extension = wxwork_finance_sdk.so扩展

4, 重启php服务，在phpinfo里面能看到wxworkfinance扩展表示安装扩展成功

# 使用方法

$msgaudit = include_once(EXTEND_PATH . 'wxwork/library/src/Api/Struct/Msgaudit/Msgaudit.php');

$msgaudit->call($this->corpId, $this->secret, $this->privateKey);

$chatList = $msgaudit->getChatData($sq, 50);

如果提升核心类找不到，就在类前面添加 use \WxworkFinanceSdk;

# 参考来源
基于https://github.com/pangdahua/php7-wxwork-finance-sdk

# 联系我

如果使用过程有其他疑问，请联系我（wx：weng_wowojing）一起探讨。
