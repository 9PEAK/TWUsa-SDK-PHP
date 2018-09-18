<?php

namespace Peak\SDK\TWUsa;

trait Base
{


	private static function set_business_type($val)
	{

	    $type = [
	        1 => 'B2B',
	        2 => 'B2C',
	        5 => 'FBA'
        ];
        return array_search($val, $type) ?: 0 ;


	}

	// 设置付款方式
	private static function set_bill_type($val)
	{
		if ( is_numeric($val)) return $val;

		switch ($val) {
			case 'TWUSA平台支付': return 0;
			case '第三方平台支付': return 1;
			case '到付': return 2;
		}
	}


	// 设置打包方式
	private static function set_package_type($val)
	{
		if ( is_numeric($val)) return $val;

		switch ($val) {
			case '使用自己箱子': return 1;
			case '使用仓库箱子': return 2;
			case '自带包装': return 3;
			case '多件包装': return 4;
			case '多件缠绕膜缠绕': return 5;
		}
	}


	// 设置打包方式
	private static function if_reset_package_type ($val)
	{
		return $val ? 1 : 0 ;
	}

	// 设置产品列表
	private static function json_product ($val)
	{
		return is_array($val) ? json_encode($val) : $val ;
	}

	// 设置物流商
	private static function set_transport_id ($val)
	{
		return is_array($val) ? json_encode($val) : $val ;
	}

    //
    private static function set_delivery_id($val)
    {
        if ( is_numeric($val)) return $val;

        switch ($val) {
            case '海运整柜': return 1;
            case '海运拼箱 ': return 2;
            case '零担卡车': return 3;
            case '快递派送': return 4;
        }

    }


}
