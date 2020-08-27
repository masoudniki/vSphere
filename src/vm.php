<?php
    namespace vsphere;
    class vm{

        private $connection;
        public $vm;
        public static $instance=[];
        public static function makeVmInstance(connection $connection,$properties,$vm=null){
            static::$instance=[];

            foreach ($properties as $items)
            {
                if(gettype($items)=="array")
                {
                    foreach ($items as $item)
                    {
                        static::$instance[]=new static($connection,$item,$vm);
                    }
                }
                else{
                        static::$instance[]=new static($connection,$items,$vm);
                    }

            }
            return (count(static::$instance)==1) ? static::$instance[0] :static::$instance;

        }


        private function __construct(connection $connection,$items,$vm=null)
        {
            $this->connection=$connection;
            $this->vm=$vm;
            $this->parseObject($items);
        }
        private function parseObject($items){
                foreach ($items as $key=>$value)
                {
                    $this->$key=$value;
                }
        }

        public function __set($name, $value)
        {
            $this->$name=$value;
        }

        public function getPowerStatus(){
            return $this->connection->makeRequest(connection::GET,"/vcenter/vm/$this->vm/power",false);
        }


        public function turnOffServer(){
            if($this->canUpdateVmStatus())
            {
                $this->poser_state="POWERED_OFF";
                return $this->connection->makeRequest(connection::POST,"/vcenter/vm/$this->vm/power/stop",false);
            }
            return "you cant".__METHOD__." bc the server is not running";

        }


        public function resetServer(){
            if($this->canUpdateVmStatus())
            {
                $this->power_state="POWERED_ON";
                return $this->connection->makeRequest(connection::POST,"/vcenter/vm/$this->vm/power/reset",false);
            }
            return "you cant".__METHOD__." bc the server is not running";
        }

        public function turnOnServer(){
            if(!$this->canUpdateVmStatus())
            {
                $this->power_state="POWERED_ON";
                return $this->connection->makeRequest(connection::POST,"/vcenter/vm/$this->vm/power/start",false);
            }
        }
        public function suspendServer(){
            if($this->canUpdateVmStatus()){
                $this->power_state="SUSPENDED";
                return $this->connection->makeRequest(connection::POST,"/vcenter/vm/$this->vm/power/suspend",false);

            }
        }


        public function canUpdateVmStatus($state="POWERED_ON"){
            return $this->power_state===$state;
        }


    }






?>


