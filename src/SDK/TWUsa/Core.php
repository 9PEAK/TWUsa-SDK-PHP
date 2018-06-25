<?php
namespace Peak\SDK\TWUsa;

class Core {

	const API_URL = 'https://ssl.glitzcloud.com/'; //生产环境url
	const API_URL_FOR_DEVELOPMENT = 'http://gztest.glitzcloud.com/'; // 开发环境url


	private static $api_key, $api_secret, $dev_mode;
	private static $http;

	/**
	 * @param $auth array , key is the class name of authenticate method, val is certificate
	 * */
	function __construct($apiKey, $apiSecret, $devMod=false)
	{
		self::$api_key = $apiKey;
		self::$api_secret = $apiSecret;
		self::$dev_mode = $devMod;
		self::$http = new \Curl\Curl();
	}

	use Base;


	private static function set_url (&$url)
	{
		$domain = self::$dev_mode ? self::API_URL_FOR_DEVELOPMENT : self::API_URL;
		return $domain.$url;
	}



	/**
	 * 签名
	 * */
	private static function sign (&$dat)
	{
		$str = '';
		Ksort($dat);
		foreach($dat as $key=>$val){
			$str .= "{$key}{$val}";
		}
		return md5($str);
	}

	private static function set_param ($param)
	{
		$param['apikey'] = self::$api_key;
		$param['secretkey'] = self::$api_secret;
		$param['sign'] = self::sign($param);
		unset ($param['secretkey']);
		return $param;
	}



	/**
	 * 4 获取请求的数据
	 * @param $key 支持链式调用 默认null，整个请求结果
	 * @return mixed array | string
	 * */
	private static function response ($key=null)
	{
		$res = self::$http->response;
		if ($key) {
			$res = is_string($res) ? json_decode($res, 1) : (array)$res ;
			$key = explode('.', $key);
			foreach ($key as $k) {
				$res = @$res[$k];
			}
		}
		return $res;
	}



/*
	private static function set_url_query ($query)
	{
		if (!$query) return '';

		if (is_array($query)) {
			foreach ($query as $k=>&$v) {
				$v = $k.'='.$v;
			}
			return '?'.join('&', $query);
		} else {
			$query = trim($query);
			return strpos($query, '?')===0 ? $query : '?'.$query;
		}
	}


	protected static $req_param = [];
*/

	/**
	 * 跨应用标准化请求业务
	 * @param $func method name of request
	 * @param $param param of request
	 * */
	final public function request ($func, array $param)
	{
		$http =& self::$http;

		try {

			#1 设置url
			$url = self::set_url(self::$$func);

			#2 设置参数
			$param = self::set_param(static::$func($param));

			#3 发送请求
			$http->post($url, $param);

			#4 获取返回值
			if ($http->error) {
				throw new \Exception(json_encode([
					'url' => $url,
					'param' => $param,
					'error' => 'Error: ' . $http->errorCode . ': ' . $http->errorMessage,
					'response' => is_string($http->response) ? json_decode($http->response, 1) : (array)$http->response
				]));
			}

			if (self::response('status')==200) {
				return self::response('result');
			}

			throw new \Exception(json_encode(self::$http->response));

		} catch ( \Exception $e) {
			echo 'ERROR: '.$e->getMessage();
		}

	}



	use Product;

}
