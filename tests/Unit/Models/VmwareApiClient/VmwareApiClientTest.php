<?php


namespace FNDEV\Tests\Unit\Models\VmwareApiClient;


use FNDEV\Tests\TestCase;
use FNDEV\vShpare\Api\VM\VM;
use FNDEV\vShpare\Auth\SessionHandler;
use GuzzleHttp\Client;

class VmwareApiClientTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }
    public function test_get_http_client(){
        $this->assertInstanceOf(Client::class,$this->vmwareApiClient->getHttpClient());
    }
    public function test_set_http_clint(){
        $client=new Client();
        $this->vmwareApiClient->setHttpClient($client);
        $this->assertTrue($this->vmwareApiClient->getHttpClient()===$client);
    }
    public function test_get_vm_accessor(){
        $this->assertInstanceOf(VM::class,$this->vmwareApiClient->vm());
    }
    public function test_check_vm_accessor_has_right_guzzle_client(){
        $vmAccessor=$this->vmwareApiClient->vm();
        $this->assertTrue($vmAccessor->HttpClient===$this->vmwareApiClient->getHttpClient());
    }
    public function test_get_base_url(){
        $expectedUrl="https://127.0.0.1:443/rest/";
        $this->assertEquals($expectedUrl,$this->vmwareApiClient->getBaseUrl());
    }
    public function test_get_base_auth_url(){
        $expectedUrl="https://127.0.0.1:443/rest/com/vmware/cim/session";
        $this->assertEquals($expectedUrl,$this->vmwareApiClient->getAuthUrl());
    }
}