<?php


namespace FNDEV\Tests\Unit\Models\Tools;


use FNDEV\Tests\TestCase;
use FNDEV\vShpare\Api\VM\Tools\Tools;
use GuzzleHttp\Psr7\Response;

/**
 * @uses \FNDEV\vShpare\Api\VM\Tools\Tools
 */
class ToolsTest extends TestCase
{
    public Tools $tools;
    public function setUp(): void
    {
        parent::setUp();
        $this->tools=new Tools($this->vmwareApiClient->getHttpClient());
    }
    public function test_get_tools(){
        $this->mockHandler->append(new Response(200,[],file_get_contents(__DIR__."/fixture/tools.json")));
        $response=$this->tools->tools('vm-111');
        $this->assertLastRequestEquals("GET","/vm/vm-111/tools");
        $this->assertEquals(false,$response->value->auto_update_supported);
        $this->assertEquals(0,$response->value->install_attempt_count);
        $this->assertEquals("enum",$response->value->install_type);
        $this->assertEquals("enum",$response->value->run_state);
    }
}