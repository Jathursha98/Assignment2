<?php

namespace App\Http\Controllers;


use App\Models\Booking;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Guest;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            Booking::orderby('stay_type','ASC')->get()
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
    public function store(StoreBookingRequest $request)
    {
        $name =$request->input('name');
        $contact_no= $request->input('contact_no');
        $nic_no= $request->input('nic_no');
        $suite_type=$request->input('suite_type');
        $roomID=$request->input('room_id');
        $checkin_date=$request->input('checkin_date');
        $checkout_date=$request->input('checkout_date');
        $stay_type=  $request->input('stay_type');

        $new = DB::transaction(function () use ($name, $contact_no, $nic_no, $suite_type, $roomID,
            $checkin_date, $checkout_date, $stay_type) {

            //Insert the guest details
            $guestID = DB::table('guests')->insertGetId([
                'name' => $name,
                'contact_no' =>$contact_no,
                'nic_no' =>$nic_no,
            ]);

            //Insert new booking details
            $booking = Booking::create([
                'guest_id' =>$guestID,
                'room_id' => $roomID,
                'checkin_date' =>$checkin_date ,
                'checkout_date' =>$checkout_date ,
                'stay_type' =>$stay_type,
            ]);
            $booking->save();

            //updating room availability
            $room_status=Room::where('id',$roomID)->get();
            $room_status->toQuery()->update([
                'status' => 'Booked',
            ]);

        });
        return $new;


    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //Left Join with tables room and booking to retrieve all room details
        $room = DB::table('rooms')
            ->leftJoin('bookings','rooms.id','=', 'bookings.room_id')
            ->leftJoin('guests', 'guests.id', '=', 'bookings.guest_id')
            ->select('rooms.id','rooms.status','rooms.suite_type','guests.name',
                'bookings.checkin_date', 'bookings.checkout_date', 'bookings.stay_type',
                'guests.contact_no', 'guests.nic_no')
            //->orderBy('rooms.status', 'DESC')
            ->get();

        return response()->json($room);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
