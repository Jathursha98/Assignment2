<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable =[
        'booking_id',
        'rate_id',
        'total_days',
        'sub_total',
        'tax',
        'total',
    ];
    public function guest(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}
