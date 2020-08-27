<?php
    namespace vsphere;
    class connection{
        const LOGIN_URL = "com/vmware/cis/session";
        const GET ="GET";
        const POST="POST";
        const POST_WITH_QUERY="POST?";
        const URL_SEPARATOR = "/";
        public $session;
        public $connection;
        public static $connectionInstance=null;
        private $host;
        private $username;
        private $password;
        private $verifyCE;
        public static function getInstance(\GuzzleHttp\Client $connection,$host,$username,$password,$verifyCE){
            if(static::$connectionInstance==null)
            {
                static::$connectionInstance=new self($connection,$host,$username,$password,$verifyCE);
            }
            return static::$connectionInstance;


        }

        private function __construct($connection,$host,$username,$password,$verifyCE)
        {
                $this->host=$host;
                $this->username=$username;
                $this->password=$password;
                $this->verifyCE=$verifyCE;
                $this->connection=$connection;

        }


        public function makeRequest($method,$path,$custom,array $content=null)
        {
            $options=[];
            if(!$custom) {
                $options = [
                    "headers" => [
                        "Vmware-Api-Session-Id" => $this->session,
                        "Accept" => "application/json",


                    ],
                    "verify"=>$this->verifyCE
                ];

            }

            if($content!=null)
            {
                switch($method)
                {
                    case self::GET:$options["query"]=$content;
                        break;

                    case self::POST:$options["json"]=$content;
                        break;

                    case self::POST_WITH_QUERY: $options=array_merge($options,$content);$method="POST";
                        break;
                }

            }


            $path=$this->genApiRequestUri($path);

            try {
                return $this->connection->request($method, $path, $options);
            }
            catch (\GuzzleHttp\Exception\GuzzleException $e) {

                switch($e->getCode())
                {
                    case 401: echo "401 Unauthorized username or password is not correct";
                        break;
                    case 404: echo "host not found";
                        break;
                    default : var_dump($e);
                }
            }


        }
        public function getSession(){
                $response=$this->makeRequest(static::POST_WITH_QUERY,static::LOGIN_URL,true,[
                    'auth' => [$this->username, $this->password],
                    "verify"=>$this->verifyCE,
                    "query"=>[
                        "~method"=>"post"
                    ]
                ]);

                $this->session=((object)json_decode($response->getBody()))->value;


        }
        private function genApiRequestUri($path){

            return $this->host."rest".self::URL_SEPARATOR.$path;

        }


    }

