<?php


namespace FNDEV\Tests\Unit\Models\Hardware;


use FNDEV\Tests\TestCase;
use FNDEV\vShpare\Api\VM\Hardware\CDROM\CDROM;
use FNDEV\vShpare\Api\VM\Hardware\Hardware;

/**
 * @uses \FNDEV\vShpare\Api\VM\Hardware\Hardware
 */
class HardwareTest extends TestCase
{
    public function test_get_cdrom(){
        $hardware=new Hardware($this->vmwareApiClient);
        $this->assertInstanceOf(CDROM::class,$hardware->cdrom());

    }


}