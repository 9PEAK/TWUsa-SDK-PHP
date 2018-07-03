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
$res = $api->getInventoryDetail(
	'The Warehouse Usa' , // 仓库名
	'abc,def,gogogo' // sku
);

# 返回数据请参看： http://vip.twusa.cn/index.php?r=web/wiki/inventory
if ( $res) {
	// 请求成功
	$dat = $api->result;
} else {
	// 请求失败
	print_r($api->result);
}

```

### 编写
SDK由三部分组成
<ul>
	<li>内核</li>
	<li>内核模块（内置的方法对接美仓API）</li>
	<li>调用层（外部调用）</li>
</ul>

![avatar](http://storage-qiniu.9peak.net/9peak-twusa-sdk-php.png)

后续开发无需关心“内核”，只需要专注调用层和内核模块。

>> 内核模块

