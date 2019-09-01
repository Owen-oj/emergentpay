<?php

namespace Owenoj\EmergentPay;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

/**
 * Emergent payment laravel package
 * @package owenoj/emergentpay
 * @author  Owen Jubilant Akli - Owenoj <owen.j@terktrendz.com>
 *
 **/
class EmergentPay
{
    protected $apiId;
    protected $apiKey;
    protected $secretHash;
    protected $order_id;
    protected $order_desc;
    protected $env = 'test';
    protected $urls = [
        "live" => "https://interpayafrica.com/interapi",
        "test" => "https://test.interpayafrica.com/interapi",
    ];
    protected $baseUrl;
    protected $guzzleClient, $request;

    /**
     * EmergentPay constructor.
     * @param Request $request
     * @param Client $guzzleClient
     */
    public function __construct(Request $request, Client $guzzleClient)
    {
        $this->request = $request;
        $this->guzzleClient = $guzzleClient;
        $this->apiKey = Config::get('emergent.app_key');
        $this->apiId = Config::get('emergent.app_id');
        $this->env = Config::get('emergent.environment');
        $this->baseUrl = $this->urls[($this->env === "live" ? "$this->env" : "test")];

    }


    public function initialize()
    {

    }
}
