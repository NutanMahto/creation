<?php


namespace Linn\Creation\Api;

class ReturnsRefunds extends ApiClient
{
    public function getWarehouseLocations()
    {
        return $this->get('ReturnsRefunds/GetWarehouseLocations');
    }
}