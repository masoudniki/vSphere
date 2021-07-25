<?php


namespace FNDEV\vShpare\Api\VM;


use FNDEV\vShpare\Api\VM\Power\Power;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class VmSource
{
    public Client $HttpClient;
    public $properties;
    public $moid;
    const POWERED_ON="POWERED_ON";
    const POWERED_OFF="POWERED_OFF";
    const SUSPENDED="SUSPENDED";
    public function __construct(Client $HttpClient,$properties,$moid)
    {
        $this->HttpClient=$HttpClient;
        $this->properties=$properties;
        $this->moid=$moid;
    }
    public function __get($name)
    {
        return $this->properties->$name;
    }
    public function power(){
        return new Power();
    }

}