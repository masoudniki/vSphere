<?php


namespace FNDEV\vShpare\Api\VM;


use FNDEV\vShpare\Api\VM\ConsoleTickets\ConsoleTickets;
use FNDEV\vShpare\Api\VM\GuestPower\GuestPower;
use FNDEV\vShpare\Api\VM\Hardware\Hardware;
use FNDEV\vShpare\Api\VM\Power\Power;
use FNDEV\vShpare\Api\VM\Tools\Tools;
use FNDEV\vShpare\ApiResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class VmSource
{
    public Client $HttpClient;
    public $properties;
    public $moid;
    const POWERED_ON="POWERED_ON";
    const POWERED_OFF="POWERED_OFF";
    const SUSPENDED="SUSPENDED";
    public function __construct(Client $HttpClient,$properties,$moid)
    {
        $this->HttpClient=$HttpClient;
        $this->properties=isset($properties->value) ? $properties->value : $properties;
        $this->moid=$moid;
    }
    public function __get($name)
    {
        return $this->properties->{$name};
    }
    public function reloadProperties(){
        $this->properties=ApiResponse::BodyResponse($this->HttpClient->get("vm/{$this->moid}"))->value;
        return $this;
    }
    public function power(){
        return new Power($this->HttpClient,$this);
    }
    public function guestPower(){
        return new GuestPower($this->HttpClient,$this);
    }
    public function tools(){
        return new Tools($this->HttpClient,$this);
    }
    public function consoleTicket(){
        return new ConsoleTickets($this->HttpClient,$this);
    }
    public function hardware(){
        return new Hardware($this->HttpClient,$this);
    }
    public function resources(){
        return new Resources\Resources($this->HttpClient,$this);
    }
    public function isPoweredOn(){
        return $this->properties->power_state==self::POWERED_ON;
    }
    public function isPoweredOff(){
        return $this->properties->power_state==self::POWERED_OFF;
    }
    public function isSuspended(){
        return $this->properties->power_state==self::SUSPENDED;
    }
}