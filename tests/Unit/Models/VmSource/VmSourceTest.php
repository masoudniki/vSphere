<?php


namespace FNDEV\Tests\Unit\Models\VmSource;


use FNDEV\Tests\TestCase;
use FNDEV\vShpare\Api\VM\ConsoleTickets\ConsoleTickets;
use FNDEV\vShpare\Api\VM\GuestPower\GuestPower;
use FNDEV\vShpare\Api\VM\Hardware\Hardware;
use FNDEV\vShpare\Api\VM\Power\Power;
use FNDEV\vShpare\Api\VM\Tools\Tools;
use FNDEV\vShpare\Api\VM\VmSource;
use GuzzleHttp\Psr7\Response;

class VmSourceTest extends TestCase
{
    public VmSource $vmsource;
    public function setUp(): void
    {
        parent::setUp();
        $properties=json_decode(file_get_contents(__DIR__."/fixture/properties.json"));
        $this->vmsource=new VmSource($this->vmwareApiClient->getHttpClient(),$properties,'vm-111');
    }
    public function test_get_properties(){
        $this->assertEquals("vm-111",$this->vmsource->moid);
        $this->assertEquals("POWERED_OFF",$this->vmsource->power_state);
        $this->assertEquals("string",$this->vmsource->name);
    }
    public function test_get_power_accessor(){
        $powerAccessor=$this->vmsource->power();
        $this->assertEquals("vm-111",$powerAccessor->vmSource->moid);
        $this->assertInstanceOf(Power::class,$powerAccessor);
    }
    public function test_get_guest_power_accessor(){
        $guestPowerAccessor=$this->vmsource->guestPower();
        $this->assertEquals("vm-111",$guestPowerAccessor->vmSource->moid);
        $this->assertInstanceOf(GuestPower::class,$guestPowerAccessor);
    }
    public function test_get_tools_accessor(){
        $toolsAccessor=$this->vmsource->tools();
        $this->assertEquals("vm-111",$toolsAccessor->vmSource->moid);
        $this->assertInstanceOf(Tools::class,$toolsAccessor);
    }
    public function test_get_hardware_accessor(){
        $hardwareAccessor=$this->vmsource->hardWare();
        $this->assertEquals("vm-111",$hardwareAccessor->vmSource->moid);
        $this->assertInstanceOf(Hardware::class,$hardwareAccessor);
    }
    public function test_get_console_ticket_accessor(){
        $consoleTicketAccessor=$this->vmsource->consoleTicket();
        $this->assertEquals("vm-111",$consoleTicketAccessor->vmSource->moid);
        $this->assertInstanceOf(ConsoleTickets::class,$consoleTicketAccessor);
    }
    public function test_check_power_off(){
        $this->assertTrue($this->vmsource->isPoweredOff());
    }
    public function test_check_power_on(){
        $this->assertFalse($this->vmsource->isPoweredOn());
    }
    public function test_check_suspend(){
        $this->assertFalse($this->vmsource->isSuspended());
    }
    public function test_reload_properties(){
        $this->mockHandler->append(new Response(200,[],file_get_contents(__DIR__."/fixture/properties.json")));
        $this->vmsource->reloadProperties();
        $this->assertLastRequestEquals("GET","/vcenter/vm/vm-111");
        $this->assertLastRequestBodyIsEmpty();
        $this->assertEquals("POWERED_OFF",$this->vmsource->power_state);
    }
    public function test_turn_vm_on_with_power_accessor(){
        $this->mockHandler->append(new Response(200,[],""));
        $this->assertTrue($this->vmsource->power()->powerOn());
        $this->assertLastRequestEquals("POST","/vcenter/vm/vm-111/power/start");
        $this->assertLastRequestBodyIsEmpty();
    }

}