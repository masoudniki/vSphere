<?php


namespace FNDEV\vShpare\Api\VM\Traits;


trait IterableObject
{
    public function current()
    {
        return $this->items[$this->position];
    }
    public function next()
    {
        ++$this->position;
    }
    public function key()
    {
        return $this->position;
    }
    public function valid()
    {
        return array_key_exists($this->position,$this->items);
    }
    public function rewind()
    {
        $this->position = 0;
    }

}