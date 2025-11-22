<x-app-layout>
    <section class="relative h-[500px] md:h-[600px] bg-cover bg-center bg-no-repeat" style="background-image: url('https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')">
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-transparent"></div>
        
        <div class="relative z-10 h-full flex items-center justify-center">
            <div class="text-center text-white px-4 max-w-5xl mx-auto mt-16">
                <span class="inline-block py-1 px-3 rounded-full bg-blue-600/30 border border-blue-400 text-blue-100 text-sm font-semibold mb-4 backdrop-blur-sm">
                    Travel Aman & Nyaman
                </span>
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight drop-shadow-lg">
                    Jelajahi Dunia<br/>Bersama <span class="text-blue-400">BahariGo</span>
                </h1>
                <p class="text-xl md:text-2xl mb-10 opacity-90 max-w-2xl mx-auto font-light leading-relaxed drop-shadow-md">
                    Solusi perjalanan terbaik dengan armada prima dan harga yang transparan.
                </p>
                
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-2 max-w-xl mx-auto shadow-2xl">
                    <div class="flex items-center bg-white rounded-xl p-2">
                        <div class="flex-shrink-0 pl-4 text-gray-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <input type="text" readonly placeholder="Mau pergi ke mana hari ini?" 
                               class="w-full px-4 py-3 border-none focus:ring-0 text-gray-800 placeholder-gray-400 bg-transparent cursor-pointer"
                               onclick="window.location.href='{{ route('dashboard') }}'">
                        <button onclick="window.location.href='{{ route('dashboard') }}'" 
                                class="hidden md:block bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-bold transition-all transform hover:scale-105">
                            Cari
                        </button>
                    </div>
                </div>
                <p class="mt-4 text-sm text-gray-300">Cari rute populer: Jakarta, Bandung, Yogyakarta</p>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Rute Terpopuler Minggu Ini</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Jangan lewatkan penawaran kursi terbatas untuk destinasi favorit
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($schedules as $schedule)
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 group overflow-hidden flex flex-col h-full">
                    
                    <div class="h-56 bg-gray-200 relative overflow-hidden">
                        <img src="https://image.pollinations.ai/prompt/beautiful%20travel%20photo%20of%20{{ $schedule->destination }}?width=800&height=600&nologo=true" 
                            alt="{{ $schedule->destination }}" 
                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                        
                        <div class="absolute top-4 right-4">
                            <span class="bg-white/95 backdrop-blur text-blue-800 text-xs font-bold px-3 py-1.5 rounded-lg shadow-lg flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ \Carbon\Carbon::parse($schedule->departure_at)->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-1">One Way Trip</p>
                                <h3 class="text-xl font-bold text-gray-900 line-clamp-1">{{ $schedule->destination }}</h3>
                            </div>
                        </div>
                        
                        <div class="space-y-3 mb-6 flex-1">
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span class="text-sm">{{ \Carbon\Carbon::parse($schedule->departure_at)->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                <span class="text-sm">Sisa {{ $schedule->quota }} Kursi</span>
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-4 flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-500">Mulai dari</p>
                                <p class="text-xl font-bold text-blue-600">Rp {{ number_format($schedule->price, 0, ',', '.') }}</p>
                            </div>
                            
                            @auth
                                <form action="{{ route('booking.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                                    
                                    @if($schedule->quota > 0)
                                        <button type="submit" 
                                                onclick="return confirm('Apakah Anda yakin ingin memesan tiket ke {{ $schedule->destination }}?')"
                                                class="bg-blue-600 text-white px-5 py-2.5 rounded-xl font-semibold text-sm hover:bg-blue-700 transition-colors shadow-lg shadow-blue-500/30 flex items-center gap-2">
                                            <span>Pesan</span>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                            </svg>
                                        </button>
                                    @else
                                        <button type="button" disabled class="bg-gray-300 text-gray-500 px-5 py-2.5 rounded-xl font-semibold text-sm cursor-not-allowed">
                                            Habis
                                        </button>
                                    @endif
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="bg-gray-900 text-white px-5 py-2.5 rounded-xl font-semibold text-sm hover:bg-gray-800 transition-colors shadow-lg">
                                    Login untuk Pesan
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12">
                    <div class="inline-block p-4 rounded-full bg-gray-100 mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Belum ada jadwal tersedia</h3>
                    <p class="text-gray-500 mt-1">Silakan cek kembali nanti.</p>
                </div>
                @endforelse
            </div>

            <div class="text-center mt-16">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center space-x-2 bg-white border-2 border-gray-200 text-gray-700 px-8 py-3 rounded-xl font-bold hover:border-blue-600 hover:text-blue-600 transition-all duration-300 group">
                    <span>Lihat Semua Jadwal</span>
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white relative overflow-hidden">
        <div class="absolute top-0 left-0 w-64 h-64 bg-blue-50 rounded-full mix-blend-multiply filter blur-3xl opacity-70 -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-yellow-50 rounded-full mix-blend-multiply filter blur-3xl opacity-70 translate-x-1/2 translate-y-1/2"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Kenapa BahariGo?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Kami berkomitmen memberikan standar pelayanan tertinggi untuk setiap kilometer perjalanan Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="text-center group">
                    <div class="w-20 h-20 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-600 transition-colors duration-300">
                        <svg class="w-10 h-10 text-blue-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pembayaran Aman</h3>
                    <p class="text-gray-600 leading-relaxed">Sistem verifikasi pembayaran yang terjamin keamanannya dengan konfirmasi instan.</p>
                </div>

                <div class="text-center group">
                    <div class="w-20 h-20 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-600 transition-colors duration-300">
                        <svg class="w-10 h-10 text-blue-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Tepat Waktu</h3>
                    <p class="text-gray-600 leading-relaxed">Komitmen kami untuk berangkat sesuai jadwal demi kenyamanan waktu Anda.</p>
                </div>

                <div class="text-center group">
                    <div class="w-20 h-20 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-600 transition-colors duration-300">
                        <svg class="w-10 h-10 text-blue-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">CS 24/7</h3>
                    <p class="text-gray-600 leading-relaxed">Tim support kami siap membantu kendala perjalanan Anda kapanpun.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-2xl font-bold mb-4">BahariGo</h2>
            <p class="text-gray-400 mb-8">Teman perjalanan terbaik Anda.</p>
            <p class="text-sm text-gray-500">&copy; {{ date('Y') }} BahariGo. All rights reserved.</p>
        </div>
    </footer>
</x-app-layout>