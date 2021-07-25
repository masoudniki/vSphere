<?php


namespace FNDEV\vShpare\Api\VM\Power;


use FNDEV\vShpare\Api\VM\Abstracts\InitClass;
use FNDEV\vShpare\Api\VM\Traits\MOID;
use FNDEV\vShpare\Api\VM\VmSource;
use FNDEV\vShpare\ApiResponse;
use GuzzleHttp\Client;

class Power extends InitClass
{
    use MOID;
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
}