<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TravelSchedule;

class TravelScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = TravelSchedule::latest()->paginate(10);
        return view('admin.schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'destination' => 'required|string|max:255',
            'departure_at' => 'required|date|after:today',
            'quota' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);
        TravelSchedule::create($request->all());
        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal perjalanan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TravelSchedule $schedule)
    {
        return view('admin.schedules.edit', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TravelSchedule $schedule)
    {
        $request->validate([
            'destination' => 'required|string|max:255',
            'departure_at' => 'required|date',
            'quota' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);
        $schedule->update($request->all());
        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal perjalanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TravelSchedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal perjalanan berhasil dihapus.');
    }
}
