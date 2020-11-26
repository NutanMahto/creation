<?php

namespace Linn\Creation\Api;

class Orders extends ApiClient
{



    public function createOrders($orders){

        // remove null
        $orders = array_filter($orders, function($row){
            return ! is_null($row);
        });

        return $this->post('Orders/CreateOrders',[
            'location' => 'default',
            'orders' => json_encode($orders)
        ]);
    }


    public function cancelOrder( $orderId,  $fulfilmentCenter,  $refund = 0,  $note = "" )
    {
        return $this->post('Orders/CancelOrder',[
            'orderId' => $orderId,
            'fulfilmentCenter' => $fulfilmentCenter,
            'refund' => $refund,
            'note' => $note,
        ]);
    }

    public function getOpenOrders( $fulfilmentCenter,  $entriesPerPage = 25,  $pageNumber = 1,  $filters = "",  $sorting = [],  $additionalFilters = "")
    {
        return $this->get('Orders/GetOpenOrders', [
            "entriesPerPage" => $entriesPerPage,
            "pageNumber" => $pageNumber,
            "filters" => $filters,
            "sorting" => $sorting,
            "fulfilmentCenter" => $fulfilmentCenter,
            "additionalFilters" => $additionalFilters
        ]);
    }

    public function getAllOpenOrders($fulfilmentCenter,  $filters = "",  $sorting = [],  $additionalFilter = "")
    {
        return $this->get('Orders/GetAllOpenOrders', [
            "filters" => $filters,
            "sorting" => $sorting,
            "fulfilmentCenter" => $fulfilmentCenter,
            "additionalFilter" => $additionalFilter
        ]);
    }

    public function GetOrdersById( $pkOrderIds = [])
    {
        return $this->get('Orders/GetOrdersById', [
            "pkOrderIds" => json_encode($pkOrderIds)
        ]);
    }

    public function GetOrdersByNumOrderId( $numOrderId = 1)
    {
        return $this->get('Orders/GetOrderDetailsByNumOrderId', [
            "OrderId" => $numOrderId
        ]);
    }

    public function SearchProcessedOrdersPaged( $pageNum = 1,  $numEntriesPerPage = 50,  $from = "-7200 days",  $to = "now",  $dateType = "PROCESSED",  $searchField = "",  $exactMatch = "false",  $searchTerm = "")
    {
        return $this->get('ProcessedOrders/SearchProcessedOrdersPaged', [
            "from" => date('Y-m-d\TH:i:sP', strtotime($from)),
            "to" => date('Y-m-d\TH:i:sP', strtotime($to)),
            "dateType" => $dateType,
            "searchField" => $searchField,
            "exactMatch" => $exactMatch,
            "searchTerm" => $searchTerm,
            "pageNum" => $pageNum,
            "numEntriesPerPage" => $numEntriesPerPage,
        ]);
    }

    public function MoveToLocation( $orderIds = [],  $pkStockLocationId = "")
    {
        return $this->get('Orders/MoveToLocation', [
            "orderIds" => json_encode($orderIds),
            "pkStockLocationId" => $pkStockLocationId
        ]);
    }

    public function ChangeShippingMethod( $orderIds = [],  $shippingMethod = "")
    {
        return $this->get('Orders/ChangeShippingMethod', [
            "orderIds" => json_encode($orderIds),
            "shippingMethod" => $shippingMethod
        ]);
    }

    public function changeStatus( $orderIds = [],  $status)
    {
        return $this->get('Orders/ChangeStatus', [
            "orderIds" => json_encode($orderIds),
            "status" => $status
        ]);
    }

    public function SetLabelsPrinted(array $orderIds = [])
    {
        return $this->post('Orders/SetLabelsPrinted', [
            "orderIds" => json_encode($orderIds)
        ]);
    }

    public function setShippingInfo( $orderId = "",  $info = [])
    {
        return $this->post('Orders/SetOrderShippingInfo',[
            'orderId' => $orderId,
            'info' => json_encode($info)
        ]);
    }

    public function processOrder( $orderId = "",  $scanPerformed = true,  $locationId = "",  $allowZeroAndNegativeBatchQty = true)
    {
        return $this->post('Orders/ProcessOrder',[
            'orderId' => $orderId,
            'scanPerformed' => $scanPerformed,
            'locationId' => $locationId,
            'allowZeroAndNegativeBatchQty' => $allowZeroAndNegativeBatchQty,
        ]);
    }

    public function processFulfilmentCentreOrder( $orderId = "")
    {
        return $this->post('Orders/ProcessFulfilmentCentreOrder',[
            'orderId' => $orderId
        ]);
    }


}
