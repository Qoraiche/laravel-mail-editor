<?php

namespace Tests\Feature;

use Qoraiche\MailEclipse\Tests\TestCase;

class RouteListTest extends TestCase
{
    public function testCanRunArtisanList()
    {
        $this->artisan('route:list')->assertOk();
    }
}
