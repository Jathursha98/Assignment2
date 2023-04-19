<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class RoomTest extends TestCase
{
    /**
     * A basic test example.
     */

    public function test_if_all_rooms_can_be_viewed():void
    {
        $response =$this->get('api/rooms');

        $rooms = $response->json();

        dd($rooms);

        $response->assertStatus(200);
    }

}
