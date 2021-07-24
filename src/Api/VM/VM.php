<?php


namespace FNDEV\vShpare\Api\VM;
use GuzzleHttp\Client;
use vsphere\manageVmObjects;

class VM
{
    public Client $HttpClient;
    public function __construct(Client $client)
    {
        $this->HttpClient=$client;
    }
    public function all(array $query=null){
        $vms=$this->HttpClient->get("");
        return new manageVmObjects(json_decode($vms->getBody()),$this->connection);
    }
    public function byMoId($moid, array $query=[]){
        $response=$this->HttpClient->get("vcenter/vm/$moid",[],$query);
        return \vsphere\vm::makeVmInstance($this->connection,$response,$VM);
    }
}