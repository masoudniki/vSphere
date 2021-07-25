<?php


namespace FNDEV\vShpare\Api\VM\GuestPower;


use FNDEV\vShpare\Api\VM\VmSource;
use GuzzleHttp\Client;

class GuestPower
{
    public Client $HttpClient;
    public ?VmSource $vmSource;
    public function __construct(Client $HttpClient,?VmSource $vmSource=null)
    {
        $this->HttpClient=$HttpClient;
        $this->vmSource=$vmSource;
    }

}