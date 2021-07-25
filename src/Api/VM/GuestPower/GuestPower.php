<?php


namespace FNDEV\vShpare\Api\VM\GuestPower;


use FNDEV\vShpare\Api\VM\Abstracts\InitClass;
use FNDEV\vShpare\Api\VM\Traits\MOID;
use FNDEV\vShpare\Api\VM\VmSource;
use FNDEV\vShpare\ApiResponse;
use GuzzleHttp\Client;

class GuestPower extends InitClass
{
    use MOID;
    /**
     * Returns information about the guest operating system power state.
     */
    public function power($moid=null){
        return ApiResponse::BodyResponse($this->HttpClient->get("vm/{$this->getMoid($moid)}/guest/power"));
    }
    /**
     * Issues a request to the guest operating system asking it to perform a clean shutdown of all services. This request returns immediately and does not wait for the guest operating system to complete the operation.
     */
    public function shutdown($moid=null){
        return !ApiResponse::HasError($this->HttpClient->post("vm/{$this->getMoid($moid)}/guest/power",[
            "query"=>[
                "action"=>"shutdown"
            ]
        ]));
    }
    /**
     * Issues a request to the guest operating system asking it to perform a reboot. This request returns immediately and does not wait for the guest operating system to complete the operation
     */
    public function reboot($moid=null){
        return !ApiResponse::HasError($this->HttpClient->post("vm/{$this->getMoid($moid)}/guest/power",[
            "query"=>[
                "action"=>"reboot"
            ]
        ]));
    }
    /**
     * Issues a request to the guest operating system asking it to perform a suspend operation.
     */
    public function standby($moid=null){
        return !ApiResponse::HasError($this->HttpClient->post("vm/{$this->getMoid($moid)}/guest/power",[
            "query"=>[
                "action"=>"standby"
            ]
        ]));
    }

}