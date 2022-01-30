<?php

namespace Tests\Unit;
use App\Models\Client;
use App\Models\Attendance;

use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /** @test */
    public function get_clients()
    {
        $response = $this->get('/api/clients');
        $response->assertStatus(200);
    }
     
    /** @test */
    public function count_clients()
    {
        $client1 = new Client();
        $client2 = new Client();
        $client3 = new Client();
        $attendance = new Attendance();
        $response = $attendance->attendancesList();
        $this->assertCount(3, $response);
    }


}
