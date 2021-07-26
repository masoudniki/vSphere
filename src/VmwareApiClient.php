<?php
    namespace FNDEV\vShpare;
    use FNDEV\vShpare\Client\GuzzleClient;
    use \GuzzleHttp\Client;
    class VmwareApiClient{
        public $host;
        public $credential;
        public $HttpClient;
        public $ssl;
        public $baseUrl;
        public $authUrl;
        public $protocol;
        public function __construct($host,$port=443,array $credential,$ssl=false,$protocol="https",$baseurl="/rest/vcenter",$authurl="/rest/com/vmware/cis/session",?Client $client=null)
        {
            $this->host=$host;
            $this->port=$port;
            $this->credential=$credential;
            $this->ssl=$ssl;
            $this->baseUrl=$baseurl;
            $this->authUrl=$authurl;
            $this->protocol=$protocol;
            $this->HttpClient=$client??new GuzzleClient($this);
        }
        public function vm(){
            return new Api\VM\VM($this->HttpClient);
        }
        public function getHttpClient(){
            return $this->HttpClient;
        }
        public function setHttpClient(Client $client){
            $this->HttpClient=$client;
        }
        public function getSessionId(){
            return $this->HttpClient;
        }
        public function getBaseUrl(){
            return $this->addScheme($this->host.":".$this->port."/".trim($this->baseUrl,"/")."/",$this->protocol);
        }
        public function getAuthUrl(){
            return  $this->addScheme($this->host.":".$this->port."/".trim($this->authUrl,"/"),$this->protocol);
        }
        function addScheme($url, $scheme = 'http')
        {
            return parse_url($url, PHP_URL_SCHEME) === null ?
                $scheme."://" . $url : $url;
        }
    }

