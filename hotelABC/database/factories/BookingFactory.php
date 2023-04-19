<?php

namespace Database\Factories;

use App\Models\Guest;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $room_ID=null;
        $roomID=Room::where('status','Available')->pluck('id');

        if($roomID->count()>0){
            $room_ID=$this->faker->unique()->randomElement($roomID);
        }
        $room_status=Room::where('id',$room_ID)->get();
        $room_status->toQuery()->update([
            'status' => 'Booked',
        ]);


        return array(
            'guest_id'=>$this->faker->unique()->randomElement(Guest::pluck('id')),
            'room_id'=>$room_ID,
            'checkin_date'=>$this->faker->unique()->dateTimeBetween($startDate = '-3 days', $endDate = 'now')->format('Y-m-d'),
            'checkout_date'=>$this->faker->unique()->dateTimeBetween($startDate = '+1 days', $endDate = '+3 days')->format('Y-m-d'),
            'stay_type'=>$this->faker->randomElement(['FB','BB']),
        );
    }
}
