<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    /**
     * A basic test example.
     */

    public function test_if_all_payments_can_be_viewed():void
    {
        $response =$this->get('api/payments');

        $payments = $response->json();

        dd($payments);

        $response->assertStatus(200);
    }

}
