<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Rate;
use App\Models\Room;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            Payment::all()
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {


        $new = DB::transaction(function () use ($request) {

            //Getting the Booking ID
            $bookingID = DB::table('bookings')->pluck('id')->first();

            //Finding room id
            $roomID= DB::table('rooms')   //have to check the availability of room
                ->pluck('id')
                ->first();
            //Finding a Suite type
            $suite_type = DB::table('rooms')
                ->where('id', '=', $roomID)
                ->pluck('suite_type')->first();
            //Finding a stay type
            $stay_type=DB::table('bookings')
                ->where('id', '=', $bookingID)
                ->pluck('stay_type')->first();
            //Finding the rate for booked suite type and stay type
            $rateID=DB::table('rates')
                ->where('suite_type','=',$suite_type)
                ->where('stay_type','=',$stay_type)
                ->pluck('id')
                ->first();

            $checkin=Carbon::parse(DB::table('bookings')->pluck('checkin_date')->first());
            $checkout=Carbon::parse(DB::table('bookings')->pluck('checkout_date')->first());
            $days=$checkout ->diffInDays($checkin);

            $sub_total =$days * $rateID;
            $tax = $sub_total * 0.1;
            $total = $sub_total + $tax;

            //Insert new payment details
            $payment = Booking::create([
                'booking_id' =>$bookingID,
                'rate_id' => $rateID,
                'total_days'=>$days,
                'sub_total'=>$sub_total,
                'tax'=>$tax,
                'total'=>$total
            ]);
            $payment->save();

        });
        return $new;

    }


    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
