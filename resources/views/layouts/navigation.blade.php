<nav x-data="{ open: false }" id="main-navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-transparent">
    <!-- Primary Navigation Menu -->
    <div class="px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 group">
                    <div class="flex items-center justify-center w-10 h-10 bg-blue-600 rounded-lg group-hover:bg-blue-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white group-hover:text-blue-100 transition-colors navbar-logo-text">BahariGo</span>
                </a>
            </div>

            <!-- Navigation Links - Desktop -->
            <div class="hidden md:flex items-center space-x-8">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="nav-link-hover text-white hover:text-blue-100 font-medium">
                    {{ __('Beranda') }}
                </x-nav-link>
                <x-nav-link :href="route('bookings.index')" :active="request()->routeIs('bookings.index')" class="nav-link-hover text-white hover:text-blue-100 font-medium">
                    {{ __('Riwayat Tiket') }}
                </x-nav-link>
                <x-nav-link href="#" class="nav-link-hover text-white hover:text-blue-100 font-medium">
                    {{ __('Destinasi') }}
                </x-nav-link>
                <x-nav-link href="#" class="nav-link-hover text-white hover:text-blue-100 font-medium">
                    {{ __('Paket Wisata') }}
                </x-nav-link>
            </div>

            <!-- User Menu & Auth Links -->
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <!-- Settings Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center space-x-2 text-white hover:text-blue-100 transition-colors font-medium py-2 px-3 rounded-lg hover:bg-white/10">
                                <div class="flex items-center justify-center w-8 h-8 bg-blue-500 rounded-full">
                                    <span class="text-sm font-semibold text-white">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </span>
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>{{ __('Profile') }}</span>
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center space-x-2 text-red-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    <span>{{ __('Log Out') }}</span>
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:text-blue-100 font-medium transition-colors">
                        {{ __('Masuk') }}
                    </a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                        {{ __('Daftar') }}
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button @click="open = ! open" class="text-white hover:text-blue-100 transition-colors p-2">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="md:hidden absolute top-16 inset-x-0 bg-white/95 backdrop-blur-sm shadow-lg border-t border-gray-100">
        <div class="px-6 py-4 space-y-3">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block px-3 py-2 rounded-lg font-medium transition-colors">
                {{ __('Beranda') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('bookings.index')" :active="request()->routeIs('bookings.index')" class="block px-3 py-2 rounded-lg font-medium transition-colors">
                {{ __('Riwayat Tiket') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#" class="block px-3 py-2 rounded-lg font-medium transition-colors">
                {{ __('Destinasi') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#" class="block px-3 py-2 rounded-lg font-medium transition-colors">
                {{ __('Paket Wisata') }}
            </x-responsive-nav-link>
        </div>

        @auth
            <!-- Responsive Settings Options -->
            <div class="px-6 py-4 border-t border-gray-200">
                <div class="flex items-center space-x-3 px-3 py-2">
                    <div class="flex items-center justify-center w-10 h-10 bg-blue-500 rounded-full">
                        <span class="text-sm font-semibold text-white">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </span>
                    </div>
                    <div>
                        <div class="font-medium text-gray-900">{{ Auth::user()->name }}</div>
                        <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-2">
                    <x-responsive-nav-link :href="route('profile.edit')" class="block px-3 py-2 rounded-lg font-medium transition-colors">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-3 py-2 rounded-lg font-medium text-red-600 transition-colors">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="px-6 py-4 border-t border-gray-200 space-y-2">
                <x-responsive-nav-link :href="route('login')" class="block px-3 py-2 rounded-lg font-medium transition-colors">
                    {{ __('Masuk') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" class="block px-3 py-2 rounded-lg font-medium bg-blue-600 text-white transition-colors">
                    {{ __('Daftar') }}
                </x-responsive-nav-link>
            </div>
        @endauth
    </div>
</nav>

<script>
    // Update teks logo berdasarkan scroll
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.getElementById('main-navbar');
        const logoTexts = document.querySelectorAll('.navbar-logo-text');
        
        function updateNavbarText() {
            const isScrolled = window.scrollY > 100;
            logoTexts.forEach(text => {
                if (isScrolled) {
                    text.classList.remove('text-white');
                    text.classList.add('text-gray-900');
                } else {
                    text.classList.remove('text-gray-900');
                    text.classList.add('text-white');
                }
            });
        }
        
        window.addEventListener('scroll', updateNavbarText);
        updateNavbarText(); // Initial call
    });
</script>