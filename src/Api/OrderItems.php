<?php


namespace Linn\Creation\Api;


class OrderItems
{

    protected $itemNumber = 0;
    protected $orderItems = [];

    public function addOrderItem( $sku = "",
                                  $title = "",
                                  $qty = 0,
                                  $pricePerUnit = 0,
                                  $taxRate = 20,
                                  $taxCostInclusive = true,
                                  $useChannelTax = false,
                                  $isService = false,
                                  $lineDiscount = 0
    ){
        if(! $sku){
            return;
        }

        $this->orderItems[] = array_filter([
            'TaxCostInclusive'=> $taxCostInclusive,
            'UseChannelTax'=> $useChannelTax,
            'PricePerUnit'=> $pricePerUnit < 0 ? 0 : $pricePerUnit,
            'Qty'=> $qty,
            'TaxRate'=> $taxRate,
            'LineDiscount'=> $lineDiscount,
            'ItemNumber'=> $this->itemNumber++,
            'ChannelSKU'=> $sku,
            'IsService'=> $isService,
            'ItemTitle'=> $title
        ], function($row){
            return ! is_null($row);
        });
    }

    public function getOrderItems()
    {
        return $this->orderItems;
    }
}