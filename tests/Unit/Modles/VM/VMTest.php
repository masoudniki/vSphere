<?php


namespace FNDEV\Tests\Unit\Modles\VM;


use FNDEV\Tests\TestCase;
use FNDEV\vShpare\Api\VM\ManageVms;
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
    }

}