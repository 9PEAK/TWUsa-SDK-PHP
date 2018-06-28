<?php
namespace Peak\SDK;

//use Peak\SDK\TWUsa\Core as SDK;

class TWUsa extends \Peak\SDK\TWUsa\Core {

	private static $sdk;

	/**
	 * @param $auth array , key is the class name of authenticate method, val is certificate
	 * */
	/*
	function __construct($apiKey, $apiSecret, $devMod=false)
	{
		self::$sdk = new SDK($apiKey, $apiSecret, $devMod);
	}




	public function addSku ($param)
	{
		$res = self::$sdk->request(__FUNCTION__, $param) ?: self::$sdk->debug;
	}


	public function getInventoryDetail($storeName, $productSn)
	{
		$res = self::$sdk->request(__FUNCTION__, [
			'store_name' => $storeName,
			'product_sn' => $productSn
		]);
		return $res ?: self::$sdk->debug;
	}*/

}
