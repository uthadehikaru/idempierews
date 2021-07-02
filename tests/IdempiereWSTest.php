<?php

namespace Uthadehikaru\IdempiereWS\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IdempiereWSTest extends TestCase
{
    public function test_route_home()
    {
        $response = $this->get('/idempierews');

        $response->assertSeeText('Hello from the idempiere WS!');
    }

    public function test_GetListSalesRegions()
    {
        $response = $this->get('/idempierews/list?name=GetListSalesRegions');

        $response->assertSeeText('East') ;
    }

    public function test_QueryBPartner()
    {
        $response = $this->get('/idempierews/query?name=QueryBPartner');

        $response->assertSeeText('SeedFarm', false) ;
    }

    public function test_ReadBPartner()
    {
        $response = $this->get('/idempierews/read?name=ReadBPartner&id=117');

        $response->assertSeeText('C&W Construction', false) ;
    }
}
