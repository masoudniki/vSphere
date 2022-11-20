<?php

namespace FNDEV\Tests;

use FNDEV\vShpare\VmwareApiClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use LKDev\HetznerCloud\HetznerAPIClient;

class TestCase extends \PHPUnit\Framework\TestCase
{

    public $vmwareApiClient;
    public $mockHandler;


    public function setUp(): void
    {
        $this->mockHandler = new MockHandler();
        $this->vmwareApiClient=new VmwareApiClient('127.0.0.1',["username"=>"admin","password"=>"admin"],"443",false, 'https','/rest','/rest/com/vmware/cim/session',new Client(['handler'=>$this->mockHandler]));
    }
    public function tearDown(): void
    {
        $this->mockHandler->reset();
        parent::tearDown();
    }
    public function assertLastRequestEquals($method, $urlFragment)
    {
        $this->assertEquals($this->mockHandler->getLastRequest()->getMethod(), $method);
        $this->assertEquals('/'.$this->mockHandler->getLastRequest()->getUri()->getPath(), $urlFragment);
    }
    public function assertLastRequestBodyIsEmpty()
    {
        $body = (string) $this->mockHandler->getLastRequest()->getBody();
        $this->assertEmpty($body);
    }
    public function assertLastRequestQueryStrings($query){
        $this->assertEquals($this->mockHandler->getLastRequest()->getUri()->getQuery(),http_build_query($query));
    }
    public function assertLastRequestBody($body){
        $this->assertEquals((string)$this->mockHandler->getLastRequest()->getBody(),json_encode($body));
    }

}