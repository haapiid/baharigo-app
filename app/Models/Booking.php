<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Booking ini milik siapa? (User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Booking untuk jadwal travel yang mana?
    public function travelSchedule()
    {
        return $this->belongsTo(TravelSchedule::class);
    }

    // Booking ini pembayarannya mana?
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}