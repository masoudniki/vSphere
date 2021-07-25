<?php


namespace FNDEV\vShpare\Api\VM;


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
    public function powerState(){
        return $this->properties->power_state;
    }
    public function isPoweredOn(){
        return $this->properties->power_state==self::POWERED_ON;
    }
    public function isPoweredOff(){
        return $this->properties->power_state==self::POWERED_OFF;
    }
    public function isSuspended(){
        return $this->properties->power_state==self::SUSPENDED;
    }
}