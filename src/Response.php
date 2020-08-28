<?php


namespace vsphere;


class Response
{
    private $message;
    private $path;
    private $status;
    public function __construct($status,$path,$message)
    {
        $this->message=$message;
        $this->path=$path;
        $this->status=$status;

    }


    public function __toString()
    {
        return "status : ".$this->status."\n"."path : ".$this->path."\n"."message : ".$this->message;
    }

   public function __get($property){

        return isset($this->$property) ?  $this->$property : null ;

   }

}