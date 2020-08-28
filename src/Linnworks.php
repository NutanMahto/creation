<?php

namespace Tcl\Creation;

use TclCreation\Api\Auth;
use TclCreation\Api\Inventory;
use TclCreation\Api\Locations;
use TclCreation\Api\Orders;
use TclCreation\Api\PostalServices;
use TclCreation\Api\ReturnsRefunds;
use TclCreation\Api\Stock;
use TclCreation\Exceptions\LinnworksAuthenticationException;
use GuzzleHttp\Client as GuzzleClient;

class Linnworks
{
    const BASE_URI = 'https://api.linnworks.net';

    /** @var GuzzleClient */
    protected $client;

    /** @var array */
    protected $config;

    /** @var string */
    protected $bearer;

    /** @var string */
    protected $server;

    public function __construct(array $config, GuzzleClient $client = null)
    {
        $this->client = $client ? '' : $this->makeClient();
        $this->config = $config;

        if(! $this->bearer){
            $this->refreshToken();
        }
    }

    public static function make(array $config, GuzzleClient $client = null)
    {
        return new static ($config, $client);
    }

    private function makeClient()
    {
        return new GuzzleClient([
            'timeout' => $this->config['timeout'] ? $this->config['timeout'] : 15
        ]);
    }

    private function refreshToken()
    {
        $parameters = [
            "ApplicationId" => $this->config['applicationId'],
            "ApplicationSecret" => $this->config['applicationSecret'],
            "Token" => $this->config['token']
        ];


        $response = (new Auth($this->client, self::BASE_URI.'/api/', null))->AuthorizeByApplication($parameters);
//echo "<pre>";
//print_r($response);
//exit;
        if(! ($response['Token'] ? $response['Token'] : null)){
            throw new LinnworksAuthenticationException($response['message'] ? $response['message'] : '');
        }

        $this->bearer = $response['Token'];

        $this->server = $response['Server'] .'/api/';
    }

    public function orders()
    {
        return new Orders($this->client, $this->server, $this->bearer);
    }

    public function locations()
    {
        return new Locations($this->client, $this->server, $this->bearer);
    }

    public function postalServices()
    {
        return new PostalServices($this->client, $this->server, $this->bearer);
    }

    public function returnsRefunds()
    {
        return new ReturnsRefunds($this->client, $this->server, $this->bearer);
    }

    public function stock()
    {
        return new Stock($this->client, $this->server, $this->bearer);
    }

    public function inventory()
    {
        return new Inventory($this->client, $this->server, $this->bearer);
    }

}