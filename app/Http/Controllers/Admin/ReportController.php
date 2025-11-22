<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TravelSchedule;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // 1. Halaman Rekap (List Travel + Jumlah Penumpang)
    public function index()
    {
        // Ambil semua jadwal, hitung jumlah booking yang statusnya BUKAN 'cancelled'
        $schedules = TravelSchedule::withCount(['bookings' => function ($query) {
            $query->where('status', '!=', 'cancelled');
        }])->latest()->get();

        return view('admin.reports.index', compact('schedules'));
    }

    // 2. Halaman Detail (List Nama Penumpang di satu Travel)
    public function show(TravelSchedule $travelSchedule)
    {
        // Ambil data booking beserta data User-nya
        $bookings = $travelSchedule->bookings()
                        ->with('user') // Eager loading data user
                        ->where('status', '!=', 'cancelled')
                        ->get();

        return view('admin.reports.show', compact('travelSchedule', 'bookings'));
    }
}