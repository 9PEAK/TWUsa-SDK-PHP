<?php

namespace Peak\SDK\TWUsa\Module;

trait Inventory {


	/**
	 * get the product inventory detail
	 * */

    public function getInventoryDetail ($storeName,$orderSn):bool
    {
        return $this->request(__FUNCTION__, [
            'store_name' => $storeName,
            'product_sn' => $orderSn
        ]);
    }

	protected static $get_inventory_detail = 'agent/v1/skus/inventory/query';
	protected static function get_inventory_detail (array &$param)
	{
		return [
			'store_name' => $param['store_name'],
			'product_sn' => is_string($param['product_sn']) ? $param['product_sn'] : join(',', $param['product_sn']),
		];
	}

    public function transportType ($storeName):bool
    {
        return $this->request(__FUNCTION__, [
            'store_name' => $storeName,
        ]);
    }

	protected static $transport_type = 'agent/v1/api/logistics/index';
	protected static function transport_type (array &$param)
	{
		return [
			'store_name' => $param['store_name']
		];
	}



}
