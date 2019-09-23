<?php

namespace Owenoj\EmergentPay;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Emergent payment laravel package.
 * @author  Owen Jubilant Akli - Owenoj <owen.j@terktrendz.com>
 *
 **/
class EmergentPay
{
    protected $appId;
    protected $apiKey;
    protected $env = 'test';
    protected $urls = [
        'live' => 'https://interpayafrica.com/interapi',
        'test' => 'https://test.interpayafrica.com/interapi',
    ];
    protected $baseUrl;
    protected $guzzleClient;
    protected $request;
    /**
     * @var array
     */
    private $headers;

    /**
     * EmergentPay constructor.
     * @param Request $request
     * @param Client $guzzleClient
     */
    public function __construct(Request $request, Client $guzzleClient)
    {
        $this->request = $request;
        $this->guzzleClient = $guzzleClient;
        $this->apiKey = Config::get('emergentpay.api_key');
        $this->appId = Config::get('emergentpay.app_id');
        $this->env = Config::get('emergentpay.environment');
        $this->currency = Config::get('emergentpay.currency');
        $this->baseUrl = $this->urls[($this->env === 'live' ? "$this->env" : 'test')];
        $this->headers = [
            'Content-Type' => 'application/json',
            'cache-control' => 'no-cache',
        ];
    }

    /**
     * Make API Call and initiate payment.
     * @param $callback_url
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws GuzzleException
     */
    public function initialize($callback_url)
    {
        $payment_params = [
            'app_id' => $this->appId,
            'app_key' => $this->apiKey,
            'name' => ucfirst($this->request->fullname),
            'amount' => round($this->request->amount, 2),
            'email' => $this->request->email,
            'mobile' => $this->request->phonenumber,
            'currency' => $this->currency,
            'order_desc' => $this->request->description,
            'order_id' => $this->request->transaction_reference,
            'return_url' => $callback_url,
        ];
        $url = $this->baseUrl.'/ProcessPayment';

        $request = $this->guzzleClient->request('POST', $url, ['body' => json_encode($payment_params),
            'headers' => $this->headers, ]);

        $transaction = json_decode($request->getBody()->getContents());

        if ($transaction->status_code != 1) {
            // there was an error from the API
            return back()->with('status', $transaction->status_message);
        }

        return Redirect::to($transaction->redirect_url);
    }

    /**
     * Callback for payment.
     * @return object
     */
    public function callback()
    {
        return (object) $this->request->all();
    }
}
