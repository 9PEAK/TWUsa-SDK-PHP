<?php

namespace Peak\SDK\TWUsa\Component;

trait Inbound {


    public function setInboundOrderStoreName ($name, array &$dat)
    {
        $dat = array_merge($dat, [
            'store_name' => $name
        ]);
        return $this;
    }

    public function setInboundOrderDeclaredValue ($val, array &$dat)
    {
        $dat = array_merge($dat, [
            'declared_value' => $val
        ]);
        return $this;
    }
    public function setInboundOrderShippingTime ($val, array &$dat)
    {
        $dat = array_merge($dat, [
            'shipping_time' => $val
        ]);
        return $this;
    }
    public function setInboundOrderScheduleTime ($val, array &$dat)
    {
        $dat = array_merge($dat, [
            'schedule_time' => $val
        ]);
        return $this;
    }
    public function setInboundOrderSourceType ($val, array &$dat)
    {
        $dat = array_merge($dat, [
            'source_type' => $val
        ]);
        return $this;
    }
    public function setInboundOrderEtdTime ($val, array &$dat)
    {
        $dat = array_merge($dat, [
            'etd_time' => $val
        ]);
        return $this;
    }
    public function setInboundOrderEtaTime ($val, array &$dat)
    {
        $dat = array_merge($dat, [
            'eta_time' => $val
        ]);
        return $this;
    }

    public function setInboundOrderCarton ($val, array &$dat)
    {
        $dat = array_merge($dat, [
            'carton' => $val,
            'carton_num' => $val
        ]);
        return $this;
    }
    public function setInboundOrderDeliveryType ($val, array &$dat)
    {
        $dat = array_merge($dat, [
            'delivery_type' => $val
        ]);
        return $this;
    }
    public function setInboundOrderRemark ($val, array &$dat)
    {
        $dat = array_merge($dat, [
            'remark' => $val
        ]);
        return $this;
    }
    public function setInboundOrderTrackNum($val, array &$dat)
    {
        $dat = array_merge($dat, [
            'track_num' => $val
        ]);
        return $this;
    }


    /**
     * 格式化单件货品 必填
     * */
    public function setInboundOrderProducts ($sku, $qty, $qty_ctn, $ctn):array
    {
        return [
            'product_sn' => $sku,
            'exp_carton_qty' => $ctn,//箱子总数
            'exp_piece_qty' => $qty, //预报数量
            'container_max_qty' => $qty_ctn //箱入数
        ];
    }

    //入库
    public function addInboundStorage (array $order):bool
    {
        return $this->request(
            'asn/storage/add',
            $order
        );
    }






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
