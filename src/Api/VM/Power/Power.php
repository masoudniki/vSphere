<?php


namespace FNDEV\vShpare\Api\VM\Power;


use FNDEV\vShpare\Api\VM\VmSource;
use FNDEV\vShpare\ApiResponse;
use GuzzleHttp\Client;

class Power
{
    public Client $HttpClient;
    public ?VmSource $vmSource;
    public function __construct(Client $HttpClient,?VmSource $vmSource=null)
    {
        $this->HttpClient=$HttpClient;
        $this->vmSource=$vmSource;
    }
    /**
     * Returns the power state information of a virtual machine
     */
    public function power($moid=null){
        return ApiResponse::BodyResponse($this->HttpClient->get("vm/{$this->getMoid($moid)}/power"));
    }
    /**
     * Returns the power state information of a virtual machine
     */
    public function powerOff($moid=null){
        return !ApiResponse::HasError($this->HttpClient->post("vm/{$this->getMoid($moid)}/power/stop"));
    }
    /**
     * Powers on a powered-off or suspended virtual machine
     */
    public function powerOn($moid=null){
        return !ApiResponse::HasError($this->HttpClient->post("vm/{$this->getMoid($moid)}/power/start"));
    }
    /**
     * Resets a powered-on virtual machine
     */
    public function reset($moid=null){
        return !ApiResponse::HasError($this->HttpClient->post("vm/{$this->getMoid($moid)}/power/reset"));
    }
    /**
     * Returns the power state information of a virtual machine
     */
    public function suspend($moid=null){
        return !ApiResponse::HasError($this->HttpClient->post("vm/{$this->getMoid($moid)}/power/suspend"));
    }
    public function getMoid($moid=null){
        if($moid)
            return $moid;
        if($this->vmSource && isset($this->vmSource->moid))
            return $this->vmSource->moid;
        throw new \InvalidArgumentException("provide moid or pass vmSource object");
    }
}