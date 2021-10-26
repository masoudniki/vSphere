<?php


namespace FNDEV\Tests\Unit\Models\ManageVm;


use FNDEV\Tests\TestCase;
use FNDEV\vShpare\Api\VM\ManageVms;
use FNDEV\vShpare\Api\VM\VmSource;

class ManageVmTest extends TestCase
{
    public ManageVms $manageVms;
    public function setUp(): void
    {
        parent::setUp();
        $vms=json_decode(file_get_contents(__DIR__."/fixture/vms.json"));
        $this->manageVms=new ManageVms($vms,$this->vmwareApiClient->getHttpClient());

    }
    public function test_get_count_of_vms(){
        $this->assertCount(4,$this->manageVms);
    }
    public function test_get_each_of_vms(){
        foreach ($this->manageVms as $key=>$vm){
            $this->assertInstanceOf(VmSource::class,$vm);
            $this->assertEquals("string",$vm->name);
        }
    }
    public function test_get_first_vm(){
        $vm=$this->manageVms->first();
        $this->assertEquals("vm-111",$vm->moid);
        $this->assertEquals("POWERED_OFF",$vm->power_state);
        $this->assertEquals(10,$vm->cpu_count);
    }
}