<?php


namespace FNDEV\Tests\Unit\Models\Power;


use FNDEV\Tests\TestCase;
use FNDEV\vShpare\Api\VM\Power\Power;
use GuzzleHttp\Psr7\Response;
use http\Exception\InvalidArgumentException;
use PhpParser\Node\Scalar\MagicConst\Dir;
/**
 * @uses \FNDEV\vShpare\Api\VM\Power\Power
 */
class PowerTest extends TestCase
{
    public Power $power;
    public function setUp(): void
    {
        parent::setUp();
        $this->power=new Power($this->vmwareApiClient->getHttpClient());
    }
    public function test_power_off_vm(){
        $this->mockHandler->append(new Response(200,[],""));
        $this->assertTrue($this->power->powerOff('vm-111'));
        $this->assertLastRequestEquals("POST","/vm/vm-111/power/stop");
        $this->assertLastRequestBodyIsEmpty();
    }
    public function test_can_not_get_power_with_out_moid(){
        $this->expectException(\InvalidArgumentException::class);
        $this->assertTrue($this->power->powerOff());
    }
    public function test_power_on_vm(){
        $this->mockHandler->append(new Response(200,[],""));
        $this->assertTrue($this->power->powerOn('vm-111'));
        $this->assertLastRequestEquals("POST","/vm/vm-111/power/start");
        $this->assertLastRequestBodyIsEmpty();
    }
    public function test_reset_vm(){
        $this->mockHandler->append(new Response(200,[],""));
        $this->assertTrue($this->power->reset('vm-222'));
        $this->assertLastRequestEquals("POST","/vm/vm-222/power/reset");
        $this->assertLastRequestBodyIsEmpty();
    }
    public function test_suspend_vm(){
        $this->mockHandler->append(new Response(200,[],""));
        $this->assertTrue($this->power->suspend('vm-222'));
        $this->assertLastRequestEquals("POST","/vm/vm-222/power/suspend");
        $this->assertLastRequestBodyIsEmpty();
    }
    public function test_get_power(){
        $this->mockHandler->append(new Response(200,[],file_get_contents(__DIR__."/fixture/power.json")));
        $response=$this->power->power('vm-111');
        $this->assertLastRequestEquals("GET","/vm/vm-111/power");
        $this->assertEquals("POWERED_OFF",$response->value->state);
        $this->assertEquals(true,$response->value->clean_power_off);
    }
}