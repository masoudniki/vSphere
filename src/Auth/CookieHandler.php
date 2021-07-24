<?php


namespace vsphere\Auth;

use FNDev\Proxmox\ApiResponse;
use FNDev\Proxmox\ProxmoxApiClient;

class CookieHandler
{
    const COOKIE_KEY="PMGAuthCookie";
    public static string $cookie='';
    public static string $CSRFToken='';
    public static function getCookie(ProxmoxApiClient $client){
        if(self::$cookie)
            return self::$cookie;
        else
            return (self::$cookie=self::AuthRequest($client));
    }
    public static function AuthRequest(ProxmoxApiClient $client){
        $HttpClient=new Client(
            [
                "verify"=>$client->ssl,
                "Content-Type"=>"application/x-www-form-urlencoded",
                "User-Agent"=>"User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36",
                "X-Requested-With: XMLHttpRequest"
            ]
        );
        $response=$HttpClient->request("POST",$client->getAuthUrl(),[
            "form_params"=>[
                "username"=>$client->username,
                "password"=>$client->password,
                "realm"=>"pmg"
            ]
        ]);
        if(!ApiResponse::HasError($response)){
            $jsonDecodedResponse=json_decode($response->getBody());
            self::$cookie=$jsonDecodedResponse->data->ticket;
            self::$CSRFToken=$jsonDecodedResponse->data->CSRFPreventionToken;
            return self::createCookie();
        };

    }
    public static function createCookie(){
        return self::COOKIE_KEY."=".self::$cookie;
    }
    public static function getCsrfToken(ProxmoxApiClient $client){
        if(self::$CSRFToken)
            return self::$CSRFToken;
        else
            return (self::$CSRFToken=self::AuthRequest($client));
    }
}