<x-app-layout>
    <div class="relative h-64 md:h-80 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative z-10 h-full flex flex-col items-center justify-center text-center px-4">
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-2">Tiket Perjalanan Saya</h1>
            <p class="text-gray-200 text-lg max-w-2xl">
                Kelola jadwal keberangkatan dan riwayat perjalanan Anda di satu tempat
            </p>
        </div>
    </div>

    <div class="min-h-screen bg-gray-50 py-12 -mt-10 relative z-20 rounded-t-3xl">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-8 bg-green-50 border border-green-200 rounded-xl p-4 flex items-center shadow-sm animate-fade-in-down">
                    <div class="flex-shrink-0 bg-green-100 rounded-full p-2">
                        <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-800 font-semibold">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="space-y-6">
                @forelse($bookings as $booking)
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 overflow-hidden group">
                    
                    <div class="p-6 border-b border-gray-50">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" class="hidden"/> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 font-medium">Tujuan Perjalanan</p>
                                    <h3 class="text-xl font-bold text-gray-900">{{ $booking->travelSchedule->destination }}</h3>
                                </div>
                            </div>

                            <div>
                                @if($booking->status == 'confirmed')
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-green-100 text-green-700 border border-green-200">
                                        <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                        Lunas / Confirmed
                                    </span>
                                @elseif($booking->status == 'pending')
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-yellow-100 text-yellow-800 border border-yellow-200 animate-pulse">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Menunggu Pembayaran
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-red-100 text-red-700 border border-red-200">
                                        Dibatalkan
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-gray-50/50">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-center">
                            
                            <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="flex items-start space-x-3">
                                    <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase font-semibold tracking-wide">Jadwal Berangkat</p>
                                        <p class="text-gray-900 font-medium">
                                            {{ \Carbon\Carbon::parse($booking->travelSchedule->departure_at)->format('d M Y') }}
                                        </p>
                                        <p class="text-gray-600 text-sm">
                                            Pukul {{ \Carbon\Carbon::parse($booking->travelSchedule->departure_at)->format('H:i') }} WIB
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-3">
                                    <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase font-semibold tracking-wide">Total Tagihan</p>
                                        <p class="text-blue-600 text-lg font-bold">
                                            Rp {{ number_format($booking->travelSchedule->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="lg:col-span-1">
                                @if($booking->status == 'pending')
                                    <div class="bg-white border border-yellow-200 rounded-xl p-4 shadow-sm">
                                        <p class="text-xs font-bold text-yellow-700 mb-3 uppercase tracking-wide text-center">Upload Bukti Transfer</p>
                                        <form action="{{ route('bookings.payment', $booking->id) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                            @csrf
                                            <input type="file" name="proof_image" required 
                                                class="block w-full text-xs text-gray-500 file:mr-2 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100 cursor-pointer bg-gray-50 rounded-lg border border-gray-200">
                                            
                                            <button type="submit" class="w-full bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white font-semibold py-2.5 rounded-lg text-sm transition-all shadow-md hover:shadow-lg flex items-center justify-center space-x-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                                <span>Kirim Bukti</span>
                                            </button>
                                        </form>
                                    </div>

                                @elseif($booking->status == 'confirmed')
                                    <div class="text-center lg:text-right">
                                        <a href="{{ route('bookings.invoice', $booking->id) }}" 
                                           class="w-full lg:w-auto inline-flex items-center justify-center space-x-2 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <span>Download E-Ticket</span>
                                        </a>
                                        <p class="text-xs text-gray-400 mt-2 text-center lg:text-right">Siap untuk diunduh</p>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-20 bg-white rounded-3xl shadow-sm border-2 border-dashed border-gray-200">
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Belum Ada Tiket</h3>
                    <p class="text-gray-500 max-w-md mx-auto mb-8">
                        Anda belum memesan tiket perjalanan apapun. Yuk, mulai petualangan Anda sekarang!
                    </p>
                    <a href="{{ route('dashboard') }}" 
                       class="inline-flex items-center space-x-2 bg-gradient-to-r from-blue-600 to-blue-800 hover:from-blue-700 hover:to-blue-900 text-white font-semibold py-3 px-8 rounded-xl transition-all duration-200 shadow-lg hover:shadow-blue-500/30">
                        <span>Cari Tiket Sekarang</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
                @endforelse
            </div>

            @if($bookings->count() > 0)
            <div class="mt-10 text-center">
                <p class="text-sm text-gray-500">Menampilkan seluruh riwayat perjalanan Anda</p>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>