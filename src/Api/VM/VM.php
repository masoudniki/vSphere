<?php


namespace FNDEV\vShpare\Api\VM;
use FNDEV\vShpare\Api\VM\ConsoleTickets\ConsoleTickets;
use FNDEV\vShpare\Api\VM\GuestPower\GuestPower;
use FNDEV\vShpare\Api\VM\Power\Power;
use FNDEV\vShpare\Api\VM\Tools\Tools;
use GuzzleHttp\Client;

class VM
{
    public Client $HttpClient;
    public function __construct(Client $client)
    {
        $this->HttpClient=$client;
    }
    public function power(){
        return new Power($this->HttpClient);
    }
    public function guestPower(){
        return new GuestPower($this->HttpClient);
    }
    public function tools(){
        return new Tools($this->HttpClient);
    }
    public function consoleTicket(){
        return new ConsoleTickets($this->HttpClient);
    }
    public function all(array $query=null){
        $response=$this->HttpClient->get("vm",[],$query);
        return new ManageVms(json_decode($response->getBody()),$this->HttpClient);
    }
    public function byMoId($moid, array $query=[]){
        $response=$this->HttpClient->get("vm/$moid",[],$query);
        return new VmSource($this->HttpClient,json_decode($response->getBody()),$moid);
    }
}