<?php

namespace Peak\SDK\TWUsa\Module;

trait Inventory {


	/**
	 * get the product inventory detail
	 * */
	protected static $getInventoryDetail = 'agent/v1/skus/inventory/query';
    public function getInventoryDetail ($warehouse, $sku):bool
    {
        return $this->request(__FUNCTION__, [
            'store_name' => $warehouse,
            'product_sn' => is_string($sku) ? $sku : join(',', $sku),
        ]);
    }

/*
	protected static function get_inventory_detail (array &$param)
	{
		return [
			'store_name' => $param['store_name'],
			'product_sn' => is_string($param['product_sn']) ? $param['product_sn'] : join(',', $param['product_sn']),
		];
	}*/


	protected static $transportType = 'agent/v1/api/logistics/index';

    public function transportType ($warehouse):bool
    {
        return $this->request(__FUNCTION__, [
            'store_name' => $warehouse,
        ]);
    }

/*
	protected static function transport_type (array &$param)
	{
		return [
			'store_name' => $param['store_name']
		];
	}
*/


}
