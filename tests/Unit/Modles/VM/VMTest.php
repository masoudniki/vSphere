<?php


namespace FNDEV\Tests\Unit\Modles\VM;


use FNDEV\Tests\TestCase;
use FNDEV\vShpare\Api\VM\VM;
use GuzzleHttp\Psr7\Response;

class VMTest extends TestCase
{
    public VM $vm;
    public function __setUp(){
        parent::setUp();
        $this->vm=new VM($this->vmwareApiClient->getHttpClient());
    }
    public function test_get_vm_by_mo_id(){
        $this->mockHandler->append(new Response(200, [], file_get_contents(__DIR__.'/fixtures/vm.json')));
        $response=$this->vm->byMoId('vm-111');
        dd($response);

    }

}