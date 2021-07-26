<?php


namespace FNDEV\vShpare\Api\VM\Traits;


trait MOID
{
    public function getMoid($moid=null){
        if($moid)
            return $moid;
        if($this->vmSource && isset($this->vmSource->moid))
            return $this->vmSource->moid;
        throw new \InvalidArgumentException("provide moid or pass vmSource object");
    }
}