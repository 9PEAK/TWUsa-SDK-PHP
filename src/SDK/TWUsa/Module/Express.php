<?php

namespace Peak\SDK\TWUsa\Module;

trait Express {


	/**
	 * get the product inventory detail
	 * */
	protected static $estimateFreight = 'agent/v1/api/logistics/index';
	protected function estimateFreight (array &$param)
	{
		return @ [
			'store_name' => $param['store_name'],
			'carrier' => $param['carrier'],
			'delivery' => $param['delivery'],
			'package' => $param['package'],
			'postcode' => $param['postcode'],
			'weight' => $param['weight'],
			'length' => $param['length'],
			'width' => $param['width'],
			'height' => $param['height'],
			'country_code' => $param['country_code'],
			'state_code' => $param['state_code'],
		];
	}



}
