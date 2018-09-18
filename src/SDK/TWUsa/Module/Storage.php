<?php

namespace Peak\SDK\TWUsa\Module;

trait Storage {


	/**
	 * add an Inbound order
	 * */
	protected static $addStorage = 'agent/v1/asn/storage/add';

    public function addStorage ($param):bool
    {
        return $this->request(
        	__FUNCTION__,
	        [
		        'store_name' => $param['store_name'], # 仓库名称

//		        'seal_no' => $param['seal_no'], # 封号，商家根据实际箱封号如实填写
			    'remark' => @$param['remark'] ?: 'test',
			    'shipping_time' => $param['shipping_time'],  //发货时间
			    'schedule_time' => $param['schedule_time'],  //预计到达时间
			    'etd_time' => $param['etd_time'],  //预计离港时间
			    'eta_time' => $param['etd_time'],  //预计到港时间，如果填写必须小于等于schedule_time

			    'source_type' => $param['source_type'],  #入库来源类型  有三个值NORMAL ASN、FBA TRANSFER、OTHER

			    'track_num' => @$param['track_num'],  #tracking ，如果source_type为FBA TRANSFER，必填，并且不能和以往的订单有重复

                'carton'  => @$param['carton_num'],  //int 入库数量
                'declared_value'  => @$param['declared_value'] ?: 0,  //申报价值

		        'delivery_type' => self::set_delivery_id($param['delivery_type']), # 入库派送方式 1:海运整柜 2:海运拼箱 3:零担卡车 4:快递派送

		        'products' => self::json_product($param['products']), # 产品列表
	        ]
        );
    }







}