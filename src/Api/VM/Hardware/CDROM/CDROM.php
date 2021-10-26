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
    public function createCdRom($config,$moid=null){
        return ApiResponse::BodyResponse($this->HttpClient->post("vm/{$this->getMoid($moid)}/hardware/cdrom",[
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
        return ApiResponse::BodyResponse($this->HttpClient->post("vm/{$this->getMoid($moid)}/hardware/cdrom/$cdrom/connect"));
    }
    public function disconnectCdRom($cdrom,$moid=null){
        return ApiResponse::BodyResponse($this->HttpClient->post("vm/{$this->getMoid($moid)}/hardware/cdrom/$cdrom/disconnect"));
    }
    public function updateCdRom($cdrom,$config,$moid=null){
        return ApiResponse::BodyResponse($this->HttpClient->patch("vm/{$this->getMoid($moid)}/hardware/cdrom/$cdrom",[
            "json"=>$config
        ]));
    }

}