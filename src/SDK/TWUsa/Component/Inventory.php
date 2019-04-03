<?php

namespace Peak\SDK\TWUsa\Component;

trait Inventory {


	/**
	 * get the product inventory detail
	 * */
	protected static $getInventoryDetail = 'skus/inventory/query';
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


	protected static $transportType = 'api/logistics/index';

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
