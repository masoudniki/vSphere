<?php


namespace FNDEV\vShpare\Api\VM\Tools;


use FNDEV\vShpare\Api\VM\Abstracts\InitClass;
use FNDEV\vShpare\Api\VM\Traits\MOID;
use FNDEV\vShpare\Api\VM\VmSource;
use FNDEV\vShpare\ApiResponse;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class Tools extends InitClass
{
    use MOID;

    /**
     * Get the properties of VMware Tools.
     */
    public function tools($moid=null){
        return ApiResponse::BodyResponse($this->HttpClient->get("vm/{$this->getMoid()}/tools"));
    }

    /**
     * Update the properties of VMware Tools.
     */
    public function updateTools(array $body,$moid=null){
        return ApiResponse::BodyResponse($this->HttpClient->patch("vm/{$this->getMoid()}/tools",[
            RequestOptions::JSON=>$body
        ]));
    }

    /**
     * Begins the Tools upgrade process. To monitor the status of the Tools upgrade, clients should check the Tools status by calling Tools.get and examining Tools.Info.version-status and Tools.Info.run-state.
     */
    public function upgradeTools($body, $moid=null){
        return ApiResponse::BodyResponse($this->HttpClient->post("vm/{$this->getMoid()}/tools",[
            "query"=>[
              "action"=>"upgrade"
            ],
            RequestOptions::JSON=>$body
        ]));
    }
}