<?php
    namespace FNDEV\vShpare\Api\VM;

    use FNDEV\vShpare\Api\VM\Traits\IterableObject;

    class ManageVms{
        use IterableObject;
        private $items=[];
        private $position = 0;

        public function __construct($vms,$connection)
        {
            $this->position = 0;
            $this->parseObjects($vms,$connection);
        }
        public function parseObjects($vms,$connection){
            $vms=vm::makeVmInstance($connection,$vms);
            (gettype($vms)=="array") ? $this->items=$vms : $this->items[]=$vms;

        }
        public function first(){
            return (count($this->items) >= 1) ? $this->items[0] : null ;
        }
    }
