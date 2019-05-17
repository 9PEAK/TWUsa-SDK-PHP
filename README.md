# TWUsa-SDK-PHP

美仓互联TWUsa SDK包，API文档：http://vip.twusa.cn/index.php?r=web/wiki/index 。

### 安装
> composer require 9peak/twusa-sdk-php


### 使用
初始化[直接实例化]
```php
$sdk = new \Peak\SDK\TWUsa (
	$apiKey,
	$apiSecret,
	true // true生产环境，false开发环境，二者域名和协议有别
);
```

初始化[自动依赖注入，目前仅支持Laravel]<br>
配置 config\services.php 
```php
return [
    // ...
    // 加入AK和AS配置
    'twusa' => [
        'key' => env('TWUSA_AMZ_KEY', 'xxxx'),
        'secret' => env('TWUSA_AMZ_SECRET', 'xxxx')
    ],
]
```

配置 \App\Providers\AppServiceProvider.php 
```php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    // 加入Provider
	use \Peak\SDK\TWUsa\ServiceProvider;

    public function register()
    {
        // 注册SDK
        $this->peakRegisterTWUsaSdk();
        // ...
    }

    // ...
}
```

模式切换

```php
// 使用mode方法进行切换，支持链式调用
$sdk->mode(true) // 生产环境正式账号
    ->mode(false); // 测试环境测试账号
```


参数设置&接口请求

```php
# 简单接口：获取库存
$res = $sdk->getInventoryDetail(
	'The Warehouse Usa' , // 仓库名
	'abc,def,gogogo' // sku
);


# 复杂接口：创建出库单
$dat = []; // 预设参数
// 参数设置方法通常是set开头，并且支持链式调用
$res = $sdk->setStoreName('abc', $dat)
    ->setOutboundOrderOrderSn('order-1', $dat)
    ->setOutboundOrderIsCheck(false', $dat)
    ->setOutboundOrderOutflowTime('2019-09-09', $dat)
    ->setOutboundOrderRemark('备注', $dat)
    ->setOutboundOrderBusinessType(1', $dat)
    ->setOutboundOrderTransportId('sto-20190909-a', $dat)
    ->setOutboundOrderShipmethod(1, $dat)
    ->setOutboundOrderPackageType(2, $dat)
    ->setOutboundOrderName('特朗普', $dat)
    ->setOutboundOrderTel('0123456789', $dat)
    ->setOutboundOrderPostCode(66666, $dat)
    ->setOutboundOrderAddress('华盛顿大道白宫3楼椭圆型办公室', $dat)
    ->setOutboundOrderCountry('US', $dat)
    ->setOutboundOrderProvince('WD', $dat)
    ->setOutboundOrderCity('DC', $dat)
    ->setOutboundOrderBillType('第三方平台支付', $dat)
    ->setOutboundOrderForecastApplyPackage('使用仓库箱子', $dat)
    ->setOutboundOrderPackageMethodEditable(false', $dat)
// 请求方法通常是add、get等开头，返回bool
    ->addOutboundOrder(
        $dat,
        [
            $sdk->setOutboundOrderProduct('sku1', 1, 1),
            $sdk->setOutboundOrderProduct('sku2', 2, 2),
            $sdk->setOutboundOrderProduct('sku3', 3, 3),
        ]
    );
    

if ( $res) {
	// 请求成功
	$dat = $api->result;
} else {
	// 请求失败
	print_r($api->result);
}
```

### 扩展
SDK暂时不支持全部接口，开发者可自行对其扩展；根据官方的API文档，SDK基于其业务拆分成下列组件，建议沿用该方式扩展编码。 <br>
组件置于 \Peak\SDK\TWUsa\Component 之中，集成于 \Peak\SDK\TWUsa\Core.php。
```php
namespace Peak\SDK\TWUsa;

class Core
{
    // code...
    
    # 组件
	use Common, // 公用组件
		DIR\Outbound, // 出库单
		DIR\Inbound, // 入库单
		DIR\Inventory, // 库存
		DIR\Express, // 快递
		DIR\Product; // 产品
		
}
```

扩展的请求方法务必使用内置的 <b>$this->request()</b> 函数，该方法集成签名、http请求、异常处理。
```php
namespace Peak\SDK\TWUsa\Component;

trait Inbound {

    /**
     * 查看入库单状态
     * @param $storeName string 仓库名称
     * @param $orderSn string 入库单单号
     * */
    public function getInboundOrderStatus ($storeName, $orderSn):bool
    {

        return $this->request(
            self::$api_url.'asn/storage/getstatus',
            [
                'store_name' => $storeName, # 仓库名称
                'storage_sn' => is_string($orderSn) ? $orderSn : join(',', $orderSn)
            ]
        );
    }

}
```