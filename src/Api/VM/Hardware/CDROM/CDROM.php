<?php


namespace FNDEV\vShpare\Api\VM\Hardware\CDROM;


use FNDEV\vShpare\Api\VM\Abstracts\InitClass;
use FNDEV\vShpare\Api\VM\Traits\MOID;
use FNDEV\vShpare\ApiResponse;

class CDROM extends InitClass
{
    use MOID;
    public function getListCdRom($moid=null){
        return ApiResponse::BodyResponse($this->HttpClient->get("vm/{$this->getMoid($moid)}/hardware/cdrom"));
    }
    public function CreateCdRom($moid=null,$config){
        return ApiResponse::BodyResponse($this->HttpClient->post("vm/{$this->getMoid()}/hardware/cdrom",[
            "json"=>$config
        ]));
    }
    public function getCdRom($cdrom,$moid=null){
        return ApiResponse::BodyResponse($this->HttpClient->get("vm/{$this->getMoid($moid)}/hardware/cdrom/$cdrom"));
    }
    public function deleteCdRom($cdrom,$moid=null){
        return ApiResponse::BodyResponse($this->HttpClient->delete("vm/{$this->getMoid($moid)}/hardware/cdrom/$cdrom"));
    }
    public function connectCdRom($cdrom,$moid=null){
        return ApiResponse::BodyResponse($this->HttpClient->post("vm/{$this->getMoid($moid)}/hardware/cdrom/$cdrom",
            [
                "query"=>[
                    "action"=>"disconnect"
                ]
            ]
        ));
    }
    public function disconnectCdRom($cdrom,$moid=null){
        return ApiResponse::BodyResponse($this->HttpClient->post("vm/{$this->getMoid($moid)}/hardware/cdrom/$cdrom",
            [
                "query"=>[
                    "action"=>"disconnect"
                ]
            ]
        ));
    }
    public function updateCdRom($cdrom,$moid){
        return ApiResponse::BodyResponse($this->HttpClient->post("vm/{$this->getMoid($moid)}/hardware/cdrom/$cdrom"));
    }

}