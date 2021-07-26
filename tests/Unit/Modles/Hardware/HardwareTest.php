<?php


namespace FNDEV\Tests\Unit\Modles\Hardware;


use FNDEV\Tests\TestCase;
use FNDEV\vShpare\Api\VM\Hardware\Hardware;
use GuzzleHttp\Psr7\Response;

class HardwareTest extends TestCase
{
    public Hardware $hardware;
    public function setUp(): void
    {
        parent::setUp();
        $this->hardware=new Hardware($this->vmwareApiClient->getHttpClient());
    }
    public function test_get_hardware(){
        $this->mockHandler->append(new Response(200,[],file_get_contents("file")));
    }

}