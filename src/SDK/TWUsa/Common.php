<?php

namespace Peak\SDK\TWUsa;

trait Common
{

	public function setStoreName ($name, array &$dat)
	{
		$dat = array_merge($dat, [
			'store_name' => $name
		]);
		return $this;
	}

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
