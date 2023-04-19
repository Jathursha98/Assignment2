<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingTest extends TestCase
{
    /**
     * A basic test example.
     */

    public function test_if_all_bookings_can_be_viewed():void
    {
        $response =$this->get('api/booking');

        $bookings = $response->json();

        dd($bookings);

        $response->assertStatus(200);
    }
    public function test_if_a_booking_is_created():void
    {
        $response =$this->post('api/booking/',[
            'name'=>'Nishadi Perera',
            'contact_no' =>'254 263 8985',
            'nic_no'=>'2000759546',
            'suite_type'=>'Deluxe',
            'checkin_date'=>'2023-04-14',
            'checkout_date'=>"2023-04-16",
            'stay_type'=>'BB'
        ]);

        $bookings = $response->json();

        dd($bookings);

        $response->assertStatus(200);
    }
    public function test_if_can_view_bookings():void
    {
        $response =$this->get('api/booking_with_rooms');

        $bookings = $response->json();

        dd($bookings);

        $response->assertStatus(200);
    }

}

