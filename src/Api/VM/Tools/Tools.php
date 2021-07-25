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
    public function tools($moid=null){
        return ApiResponse::BodyResponse($this->HttpClient->get("vm/{$this->getMoid()}/tools"));
    }
    public function updateTools(array $body,$moid=null){
        return ApiResponse::BodyResponse($this->HttpClient->patch("vm/{$this->getMoid()}/tools",[
            RequestOptions::JSON=>$body
        ]));
    }
    public function upgradeTools($body,$moid=null){
        return ApiResponse::BodyResponse($this->HttpClient->post("vm/{$this->getMoid()}/tools",[
            "query"=>[
              "action"=>"upgrade"
            ],
            RequestOptions::JSON=>$body
        ]));
    }
}