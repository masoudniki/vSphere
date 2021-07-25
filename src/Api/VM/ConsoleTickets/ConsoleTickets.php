<?php


namespace FNDEV\vShpare\Api\VM\ConsoleTickets;


use FNDEV\vShpare\Api\VM\Abstracts\InitClass;
use FNDEV\vShpare\Api\VM\Traits\MOID;
use FNDEV\vShpare\ApiResponse;
use GuzzleHttp\RequestOptions;

class ConsoleTickets extends InitClass
{
    use MOID;
    public function createConsoleTickets(array $body,$moid=null){
        return ApiResponse::BodyResponse($this->HttpClient->post("vm/{$this->getMoid()}/console/tickets",[
            RequestOptions::JSON=>$body
        ]));
    }
}