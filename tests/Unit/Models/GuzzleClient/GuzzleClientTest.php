<?php


namespace FNDEV\Tests\Unit\Models\GuzzleClient;


use FNDEV\Tests\TestCase;
use FNDEV\vShpare\Auth\SessionHandler;
use FNDEV\vShpare\Client\GuzzleClient;
use GuzzleHttp\Psr7\Response;

class GuzzleClientTest extends TestCase
{
    public function test_create_instance_from_guzzle_client(){
        SessionHandler::$client=$this->vmwareApiClient->getHttpClient();
        $this->mockHandler->append(new Response(200,[],file_get_contents(__DIR__."/fixture/session.json")));
        new GuzzleClient($this->vmwareApiClient);
        $this->assertLastRequestEquals("GET","//rest/com/vmware/cim/session");
    }

}