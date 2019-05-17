<?php

namespace Peak\SDK\TWUsa\Component;

trait Inbound {


    /**
     * 查看入库单状态
     * @param $storeName string 仓库名称
     * @param $orderSn string 入库单单号
     * */
    public function getInboundOrderStatus ($storeName, $orderSn):bool
    {

        return $this->request(
            self::$api_url.'asn/storage/getstatus',
            [
                'store_name' => $storeName, # 仓库名称
                'storage_sn' => is_string($orderSn) ? $orderSn : join(',', $orderSn)
            ]
        );
    }

    
}
