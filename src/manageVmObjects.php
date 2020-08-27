<?php
    namespace vsphere;

    class manageVmObjects implements \Iterator{
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


        public function first(){
            return (count($this->items) >= 1) ? $this->items[0] : null ;
        }
    }
