<?php


namespace FNDEV\vShpare\Client;

use FNDEV\vShpare\VmwareApiClient;
use FNDEV\vShpare\Auth\SessionHandler;
use GuzzleHttp\Client;

class GuzzleClient extends Client
{
    public function __construct(VmwareApiClient $client,array $config = [])
    {
        $guzzleConfig = array_merge([
            'base_uri' => $client->getBaseUrl(),
            "verify"=>$client->ssl,
            'headers' => [
                'Vmware-Api-Session-Id' => SessionHandler::getSession($client),
                'Content-Type' => 'application/json',
                "Accept"=>"application/json"
            ],
        ], $config);
        parent::__construct($guzzleConfig);

    }

}