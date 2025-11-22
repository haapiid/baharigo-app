<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelSchedule extends Model
{
    use HasFactory;

    // Mengizinkan semua kolom diisi (kecuali id)
    protected $guarded = ['id'];

    // Relasi: Satu jadwal bisa punya banyak booking
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}