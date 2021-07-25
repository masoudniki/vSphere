<?php


namespace FNDEV\vShpare\Api\VM\Tools;


use FNDEV\vShpare\Api\VM\VmSource;
use GuzzleHttp\Client;

class Tools
{
    public Client $HttpClient;
    public ?VmSource $vmSource;
    public function __construct(Client $HttpClient,?VmSource $vmSource=null)
    {
        $this->HttpClient=$HttpClient;
        $this->vmSource=$vmSource;
    }

}