<?php
    namespace vsphere;
    use \GuzzleHttp\Client;
    class vmware{
        const GET ="GET";
        const POST="POST";
        private $connection;


        public function __construct($host,array $credential, $verifyCE)
        {

            $this->connection=connection::getInstance(new Client(['verify'=>$verifyCE]),$this->normalize_url($host),$credential);

        }


        public function getAllOfVm(array $content=null){

            $vms=$this->connection->makeRequest(self::GET,"vcenter/vm",false,$content);


            return new manageVmObjects(json_decode($vms->getBody()),$this->connection);


        }
        public function getVmByVm($VM,array $content=null){

            $object=$this->connection->makeRequest(self::GET,"vcenter/vm/$VM",false,$content);

            return vm::makeVmInstance($this->connection,json_decode($object->getBody()),$VM);

        }
        public function getSessionId(){
            return $this->connection->session;
        }

        private function normalize_url($url){
        if(substr($url, -1) != '/')
            return $url . '/';

        return $url;
    }



    }

