<x-admin-layout>
    <x-slot name="title">Detail Laporan</x-slot>

    <!-- Action Bar (Responsive: Stack on mobile, Row on desktop) -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 no-print">
        <!-- Back Button -->
        <a href="{{ route('admin.reports.index') }}" 
           class="w-full sm:w-auto flex items-center justify-center space-x-2 px-4 py-2.5 text-gray-700 border border-gray-300 rounded-xl hover:bg-gray-50 font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali</span>
        </a>

        <!-- Print Button -->
        <button onclick="window.print()" 
                class="w-full sm:w-auto flex items-center justify-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl font-semibold transition-colors shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            <span>Cetak Manifest</span>
        </button>
    </div>

    <!-- Hero Section - Route & Info -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 lg:p-8 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start gap-6">
            <!-- Left: Route Info -->
            <div class="flex-1 w-full">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Manifest Perjalanan</span>
                </div>
                
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 leading-tight">{{ $travelSchedule->destination }}</h1>
                
                <div class="flex flex-wrap items-center gap-4 text-gray-600 text-sm md:text-base">
                    <div class="flex items-center space-x-2 bg-gray-50 px-3 py-1 rounded-lg">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                        <span>Travel Express</span>
                    </div>
                    <div class="flex items-center space-x-2 bg-gray-50 px-3 py-1 rounded-lg">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>
                        <span>ID: TRV-{{ $travelSchedule->id }}</span>
                    </div>
                </div>
            </div>

            <!-- Right: Departure Time -->
            <div class="w-full md:w-auto text-left md:text-right bg-blue-50 md:bg-transparent p-4 md:p-0 rounded-xl">
                <div class="bg-gradient-to-br from-blue-600 to-blue-700 text-white rounded-2xl p-4 inline-block shadow-lg w-full md:w-auto text-center md:text-right">
                    <div class="text-xs font-semibold uppercase tracking-wider opacity-90 mb-1">Berangkat</div>
                    <div class="text-3xl font-bold">
                        {{ \Carbon\Carbon::parse($travelSchedule->departure_at)->format('d') }}
                    </div>
                    <div class="text-sm font-medium uppercase tracking-widest">
                        {{ \Carbon\Carbon::parse($travelSchedule->departure_at)->format('M Y') }}
                    </div>
                </div>
                <div class="mt-3 text-lg font-bold text-gray-900 flex items-center justify-start md:justify-end gap-2">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ \Carbon\Carbon::parse($travelSchedule->departure_at)->format('H:i') }} WIB
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-6 mb-8">
        <!-- Total Kursi -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 flex items-center">
            <div class="flex-shrink-0 w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Kursi</p>
                <p class="text-2xl font-bold text-gray-900">{{ $travelSchedule->quota + $bookings->count() }}</p>
            </div>
        </div>

        <!-- Terisi -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 flex flex-col justify-center">
            <div class="flex items-center mb-2">
                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Terisi</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $bookings->count() }}</p>
                </div>
            </div>
            
            <!-- Mini Progress Bar -->
            @php
                $totalSeats = $travelSchedule->quota + $bookings->count();
                $occupancyRate = $totalSeats > 0 ? round(($bookings->count() / $totalSeats) * 100) : 0;
            @endphp
            <div class="w-full bg-gray-100 rounded-full h-1.5 mt-2">
                <div class="bg-blue-600 h-1.5 rounded-full transition-all duration-500" style="width: {{ $occupancyRate }}%"></div>
            </div>
        </div>

        <!-- Kosong -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 flex items-center">
            <div class="flex-shrink-0 w-12 h-12 {{ $travelSchedule->quota > 0 ? 'bg-green-100' : 'bg-red-100' }} rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 {{ $travelSchedule->quota > 0 ? 'text-green-600' : 'text-red-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Sisa Kursi</p>
                <p class="text-2xl font-bold {{ $travelSchedule->quota > 0 ? 'text-gray-900' : 'text-red-600' }}">
                    {{ $travelSchedule->quota }}
                </p>
            </div>
        </div>
    </div>

    <!-- Passengers Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Daftar Penumpang</h3>
                <p class="text-sm text-gray-600 mt-1">Total {{ $bookings->count() }} penumpang terdaftar</p>
            </div>
        </div>

        @if($bookings->count() > 0)
        <!-- Responsive Table Wrapper -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Penumpang</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kontak</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Waktu Booking</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($bookings as $booking)
                    <tr class="hover:bg-blue-50/30 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                                        {{ strtoupper(substr($booking->user->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-semibold text-gray-900">{{ $booking->user->name }}</div>
                                    <div class="text-xs text-gray-500">ID: #{{ $booking->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $booking->user->email }}</div>
                            <div class="text-xs text-gray-500 mt-0.5">{{ $booking->user->phone ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($booking->status == 'confirmed')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span> Lunas
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                    <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5"></span> Pending
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $booking->created_at->format('d M Y, H:i') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-16">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Penumpang</h3>
            <p class="text-gray-500">Saat ini belum ada transaksi untuk jadwal perjalanan ini.</p>
        </div>
        @endif
    </div>

    <!-- CSS Khusus Cetak (Agar Sidebar Hilang saat Print) -->
    <style>
        @media print {
            /* Sembunyikan elemen non-penting */
            .no-print, nav, header, .sidebar { 
                display: none !important; 
            }
            /* Pastikan konten utama full width */
            body, main { 
                margin: 0 !important; 
                padding: 0 !important; 
                background: white !important;
                width: 100% !important;
            }
            /* Sembunyikan shadow dan border saat print */
            .shadow-sm, .shadow-lg { 
                box-shadow: none !important; 
            }
            .border { 
                border: 1px solid #ddd !important; 
            }
        }
    </style>
</x-admin-layout>