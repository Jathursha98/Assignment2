<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Rate;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       $rate_id=null;
       $roomid=Booking::pluck('room_id')->first();
       $staytype=Booking::pluck('stay_type')->first();
       $suiteType=Room::where('id',$roomid)->pluck('suite_type')->first();
       $checkin=Carbon::parse(DB::table('bookings')->pluck('checkin_date')->first());
       $checkout=Carbon::parse(DB::table('bookings')->pluck('checkout_date')->first());
       $days=$checkout ->diffInDays($checkin);


       $rateID=Rate::where('suite_type','=',$suiteType)
           ->where('stay_type','=',$staytype)
           ->pluck('id');
        if($rateID->count()>0){
            $rate_id=$this->faker->unique()->randomElement($rateID);
        }

       $room_price = Rate::where('id', $rateID)->pluck('cost')->first();
       $sub_total =$days * $room_price;
       $tax = $sub_total * 0.1;
       $total = $sub_total + $tax;

        return [
            'booking_id'=>$this->faker->unique()->randomElement(Booking::pluck('id')),
            'rate_id'=>$rate_id,
            'total_days'=>$days,
            'sub_total'=>$sub_total,
            'tax'=>$tax,
            'total'=>$total,
        ];
    }
}
