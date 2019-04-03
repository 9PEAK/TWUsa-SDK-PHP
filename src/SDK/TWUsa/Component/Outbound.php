<?php

namespace Peak\SDK\TWUsa\Component;

trait Outbound {



	public function setOutboundOrderStoreName ($name, array &$dat)
	{
		$dat = array_merge($dat, [
			'store_name' => $name
		]);
		return $this;
	}

	public function setOutboundOrderOrderSn ($sn, array &$dat)
	{
		$dat = array_merge($dat, [
			'order_sn' => $sn
		]);
		return $this;
	}

	public function setOutboundOrderIsCheck ($check=false, array &$dat)
	{
		$dat = array_merge($dat, [
			'is_check' => $check ? 1 : 0
		]);
		return $this;
	}

	public function setOutboundOrderOutflowTime ($date, array &$dat)
	{
		$dat = array_merge($dat, [
			'pre_outflow_time' => $date
		]);
		return $this;
	}

	public function setOutboundOrderRemark ($remark='', array &$dat)
	{
		$dat = array_merge($dat, [
			'remark' => $remark
		]);
		return $this;
	}


	static $outboundOrderBusinessType = [
		1 => 'B2B',
		2 => 'B2C',
		5 => 'FBA'
	];

	public function setOutboundOrderBusinessType ($type, array &$dat)
	{
		$dat = array_merge($dat, [
			'business_type' => is_numeric($type) ? $type : (array_search($type, self::$outboundOrderBusinessType) ?: 0)
		]);
		return $this;
	}



	/**
	 * 设置物流商
	 * */
	public function setOutboundOrderTransportId ($id, array &$dat)
	{
		$dat = array_merge($dat, [
			'transport_id' => is_string($id) ? $id : json_encode($id)
		]);
		return $this;
	}



	public function setOutboundOrderShipmethod ($id, array &$dat)
	{
		$dat = array_merge($dat, [
			'shipmethod_id' => $id
		]);
		return $this;
	}


	/**
	 * 包裹类型
	 * */
	public function setOutboundOrderPackageType ($id='', array &$dat)
	{
		$dat = array_merge($dat, [
			'packagetype_id' => $id
		]);
		return $this;
	}



	/**
	 * 设置收件人 必填
	 * */
	public function setOutboundOrderName ($name, array &$dat)
	{
		$dat = array_merge($dat, [
			'name' => $name
		]);
		return $this;
	}


	/**
	 * 设置收件人电话 必填
	 * */
	public function setOutboundOrderTel ($tel, array &$dat)
	{
		$dat = array_merge($dat, [
			'telephone' => $tel
		]);
		return $this;
	}

	/**
	 * 设置收件邮编 必填
	 * */
	public function setOutboundOrderPostCode ($code, array &$dat)
	{
		$dat = array_merge($dat, [
			'postcode' => $code
		]);
		return $this;
	}


	/**
	 * 设置收件地址 首地址必填
	 * */
	public function setOutboundOrderAddress ($addr, $line=1, array &$dat)
	{
		$line = abs((int)$line);
		$dat = array_merge($dat, [
			'address_'.($line&&$line>3 ? 1 : $line) => $addr
		]);
		return $this;
	}


	/**
	 * 设置收件地国家二字码 必填
	 * */
	public function setOutboundOrderCountry ($country, array &$dat)
	{
		$dat = array_merge($dat, [
			'country' => $country
		]);
		return $this;
	}



	/**
	 * 设置收件地省/州 必填
	 * */
	public function setOutboundOrderProvince ($province, array &$dat)
	{
		$dat = array_merge($dat, [
			'province' => $province
		]);
		return $this;
	}


	/**
	 * 设置收件地城市 必填
	 * */
	public function setOutboundOrderCity ($city, array &$dat)
	{
		$dat = array_merge($dat, [
			'city' => $city
		]);
		return $this;
	}



	static $outboundOrderBillType = [
		'TWUSA平台支付',
		'第三方平台支付',
		'到付'
	];

	/**
	 * 设置出库单支付方式 必填
	 * */
	public function setOutboundOrderBillType ($type, array &$dat)
	{
		$dat = array_merge($dat, [
			'bill_type' => is_numeric($type) ? $type : (array_search($type, self::$outboundOrderBillType) ?: 0)
		]);
		return $this;
	}


	static $outboundOrderForecastApplyPackage = [
		1 => '使用自己箱子',
		2 => '使用仓库箱子',
		3 => '自带包装',
		4 => '多件包装',
		5 => '多件缠绕膜缠绕',
	];

	/**
	 * 设置出库单建议包装方式 必填
	 * */
	public function setOutboundOrderForecastApplyPackage ($type, array &$dat)
	{
		$dat = array_merge($dat, [
			'forecast_apply_package' => is_numeric($type) ? $type : (array_search($type, self::$outboundOrderForecastApplyPackage) ?: 0)
		]);
		return $this;
	}


	/**
	 * 出库单是否允许仓库修改包装方式 必填
	 * */
	public function setOutboundOrderPackageMethodEditable ($allow=false, array &$dat)
	{
		$dat = array_merge($dat, [
			'allow_edit_package_method' => $allow ? 1 : 0
		]);
		return $this;
	}


	/**
	 * 格式化出库单单件货品 必填
	 * */
	public function setOutboundOrderProduct ($sn, $qty, $id):array
	{
		return [
			'product_sn' => $sn,
			'exp_piece_qty' => (int)$qty,
			'product_id' => $id,
		];
	}





	/**
	 * add an outbond order
	 * @param $order array 出库单信息
	 * @param $product array 出库单明细 二维数组
	 * */
    public function addOutboundOrder (array $order, array $product):bool
    {
	    $order['products'] =& json_encode($product);
        return $this->request(
	        'orders/order/add',
	        $order
        );
    }



	/**
	 * cancel an outbond order
	 * */
	public function cancleOutboundOrder ($storeName, $orderSn):bool
	{
		return $this->request(
			self::API_URL.'orders/order/cancel',
			[
				'store_name' => $storeName,
				'order_sn' => $orderSn
			]
		);
	}


	########################### 以下未调整 ###########################

    /**
     * show a sale order status
     * */
	protected static $showOrderStatus = 'orders/order/status';
    public function showOrderStatus ($storeName,$orderSn):bool
    {
        return $this->request(__FUNCTION__, [
            'store_name' => $storeName,
            'order_sn' => is_string($orderSn) ? $orderSn : join(',', $orderSn)
        ]);
    }

/*
    protected static function show_order_status (array &$param )
    {
        return [
            'store_name' => $param['store_name'],
            'order_sn' => is_string($param['order_sn']) ? $param['order_sn'] : join(',', $param['order_sn']),
        ];

    }
*/


}