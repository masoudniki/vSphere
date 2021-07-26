<?php


namespace FNDEV\vShpare\Api\VM\Abstracts;


use FNDEV\vShpare\Api\VM\VmSource;
use GuzzleHttp\Client;

abstract class InitClass
{
    public Client $HttpClient;
    public ?VmSource $vmSource;
    public function __construct(Client $HttpClient,?VmSource $vmSource=null)
    {
        $this->HttpClient=$HttpClient;
        $this->vmSource=$vmSource;
    }

}