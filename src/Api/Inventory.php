<?php

namespace Linn\Creation\Api;

class Inventory extends ApiClient
{

    public function getStockItemIdsBySKU($skus)
    {
        return $this->get('Inventory/GetStockItemIdsBySKU', [
            "SKUS" => $skus,
        ]);
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
