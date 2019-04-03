<?php

namespace Peak\SDK\TWUsa\Component;

trait Product {


	public function setSkuSn (array &$dat, $sn)
	{
		$dat['product_sn'] = $sn;
		return $this;
	}


	public function setSkuBarCode (array &$dat, $code)
	{
		$dat['bar_code'] = $code;
		return $this;
	}


	/**
	 * 设置商品英文名
	 *
	 * */
	public function setSkuNameEn (array &$dat, $name)
	{
		$dat['product_name_en'] = $name;
		return $this;
	}

	public function setSkuWorth (array &$dat, $amount)
	{
		$dat['product_worth'] = round($amount, 2);
		return $this;
	}



	public function setSkuWeight (array &$dat, $weight)
	{
		$dat['declaration_weight'] = round($weight, 2);
		return $this;
	}



	public function setSkuVolume (array &$dat, $length, $width, $height)
	{
		$dat['declaration_volume'] = join('*', [
			round($length, 2),
			round($width, 2),
			round($height, 2),
		]);
		return $this;
	}



	public function setSkuPackingType (array &$dat, $type)
	{
		$dat['packing_type'] = $type;
		return $this;
	}



	/**
	 * 追加设置货品装箱率
	 * @param $dat
	 * @param $qty
	 *
	 * */
	public function setSkuContainerConfig (array &$dat, $qty, $length=0, $width=0, $height=0, $weight=0)
	{
		$dat['container_config'] = @$dat['container_config'] ? (is_array($dat['container_config']) ? $dat['container_config'] : json_decode($dat['container_config'], 1)) : [];
		if (!in_array($qty, array_column($dat['container_config'], 'max_qty'))) {
			$dat['container_config'][] = [
				'max_qty' => $qty,
				'length' => round($length, 2),
				'width' => round($width, 2),
				'height' => round($height, 2),
				'weight' => round($weight, 2),
			];
		}
		return $this;
	}



	public function addSku (array $param):bool
	{
		$param['container_config'] = is_array($param['container_config']) ? json_encode($param['container_config']) : $param['container_config'];
		return $this->request(
			'skus/skus/addskus',
			$param
		);
	}


	/**
	 * 编辑商品
	 * */
    public function editSku (array $param):bool
    {
	    $param['container_config'] = is_array($param['container_config']) ? json_encode($param['container_config']) : $param['container_config'];
        return $this->request(
            'sk us/skus/editskus',
            $param
        );
    }


}
