<?php


namespace FNDEV\vShpare\Api\VM\Hardware;


use FNDEV\vShpare\Api\VM\Abstracts\InitClass;
use FNDEV\vShpare\Api\VM\Hardware\Boot\Boot;
use FNDEV\vShpare\Api\VM\Traits\MOID;
use FNDEV\vShpare\ApiResponse;

class Hardware extends InitClass
{
    public function cdrom(){
        return new CDROM\CDROM($this->HttpClient,$this->vmSource);
    }
    public function boot(){
        return new Boot($this->HttpClient,$this->vmSource);
    }

}