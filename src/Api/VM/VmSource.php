<?php


namespace FNDEV\vShpare\Api\VM;


use FNDEV\vShpare\Api\VM\Power\Power;
use FNDEV\vShpare\ApiResponse;
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
        $this->properties=isset($properties->value) ? $properties->value : $properties;
        $this->moid=$moid;
    }
    public function __get($name)
    {
        return $this->properties->{$name};
    }
    public function reloadProperties(){
        $this->properties=ApiResponse::BodyResponse($this->HttpClient->get("vm/{$this->moid}"))->value;
        return $this;
    }
    public function power(){
        return new Power($this->HttpClient,$this);
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