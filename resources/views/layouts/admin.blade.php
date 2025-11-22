<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'BahariGo Admin') }}</title>
    
    <!-- Fonts & Scripts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-50">
        
        <!-- SIDEBAR (Responsive) -->
        <div :class="sidebarOpen ? 'block' : 'hidden'" class="fixed inset-0 z-50 lg:relative lg:block lg:z-auto transition-opacity duration-200 lg:transition-none">
            <div @click="sidebarOpen = false" class="absolute inset-0 bg-black/50 lg:hidden"></div>
            
            <div class="relative w-64 h-full bg-gradient-to-b from-blue-800 to-blue-900 shadow-xl flex flex-col">
                <!-- Logo -->
                <div class="flex items-center justify-center h-16 border-b border-blue-700/50 shrink-0">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-white font-bold text-lg">BahariGo</span>
                    </div>
                    <button @click="sidebarOpen = false" class="lg:hidden absolute right-4 text-blue-200 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <!-- Menu Items -->
                <nav class="mt-6 px-4 space-y-2 flex-1 overflow-y-auto">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700/50 text-white' : 'text-blue-100 hover:bg-blue-700/30 hover:text-white' }} rounded-xl font-medium transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.schedules.index') }}" class="flex items-center space-x-3 px-4 py-3 {{ request()->routeIs('admin.schedules.*') ? 'bg-blue-700/50 text-white' : 'text-blue-100 hover:bg-blue-700/30 hover:text-white' }} rounded-xl font-medium transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>Kelola Jadwal</span>
                    </a>
                    <a href="{{ route('admin.reports.index') }}" class="flex items-center space-x-3 px-4 py-3 {{ request()->routeIs('admin.reports.*') ? 'bg-blue-700/50 text-white' : 'text-blue-100 hover:bg-blue-700/30 hover:text-white' }} rounded-xl font-medium transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        <span>Laporan</span>
                    </a>
                </nav>

                <!-- User Info -->
                <div class="p-4 border-t border-blue-700/50 shrink-0">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center ring-2 ring-blue-500">
                            <span class="text-white font-semibold text-sm">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-white text-sm font-medium truncate">{{ Auth::user()->name }}</p>
                            <p class="text-blue-200 text-xs truncate">Administrator</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MAIN CONTENT WRAPPER -->
        <div class="flex-1 flex flex-col min-h-screen overflow-hidden">
            <!-- Top Header (Hamburger & Logout) -->
            <header class="bg-white shadow-sm border-b border-gray-200 h-16 flex items-center px-4 lg:px-8 justify-between sticky top-0 z-10">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 mr-4 text-gray-600 hover:bg-gray-100 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <h1 class="text-xl font-bold text-gray-900">{{ $title ?? 'Admin Panel' }}</h1>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-500 hover:text-red-600 font-medium text-sm">Logout</button>
                </form>
            </header>

            <!-- Dynamic Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-4 lg:p-8">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>