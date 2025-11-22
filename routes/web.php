<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TravelScheduleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\ReportController;
use Illuminate\Support\Facades\Auth;
use App\Models\TravelSchedule;

/*
|--------------------------------------------------------------------------
| FUNGSI BANTUAN (HELPER)
|--------------------------------------------------------------------------
| Agar kita tidak menulis query database berulang-ulang di dua route berbeda.
*/
function getTravelData() {
    // Ambil data travel yang belum berangkat & kuota masih ada
    // Kita ambil 6 saja untuk tampilan awal (pagination bisa ditambahkan nanti)
    return TravelSchedule::where('departure_at', '>', now())
            ->where('quota', '>', 0)
            ->orderBy('departure_at', 'asc')
            ->take(6)
            ->get();
}

/*
|--------------------------------------------------------------------------
| 1. HALAMAN AWAL (ROOT URL)
|--------------------------------------------------------------------------
| Diakses oleh: TAMU (Belum Login)
| Logika: Jika ternyata sudah login, lempar ke dashboard. Jika belum, tampilkan view dashboard sebagai tamu.
*/
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    
    return view('dashboard', [
        'schedules' => getTravelData()
    ]);
})->name('welcome');


/*
|--------------------------------------------------------------------------
| 2. DASHBOARD USER / MEMBER
|--------------------------------------------------------------------------
| Diakses oleh: MEMBER (Sudah Login)
| Logika: Cek apakah admin? Jika ya, lempar ke admin. Jika tidak, tampilkan view dashboard.
*/
Route::get('/dashboard', function () {
    // Cek Admin
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    // Tampilkan view yang sama dengan tamu, tapi Navbar akan otomatis berubah
    return view('dashboard', [
        'schedules' => getTravelData()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| 3. ROUTE KHUSUS ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); 
    })->name('dashboard');

    // CRUD Jadwal
    Route::resource('schedules', TravelScheduleController::class);

    // Laporan
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/{travelSchedule}', [ReportController::class, 'show'])->name('reports.show');
});


/*
|--------------------------------------------------------------------------
| 4. PROFILE & BOOKING USER
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Booking Process
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    
    // Riwayat & Pembayaran
    Route::get('/my-bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings/{booking}/pay', [BookingController::class, 'payment'])->name('bookings.payment');
    Route::get('/bookings/{booking}/invoice', [BookingController::class, 'invoice'])->name('bookings.invoice');
});

require __DIR__.'/auth.php';