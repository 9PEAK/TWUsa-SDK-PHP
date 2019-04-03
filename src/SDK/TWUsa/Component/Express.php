<?php

namespace Peak\SDK\TWUsa\Component;

trait Express {


	/**
	 * estimate freight
	 * */
	protected static $estimateFreight = 'api/express/query';
    public function estimateFreight ($param):bool
    {
        return $this->request(__FUNCTION__, @[
	        'store_name' => $param['store_name'],
	        'carrier' => $param['carrier'] ?: '',
	        'delivery' => $param['delivery'] ?: '',
	        'package' => $param['package'] ?: '',
	        'postcode' => $param['postcode'],
	        'weight' => $param['weight'],
	        'length' => $param['length'],
	        'width' => $param['width'],
	        'height' => $param['height'],
	        'country_code' => $param['country_code'] ?: '',
	        'state_code' => $param['state_code'] ?: '',
        ]);
    }

/*
	protected function estimate_freight (array &$param)
	{
		return @ [
			'store_name' => $param['store_name'],
			'carrier' => $param['carrier'] ?: '',
			'delivery' => $param['delivery'] ?: '',
			'package' => $param['package'] ?: '',
			'postcode' => $param['postcode'],
			'weight' => $param['weight'],
			'length' => $param['length'],
			'width' => $param['width'],
			'height' => $param['height'],
			'country_code' => $param['country_code'] ?: '',
			'state_code' => $param['state_code'] ?: '',
		];
	}
*/

    /**
     * 物流方式
     * 进行出库地址选择时，美仓互联返回可供选择的物流方式
     * */
    protected static $logistics = 'api/logistics/index';
    public function logistics ($param):bool
    {
        return $this->request(__FUNCTION__, @[
            'store_name' => $param['store_name']
        ]);
    }


    
}
