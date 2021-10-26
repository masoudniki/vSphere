<?php


namespace FNDEV\vShpare\Api\VM\Hardware\Boot;


use FNDEV\vShpare\Api\VM\Abstracts\InitClass;
use FNDEV\vShpare\Api\VM\Traits\MOID;
use FNDEV\vShpare\ApiResponse;

class Boot extends InitClass
{
    use MOID;
    public function getHardwareBoot($moid=null){
        return ApiResponse::BodyResponse($this->HttpClient->get("vm/{$this->getMoid($moid)}/hardware/boot"));
    }
    public function updateHardwareBoot($moid=null){
        return ApiResponse::BodyResponse($this->HttpClient->get("vm/{$this->getMoid($moid)}/hardware"));
    }
}