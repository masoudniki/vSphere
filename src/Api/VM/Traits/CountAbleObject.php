<?php


namespace FNDEV\vShpare\Api\VM\Traits;


trait CountAbleObject
{
    public function count()
    {
        return count($this->items);
    }
}