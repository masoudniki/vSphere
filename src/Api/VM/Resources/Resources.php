<?php


namespace FNDEV\vShpare\Api\VM\Resources;


use FNDEV\vShpare\Api\VM\Abstracts\InitClass;
use FNDEV\vShpare\Api\VM\Resources\Hardware\Hardware;

class Resources extends InitClass
{
    public function hardware(){
        return new Hardware($this->HttpClient,$this->vmSource);
    }

}