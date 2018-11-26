<?php
namespace Peak\SDK\TWUsa\Module;

trait Product {

	// 添加商品
	protected static $addSku = 'agent/v1/skus/skus/addskus';

	public function addSku ($param):bool
	{
		return $this->request(
			__FUNCTION__,
			[
				'product_sn' => $param['product_sn'], # sku
//			'bar_code' => $param['product_sn'],
//			'product_type' => $param['product_sn'],
//			'product_name' => $param['product_sn'],
				'product_name_en' => $param['product_name_en'], # 英文名
				'product_worth' => $param['product_worth'], # 商品金额
				'declaration_weight' => $param['declaration_weight'], # 重量
				'declaration_volume' => $param['declaration_volume'], # 体积
                'packing_type' => $param['packing_type'],
//			'description' => $param['product_sn'],
//			'customs_code' => $param['product_sn'],
//			'exist_battery' => $param['product_sn'],
//			'description_url' => $param['product_sn'],
//			'is_available' => $param['product_sn'],
//			'num_in_master' => $param['product_sn'],
//			'num_in_inner' => $param['product_sn'],
//			'product_imgs' => $param['product_sn'],
			'container_config' => $param['container_config'],  //json
			]
		);
	}



    // 编辑商品
    protected static $editSku = 'agent/v1/skus/skus/editskus';
    public  function editSku (array &$param)
    {

//		static::setUrl('agent/v1/skus/skus/addskus', $req->has('dev']);
        return $this->request(
            __FUNCTION__,
            [
                'product_sn' => $param['product_sn'], # sku
//			'bar_code' => $param['product_sn'],
//			'product_type' => $param['product_sn'],
//			'product_name' => $param['product_sn'],
                'product_name_en' => $param['product_name_en'], # 英文名
                'product_worth' => $param['product_worth'], # 商品金额
                'declaration_weight' => $param['declaration_weight'], # 重量
                'declaration_volume' => $param['declaration_volume'], # 体积
                'packing_type' => $param['packing_type'],
//			'description' => $param['product_sn'],
//			'customs_code' => $param['product_sn'],
//			'exist_battery' => $param['product_sn'],
//			'description_url' => $param['product_sn'],
//			'is_available' => $param['product_sn'],
//			'num_in_master' => $param['product_sn'],
//			'num_in_inner' => $param['product_sn'],
//			'product_imgs' => $param['product_sn'],
                'container_config' => $param['container_config'],  //json
            ]
        );

    }


}
