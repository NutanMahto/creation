<?php


namespace Linn\Creation\Api;


class Locations extends ApiClient
{

    public function GetCountries()
    {
        return $this->get('Inventory/GetCountries');
    }

}