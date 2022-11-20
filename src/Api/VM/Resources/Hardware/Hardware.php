<?php


namespace FNDEV\vShpare\Api\VM\Resources\Hardware;


use FNDEV\vShpare\Api\VM\Abstracts\InitClass;
use FNDEV\vShpare\Api\VM\Traits\MOID;
use FNDEV\vShpare\ApiResponse;

class Hardware extends InitClass
{
    use MOID;
    public function getHardware($moid=null){
        return ApiResponse::BodyResponse($this->HttpClient->get("vcenter/vm/{$this->getMoid($moid)}/hardware"));
    }
}