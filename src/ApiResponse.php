<?php


namespace FNDEV\vShpare;


use GuzzleHttp\Psr7\Response;

class ApiResponse
{
    const OK=200;
    public static function BodyResponse(Response $response){
        return json_decode($response->getBody());
    }
    public static function HasError(Response $response){
        return !($response->getStatusCode()>=200 and $response->getStatusCode() <300);
    }
}