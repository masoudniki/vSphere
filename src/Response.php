<?php


namespace vsphere;


class Response
{
    private $message;
    private $path;
    private $status;
    private $httpCode;
    public function __construct($status,$path,$message,$httpCode)
    {
        $this->message=$message;
        $this->path=$path;
        $this->status=$status;
        $this->httpCode=$httpCode;
    }


    public function __toString()
    {
        return "status : ".$this->status."\n"."path : ".$this->path."\n"."message : ".$this->message;
    }

   public function __get($property){

        return isset($this->$property) ?  $this->$property : null ;

   }

}