<?php


namespace FNDEV\vShpare\Client;


use FNDev\Proxmox\Auth\CookieHandler;
use FNDev\Proxmox\ProxmoxApiClient;

class GuzzleClient
{
    public function __construct(ProxmoxApiClient $client,array $config = [])
    {
        $guzzleConfig = array_merge([
            'base_uri' => $client->getBaseUrl(),
            "verify"=>$client->ssl,
            'headers' => [
                'Cookie' => CookieHandler::getCookie($client),
                'Content-Type' => 'application/json',
                "Accept"=>"application/json",
                "CSRFPreventionToken"=>CookieHandler::getCsrfToken($client)
            ],
        ], $config);
        parent::__construct($guzzleConfig);
    }

}