<?php

namespace Tests\Unit;
use App\Models\Client;
use App\Models\Attendance;

use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /** @test */
    public function testget_clients()
    {
        $response = $this->get('/api/clients');
        $response->assertStatus(200);
    }

}
