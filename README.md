# TWUsa-SDK-PHP

### 安装
> composer require 9peak/twusa-sdk-php


### 使用
```php
# 初始化
$api = new \Peak\SDK\TWUsa (
	$apiKey,
	$apiSecret,
	true // true生产环境，false开发环境，二者请求的url地址不同
);

# 获取库存
# 返回数据请参看： http://vip.twusa.cn/index.php?r=web/wiki/inventory
$res = $api->getInventoryDetail(
	'The Warehouse Usa' , // 仓库名
	'abc,def,gogogo' // sku
);

```

### 构思&续写
