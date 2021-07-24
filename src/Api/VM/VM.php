<?php


namespace FNDEV\vShpare\Api\VM;
use GuzzleHttp\Client;
use vsphere\manageVmObjects;

class VM
{
    public Client $httpClient;
    public function __construct(Client $client)
    {
        $this->httpClient=$client;
    }
    public function allVms(array $content=null){
        $vms=$this->httpClient->get();
        return new manageVmObjects(json_decode($vms->getBody()),$this->connection);
    }
    public function vmByMoId($VM, array $content=null){
        $response=$this->httpClient->get("vcenter/vm/$VM",false,$content);
        return \vsphere\vm::makeVmInstance($this->connection,$response,$VM);
    }
}