<?php


namespace FNDEV\Tests\Unit\Modles\VM;


use FNDEV\Tests\TestCase;
use FNDEV\vShpare\Api\VM\ConsoleTickets\ConsoleTickets;
use FNDEV\vShpare\Api\VM\GuestPower\GuestPower;
use FNDEV\vShpare\Api\VM\Hardware\Hardware;
use FNDEV\vShpare\Api\VM\ManageVms;
use FNDEV\vShpare\Api\VM\Power\Power;
use FNDEV\vShpare\Api\VM\Tools\Tools;
use FNDEV\vShpare\Api\VM\VM;
use FNDEV\vShpare\Api\VM\VmSource;
use GuzzleHttp\Psr7\Response;

class VMTest extends TestCase
{
    public VM $vm;
    public function setUp():void {
        parent::setUp();
        $this->vm=new VM($this->vmwareApiClient->getHttpClient());
    }
    public function test_get_vm_by_mo_id(){
        $this->mockHandler->append(new Response(200, [], file_get_contents(__DIR__.'/fixture/vm.json')));
        $vmSource=$this->vm->byMoId('vm-111');
        $this->assertInstanceOf(VmSource::class,$vmSource);
        $this->assertEquals("vm-111",$vmSource->moid);
        $this->assertLastRequestEquals("GET","/vm/vm-111");
    }
    public function test_get_all_vms(){
        $this->mockHandler->append(new Response(200,[],file_get_contents(__DIR__.'/fixture/vms.json')));
        $vmManager=$this->vm->all();
        $this->assertInstanceOf(ManageVms::class,$vmManager);
        $this->assertLastRequestEquals("GET","/vm");
        $this->assertCount(4, $vmManager);
        $this->assertInstanceOf(VmSource::class,$vmManager->first());
    }
    public function test_get_power_accessor(){
        $powerAccessor=$this->vm->power();
        $this->assertInstanceOf(Power::class,$powerAccessor);
    }
    public function test_get_tools_accessor(){
        $toolsAccessor=$this->vm->tools();
        $this->assertInstanceOf(Tools::class,$toolsAccessor);
    }
    public function test_get_hardware_accessor(){
        $hardware=$this->vm->hardWare();
        $this->assertInstanceOf(Hardware::class,$hardware);
    }
    public function test_get_console_ticket_accessor(){
        $consoleTicket=$this->vm->consoleTicket();
        $this->assertInstanceOf(ConsoleTickets::class,$consoleTicket);
    }
    public function test_get_guest_power_accessor(){
        $guestPower=$this->vm->guestPower();
        $this->assertInstanceOf(GuestPower::class,$guestPower);
    }

}