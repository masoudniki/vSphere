<?php


namespace FNDEV\Tests\Unit\Models\GuestPower;


use FNDEV\Tests\TestCase;
use FNDEV\vShpare\Api\VM\GuestPower\GuestPower;
use GuzzleHttp\Psr7\Response;

/**
 * @uses \FNDEV\vShpare\Api\VM\GuestPower\GuestPower
 */
class GuestPowerTest extends TestCase
{
    public GuestPower $guestPower;
    public function setUp(): void
    {
        parent::setUp();
        $this->guestPower=new GuestPower($this->vmwareApiClient->getHttpClient());
    }
    public function test_get_guest_power(){
        $this->mockHandler->append(new Response(200,[],file_get_contents(__DIR__."/fixture/power.json")));
        $response=$this->guestPower->power("vm-111");
        $this->assertLastRequestEquals("GET","/vm/vm-111/guest/power");
        $this->assertEquals("RUNNING",$response->value->state);
        $this->assertEquals(true,$response->value->operations_ready);
    }
    public function test_guest_reboot_vm(){
        $this->mockHandler->append(new Response(200,[],""));
        $this->assertTrue($this->guestPower->reboot("vm-111"));
        $this->assertLastRequestEquals("POST","/vm/vm-111/guest/power");
        $this->assertLastRequestBodyIsEmpty();
        $this->assertLastRequestQueryStrings([
                "action"=>"reboot"
        ]);
    }
    public function test_guest_shutdown_vm(){
        $this->mockHandler->append(new Response(200,[],""));
        $this->assertTrue($this->guestPower->shutdown("vm-111"));
        $this->assertLastRequestEquals("POST","/vm/vm-111/guest/power");
        $this->assertLastRequestBodyIsEmpty();
        $this->assertLastRequestQueryStrings([
                "action"=>"shutdown"
        ]);
    }
    public function test_guest_standby_vm(){
        $this->mockHandler->append(new Response(200,[],""));
        $this->assertTrue($this->guestPower->standby("vm-111"));
        $this->assertLastRequestBodyIsEmpty();
        $this->assertLastRequestEquals("POST","/vm/vm-111/guest/power");
        $this->assertLastRequestQueryStrings([
                "action"=>"standby"
        ]);
    }

}