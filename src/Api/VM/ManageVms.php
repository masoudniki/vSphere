<?php
    namespace FNDEV\vShpare\Api\VM;

    use FNDEV\vShpare\Api\VM\Traits\IterableObject;
    use GuzzleHttp\Psr7\Response;

    class ManageVms{
        use IterableObject;
        private $items=[];
        private $position=0;
        public function __construct($vms,$HttpClient)
        {
            $this->parseObjects($vms,$HttpClient);
        }
        public function parseObjects($vms,$HttpClient){
            foreach ($vms as $VmProperties){
                $this->items[]=new VmSource($HttpClient,$VmProperties,$VmProperties->vm);
            }
        }
        public function first(){
            return (count($this->items) >= 1) ? $this->items[0] : null ;
        }
    }
