<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\TravelSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:travel_schedules,id',
        ]);

        try {
            // Gunakan DB Transaction agar data aman (Atomicity)
            DB::transaction(function () use ($request) {
                
                // 1. Ambil data jadwal & KUNCI baris ini agar tidak bisa diambil orang lain bersamaan (Race Condition)
                $schedule = TravelSchedule::where('id', $request->schedule_id)
                                ->lockForUpdate() 
                                ->first();
                // 2. Cek Kuota
                if ($schedule->quota <= 0) {
                    // Lempar error agar ditangkap blok catch di bawah
                    throw new \Exception('Maaf, kuota tiket untuk perjalanan ini sudah habis!');
                }

                // 3. Kurangi Kuota
                $schedule->decrement('quota');

                // 4. Buat Data Booking
                Booking::create([
                    'user_id' => Auth::id(),
                    'travel_schedule_id' => $schedule->id,
                    'status' => 'pending', // Status awal pending (belum bayar)
                ]);
            });

            return redirect()->route('dashboard')->with('success', 'Tiket berhasil dipesan! Silakan lakukan pembayaran.');

        } catch (\Exception $e) {
            // Jika error (misal kuota habis), kembalikan ke halaman sebelumnya
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function index()
    {
        $bookings = Booking::with(['travelSchedule', 'payment'])
                        ->where('user_id', Auth::id())
                        ->latest()
                        ->get();

        return view('bookings.index', compact('bookings'));
    }

    public function payment(Request $request, Booking $booking)
    {
        $request->validate([
            'proof_image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        // Cek apakah user yang login adalah pemilik booking (Keamanan)
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        // Upload Gambar
        $path = $request->file('proof_image')->store('payment_proofs', 'public');

        // Simpan ke tabel payments
        $booking->payment()->create([
            'amount' => $booking->travelSchedule->price,
            'proof_image' => $path,
            'status' => 'verified', // Anggap otomatis verified biar cepat (atau set pending jika butuh cek admin)
        ]);

        // Update status booking jadi confirmed
        $booking->update(['status' => 'confirmed']);

        return back()->with('success', 'Pembayaran berhasil dikirim! Tiket Anda sudah terbit.');
    }

    public function invoice(Booking $booking)
    {
        // Cek akses
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        // Load view khusus PDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('invoices.ticket', compact('booking'));
        return $pdf->download('Invoice-Travel-' . $booking->id . '.pdf');
    }
}