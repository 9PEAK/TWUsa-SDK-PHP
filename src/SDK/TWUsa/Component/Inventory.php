<?php

namespace Peak\SDK\TWUsa\Component;

trait Inventory {


    /** 商品库存查询
     * @param array $param
     * @return bool
     */
    public function getInventoryDetail ($storeName, $sn):bool
    {

        return $this->request(
            'skus/inventory/query',
            [
                'store_name' => $storeName,
                'product_sn' => is_array($sn) ? join(',', $sn) : $sn
            ]
        );
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
