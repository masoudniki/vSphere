<?php


namespace FNDEV\Tests\Unit\Models\ConsoleTicket;


use FNDEV\Tests\TestCase;
use FNDEV\vShpare\Api\VM\ConsoleTickets\ConsoleTickets;
use GuzzleHttp\Psr7\Response;
/**
 * @uses \FNDEV\vShpare\Api\VM\ConsoleTickets\ConsoleTickets
 */
class ConsoleTicketTest extends TestCase
{
    public ConsoleTickets $consoleTicket;
    public function setUp(): void
    {
        parent::setUp();
        $this->consoleTicket=new ConsoleTickets($this->vmwareApiClient->getHttpClient());
    }
    public function test_create_console_tickets(){
        $this->mockHandler->append(new Response(200,[],file_get_contents(__DIR__."/fixture/consoleticket.json")));
        $console=$this->consoleTicket->createConsoleTickets([],"vm-111");
        $this->assertLastRequestEquals("POST","/vm/vm-111/console/tickets");
        $this->assertEquals("test",$console->value->ticket);
    }
}