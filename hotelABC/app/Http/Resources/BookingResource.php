<?php

namespace App\Http\Resources;

use App\Http\Resources\RoomResource;
use App\Http\Resources\GuestResource;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'room'=>new RoomResource($this->room),
            'checkin_date'=>$this->checkin_date,
            'checkout _date'=>$this->checkout_date,
            'stay_type'=>$this->stay_type,
            'guest'=>new GuestResource($this->guest),
        ];
    }
}
