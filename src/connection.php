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
    public static function getInstance(\GuzzleHttp\Client $connection,$host,array $credential){
        if(static::$connectionInstance==null)
        {
            static::$connectionInstance=new self($connection,$host,$credential);
        }
        return static::$connectionInstance;


    }

    private function __construct($connection,$host,array $credential)
    {
        $this->host=$host;
        $this->connection=$connection;
        $this->HowAuthenticate($credential);

    }


    public function makeRequest($method,$path,$custom,array $content=null)
    {
        $options=[];
        if(!$custom) {
            $options = [
                "headers" => [
                    "Vmware-Api-Session-Id" => $this->session,
                    "Accept" => "application/json",
                ]
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
        try{

            return $this->connection->request($method, $path, $options);

        }
        catch (\GuzzleHttp\Exception\GuzzleException $e) {

            return $this->pareseException($e);
        }


    }
    public function getSession($username,$password){
        $response=$this->makeRequest(static::POST_WITH_QUERY,static::LOGIN_URL,true,[
            'auth' => [$username, $password],
            "query"=>[
                "~method"=>"post"
            ]
        ]);

        $this->session=((object)json_decode($response->getBody()))->value;
        return true;

    }
    private function genApiRequestUri($path){

        return $this->host."rest".self::URL_SEPARATOR.$path;

    }


    private function pareseException($e){

        switch (get_class($e))
        {
            case "GuzzleHttp\Exception\RequestException" :return $this->requestException($e);

            case "GuzzleHttp\Exception\ClientException" : return $this->clientException($e);

            case "GuzzleHttp\Exception\ServerException" : return $this->serverException($e);

        }
    }

    private function clientException($e)
    {

        switch ($e->getCode())
        {
            case "503": throw new Exceptions\SystemException("system is unable to communicate with a service to complete the request",503);

            case "404": throw new Exceptions\NotFoundException($e->getMessage(),404);

            case "403": throw new Exceptions\PrivilegeException("user doesn't have the required privileges.",404);

            case "401": throw new Exceptions\UnauthenticatedException($e->getMessage(),401);

            case "400": throw new \vsphere\Exceptions\UnauthenticatedException($e->getMessage(),400);


        }



    }
    private function requestException($e)
    {
       throw $e;
    }
    private function serverException($e){

        switch ($e->getCode()){

            case 500 : throw new Exceptions\ServerException();

        }


    }


    private function HowAuthenticate(array $credential)
    {
        if(array_key_exists("username",$credential) && array_key_exists("password",$credential))
        {
            # get session with username and password
            return $this->getSession($credential['username'],$credential['password']);
        }
        elseif(array_key_exists("Vmware-Api-Session-Id",$credential)){
            return $this->session=$credential["Vmware-Api-Session-Id"];
        }

        throw new Exceptions\CredentialException("required parameter you should send session-id or username-password for auth api ");


    }

}

