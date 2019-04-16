<?php

namespace Peak\SDK\TWUsa;

use Peak\SDK\TWUsa\Component as DIR;

class Core {


	protected static $api_key, $api_secret, $api_url;

	/**
	 * @param $apiKey string
	 * @param $apiSecret string
	 * @param $test boolean 是否是测试模式，测试模式下接口将请求测试的url
	 * */
	function __construct($apiKey, $apiSecret, $test=false)
	{
		self::$api_key = $apiKey;
		self::$api_secret = $apiSecret;
		$this->setMode($test);
		self::$http = new \Curl\Curl();
	}

	private static $http;


	/**
	 * 设置模式
	 * @param $test bool 是否是测试模式，测试模式下接口将请求测试的url
	 * */
	public function setMode ($test=false)
	{
		self::$api_url = $test ? 'http://gztest.glitzcloud.com/agent/v1/' : 'https://ssl.glitzcloud.com/agent/v1/';
	}


	/**
	 * 签名
	 * */
	private static function sign (array &$dat)
	{
		$str = '';
		ksort($dat);
		foreach($dat as $key=>$val){
			$str .= "{$key}{$val}";
		}
		return md5($str);
	}




	public $result;

	/**
	 * 4 获取请求的数据
	 * @param $key 支持链式调用 默认null，整个请求结果
	 * @return mixed array | string
	 * */
//	private static function response ($dat, $key=null)
//	{
//		return \Peak\Tool\Arr::array_key_chain(is_array($dat) ? $dat : json_decode(json_encode($dat), 1), $key, '.');
//	}


	/**
	 * HTTP请求
	 * @param $url string. url of request
	 * @param $param array. param of request
	 * @param $method string. get or post
	 * */
	final protected function request ($url, array $param=[], $method='post')
	{
		$http =& self::$http;

		$url = stripos($url, self::$api_url)===0 ? $url : self::$api_url.$url;

		$param['apikey'] = self::$api_key;
		$param['secretkey'] = self::$api_secret;
		$param['sign'] = self::sign($param);
		unset ($param['secretkey']);

		$http->$method($url, $param);

		if ($http->error) {
			$this->result = [
				'url' => $url,
				'param' => $param,
				'error' => 'Error: ' . $http->errorCode . ': ' . $http->errorMessage,
				'response' => $http->response
			];
			return false;
		}

		$this->result = (array)$http->response;
		if (@$this->result['status']==200) {
			$this->result = $this->result['result'];
			return true;
		}

		return false;

	}



	use Common,
//		DIR\Outbound,
		DIR\Inbound,
		DIR\Inventory,
//		DIR\Express,
		DIR\Storage,
		DIR\Product;

}
