<?php

namespace Peak\SDK\TWUsa;

trait Inventory {


	/**
	 * get the product inventory detail
	 * */
	protected static $getInventoryDetail = 'agent/v1/skus/inventory/query';
	protected static function getInventoryDetail (array &$param)
	{
		return [
			'store_name' => $param['store_name'],
			'product_sn' => $param['product_sn'],
		];
	}


	protected static $transportType = 'agent/v1/api/logistics/index';
	protected static function transportType (array &$param)
	{
		return [
			'store_name' => $param['store_name']
		];
	}



}
