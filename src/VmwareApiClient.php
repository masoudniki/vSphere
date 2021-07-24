<?php
    namespace FNDEV\vShpare;
    use FNDEV\vShpare\Client\GuzzleClient;
    use \GuzzleHttp\Client;
    class VmwareApiClient{
        private $connection;
        public $host;
        public $credential;
        public $httpClient;
        public function __construct($host,array $credential,Client $client)
        {
            $this->host=$host;
            $this->credential=$credential;
            $this->httpClient=$client??new GuzzleClient();
        }
        public function getSessionId(){
            return $this->connection->session;
        }
    }

