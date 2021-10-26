<?php


namespace FNDEV\Tests\Unit\Models\Hardware\CDROM;


use FNDEV\Tests\TestCase;
use FNDEV\vShpare\Api\VM\Hardware\CDROM\CDROM;
use GuzzleHttp\Psr7\Response;


class CDROMTest extends TestCase
{
    public CDROM $cdrom;
    public function setUp(): void
    {
        parent::setUp();
        $this->cdrom=new CDROM($this->vmwareApiClient->getHttpClient());
    }
    public function test_get_list_of_cdroms(){
        $this->mockHandler->append(new Response(200,[],file_get_contents(__DIR__."/fixture/listOfCdRoms.json")));
        $response=$this->cdrom->getListCdRom("vm-test");
        $this->assertEquals("3000",$response->value[0]->cdrom);
    }
    public function test_get_a__cdrom(){
        $this->mockHandler->append(new Response(200,[],file_get_contents(__DIR__."/fixture/cdrom.json")));
        $response=$this->cdrom->getCdRom("3000","vm-412");
        $this->assertEquals("IDE",$response->value->type);
    }
    public function test_delete_cd_rom(){
        $this->mockHandler->append(new Response(200,[],"null"));
        $response=$this->cdrom->disconnectCdRom("3000","vm-412");
        $this->assertEquals($response->value,null);
    }
    public function test_disconnect_cd_rom(){
        $this->mockHandler->append(new Response(200,[],file_get_contents(__DIR__."/fixture/disconnectCdrom.json")));
        $response=$this->cdrom->disconnectCdRom("3000","vm-412");
        $this->assertEquals($response->value,null);
    }
    public function test_connect_cd_rom(){
        $this->mockHandler->append(new Response(200,[],file_get_contents(__DIR__."/fixture/disconnectCdrom.json")));
        $response=$this->cdrom->disconnectCdRom("3000","vm-412");
        $this->assertEquals($response->value,null);
    }
    public function test_create_cd_rom(){
        $this->mockHandler->append(new Response(200,[],file_get_contents(__DIR__."/fixture/createCdrom.json")));
        $response=$this->cdrom->createCdRom([
            "spec"=>[
                "type"=>"SATA",
                "backing"=>[
                    "iso_file"=>"[datastore1] Os/ubuntu-18.04.4-live-server-amd64.iso",
                    "type"=>"ISO_FILE"
                ],
                "start_connected"=>"true"
            ]
        ],"vm-412");
        $this->assertEquals("3001",$response->value);
    }
    public function test_update_cd_rom_config(){
        $this->mockHandler->append(new Response(200,[],"null"));
        $response=$this->cdrom->updateCdRom("16002",[
            "spec"=>[
                "backing"=>[
                    "iso_file"=>"[datastore1] Os/ubuntu-18.04.4-live-server-amd64.iso",
                    "type"=>"ISO_FILE"
                ],
                "start_connected"=>"true"
            ]
        ],"vm-412");
        $this->assertEquals(null,$response);
    }



}