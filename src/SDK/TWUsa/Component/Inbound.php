<?php

namespace Peak\SDK\TWUsa\Component;

trait Inbound {


    /**
     * 查看入库单状态
     * */
    public function getInboundOrderStatus ($store_name, $orderSn):bool
    {

        return $this->request(
            self::API_URL.'asn/storage/getstatus',
            [
                'store_name' => $store_name, # 仓库名称
                'storage_sn' => is_string($orderSn) ? $orderSn : join(',', $orderSn)
            ]
        );
    }

    
}
