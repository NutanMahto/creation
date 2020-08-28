<?php

namespace Tcl\Creation\Api;

class PostalServices extends ApiClient
{
    public function getPostalServices()
    {
        return $this->get('PostalServices/GetPostalServices');
    }







}