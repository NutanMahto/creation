<?php

namespace Linn\Creation\Api;

class Inventory extends ApiClient
{

    public function addInventoryItem($inventoryItem ){
        // remove null
        $inventoryItem = array_filter($inventoryItem, function($row){
            return ! is_null($row);
        });

//        echo "<pre>";
//        print_r($inventoryItem);
//        print_r(json_encode($inventoryItem));
//        exit;

        return $this->post('Inventory/AddInventoryItem',[
            'inventoryItem' => json_encode($inventoryItem)
        ]);
    }

    public function updateInventoryItem($inventoryItem ){
        // remove null
        $inventoryItem = array_filter($inventoryItem, function($row){
            return ! is_null($row);
        });

//        echo "<pre>";
//        print_r($inventoryItem);
//        print_r(json_encode($inventoryItem));
//        exit;

        return $this->post('Inventory/UpdateInventoryItem',[
            'inventoryItem' => json_encode($inventoryItem)
        ]);
    }

    public function getInventoryItemExtendedProperties($inventoryItemId)
    {
        return $this->get('Inventory/GetInventoryItemExtendedProperties',[
            'inventoryItemId'=> $inventoryItemId
        ]);
    }

    public function getInventoryItemCompositions($inventoryItemId)
    {
        return $this->get('Inventory/GetInventoryItemCompositions', [
            "inventoryItemId" => $inventoryItemId,
        ]);
    }

    public function getStockItemIdsBySKU($SKUS)
    {
        if(is_array($SKUS) && count($SKUS) > 0){
            $request = array("SKUS"=> $SKUS);
            return $this->get('Inventory/GetStockItemIdsBySKU', [
                'request' => json_encode($request)
            ]);
        }
    }

    public function getChannels()
    {
        return $this->get('Inventory/GetChannels');
    }

    public function getCategories()
    {
        return $this->get('Inventory/GetCategories');
    }

    public function getInventoryItemBatchInformation()
    {
        return $this->get('Inventory/GetInventoryItemBatchInformation');
    }

    public function getEbayCompatibilityList()
    {
        return $this->get('Inventory/GetEbayCompatibilityList');
    }

    public function getPackageGroups()
    {
        return $this->get('Inventory/GetPackageGroups');
    }

    public function getAllExtendedPropertyNames()
    {
        return $this->get('Inventory/GetAllExtendedPropertyNames');
    }

    public function getExtendedPropertyNames()
    {
        return $this->get('Inventory/GetExtendedPropertyNames');
    }

    public function getExtendedPropertyTypes()
    {
        return $this->get('Inventory/GetExtendedPropertyTypes');
    }

}
