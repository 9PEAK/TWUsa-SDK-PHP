<?php

namespace Peak\SDK\TWUsa\Module;

trait Order {


	protected static $getOrder = 'agent/v1/orders/order/status';

	/**
	 * add a new sale order
	 * */
	protected static $addOrder = 'agent/v1/orders/order/add';
	protected static function addOrder (array &$param )
	{
        return [
            'store_name' => $param['store_name'], # 仓库名称
//			'platform_shop_name' => $param['platform_shop_name'],
//			'shop_id' => $param['shop_id'], // 店铺名称
            'order_sn' => $param['order_sn'], # 平台订单号
            'is_check' => $param['is_check'] ? 1 : 0, # 是否审核
            'pre_outflow_time' => $param['pre_outflow_time'], // date格式
//			'remark' => $param['remark'],
            'business_type' => self::set_business_type($param['business_type']),
            'transport_id' => self::set_transport_id($param['transport_id']), # 快递公司名称
            'shipmethod_id' => $param['shipmethod_id'], # 派送方式
            'packagetype_id' => $param['packagetype_id'], // 包裹类型
//			'declared_c' => $param['declared_c'], // 长
//			'declared_k' => $param['declared_k'], // 宽
//			'declared_g' => $param['declared_g'], // 高
//			'company' => $param['company'], // 收件人公司
            'name' => $param['name'], # 收件人
            'telephone' => $param['telephone'], # 电话号码
            'postcode' => $param['postcode'], # 邮编
            'address_1' => $param['address_1'], # 地址第一行
//			'address_2' => $param['address_2'],
//			'address_3' => $param['address_3'],
            'country' => $param['country'], # 国家二字码
            'province' => $param['province'], # 省/州
            'city' => $param['city'], # 市
            'bill_type' => self::set_bill_type($param['bill_type']), # 支付方式
            'forecast_apply_package' => self::set_package_type($param['forecast_apply_package']), # 建议包装方式
            'allow_edit_package_method' => self::if_reset_package_type($param['allow_edit_package_method']), #是否允许仓库修改包装方式
//			'is_do_best_way' => $param['is_do_best_way'], // 是否智能换仓
            'products' => self::json_product($param['products']), # 产品列表
        ];
	}

    /**
     * add a new sale order
     * */
	protected static $cancelOrder = 'agent/v1/orders/order/cancel';
    protected static function cancelOrder (array &$param )
    {
        return [
            'store_name' => $param['store_name'], # 仓库名称
            'order_sn' => $param['order_sn'], # 平台订单号
        ];

    }


    /**
     * show a sale order status
     * */
    protected static $showOrderStatus = 'agent/v1/orders/order/status';
    protected static function showOrderStatus (array &$param )
    {
        return [
            'store_name' => $param['store_name'],
            'order_sn' => is_string($param['order_sn']) ? $param['order_sn'] : join(',', $param['order_sn']),
        ];

    }



}