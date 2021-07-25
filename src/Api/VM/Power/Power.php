<?php


namespace FNDEV\vShpare\Api\VM\Power;


use FNDEV\vShpare\Api\VM\VmSource;
use GuzzleHttp\Client;
use http\Exception\InvalidArgumentException;

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
        return $this->HttpClient->get("vm/{$this->getMoid()}/power");
    }
    /**
     * Returns the power state information of a virtual machine
     */
    public function powerOff($moid=null){
        return $this->HttpClient->post("vm/{$this->getMoid()}/stop");
    }
    /**
     * Powers on a powered-off or suspended virtual machine
     */
    public function powerOn($moid=null){
        return $this->HttpClient->post("vm/{$this->getMoid()}/start");
    }
    /**
     * Resets a powered-on virtual machine
     */
    public function reset($moid=null){
        return $this->HttpClient->post("vm/{$this->getMoid()}/reset");
    }
    /**
     * Returns the power state information of a virtual machine
     */
    public function suspend($moid=null){
        return $this->HttpClient->post("vm/{$this->getMoid()}/suspend");
    }
    public function getMoid($moid=null){
        if($moid)
            return $moid;
        if($this->vmSource && isset($this->vmSource->moid))
            $this->vmSource->moid;
        throw new InvalidArgumentException("provide moid or pass vmSource object");
    }
}