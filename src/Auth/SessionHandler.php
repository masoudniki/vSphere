<?php


namespace FNDEV\vShpare\Auth;

use FNDEV\vShpare\Exceptions\CredentialException;
use FNDEV\vShpare\VmwareApiClient;
use GuzzleHttp\Client;

class SessionHandler
{
    public static function getSession(VmwareApiClient $client){
        self::validateCredentials($client);
        return self::isSessionExist($client->credential) ? $client->credential['Vmware-Api-Session-Id'] : self::authRequest($client);
    }
    public static function authRequest(VmwareApiClient $client){
        $HttpClient=new Client(
            [
                "verify"=>$client->ssl,
                "headers"=>[
                    "Content-Type"=>"application/x-www-form-urlencoded",
                    "Accept" => "application/json",
                    "Authorization"=>"Basic ".self::convertCredentials($client->credential)
                ]
            ]
        );
        $response=$HttpClient->request('GET',$client->getAuthUrl(),[
            "query"=>[
                "~method"=>"post"
            ]
        ]);
        return json_decode($response->getBody())->value;
    }
    public static function isSessionExist($credential){
        return array_key_exists("Vmware-Api-Session-Id",$credential);
    }
    public static function validateCredentials(VmwareApiClient $client)
    {
        if((array_key_exists("username",$client->credential) && array_key_exists("password",$client->credential)) or array_key_exists("Vmware-Api-Session-Id",$client->credential))
            return true;
        throw new CredentialException("required parameter you should send session-id or username-password for auth api ");
    }
    public static function convertCredentials($credentials){
        return base64_encode($credentials['username'].":".$credentials['password']);
    }

}