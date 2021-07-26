<?php


namespace FNDEV\Tests\Unit\Models\Hardware;


use FNDEV\Tests\TestCase;
use FNDEV\vShpare\Api\VM\Hardware\Hardware;
use GuzzleHttp\Psr7\Response;
/**
 * @uses \FNDEV\vShpare\Api\VM\Hardware\Hardware
 */
class HardwareTest extends TestCase
{
    public Hardware $hardware;
    public function setUp(): void
    {
        parent::setUp();
        $this->hardware=new Hardware($this->vmwareApiClient->getHttpClient());
    }
    public function test_get_hardware(){
        $this->mockHandler->append(new Response(200,[],file_get_contents(__DIR__."/fixture/hardware.json")));
        $response=$this->hardware->getHardware("vm-111");
        $this->assertLastRequestEquals("GET","/vm/vm-111/hardware");
        $this->assertEquals("string",$response->value->upgrade_error);
        $this->assertEquals("VMX_03",$response->value->version);
        $this->assertEquals("NEVER",$response->value->upgrade_policy);
        $this->assertEquals("VMX_03",$response->value->upgrade_version);
        $this->assertEquals("NONE",$response->value->upgrade_status);
    }

}