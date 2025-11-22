<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TravelSchedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        // Ambil semua jadwal
        $schedules = TravelSchedule::all();
        
        // Kembalikan response JSON (Standard API)
        return response()->json([
            'status' => 'success',
            'data' => $schedules
        ], 200);
    }
}