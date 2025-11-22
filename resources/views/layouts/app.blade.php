<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BahariGo') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .navbar-scrolled {
                @apply bg-white/95 backdrop-blur-sm shadow-sm;
            }
            .nav-link-hover {
                @apply relative transition-all duration-300;
            }
            .nav-link-hover::after {
                content: '';
                @apply absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300;
            }
            .nav-link-hover:hover::after {
                @apply w-full;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-white">
        @include('layouts.navigation')

        <!-- Page Content -->
        <main class="min-h-screen">
            {{ $slot }}
        </main>

        <script>
            // Sticky navbar dengan efek transparansi
            window.addEventListener('scroll', function() {
                const navbar = document.getElementById('main-navbar');
                if (window.scrollY > 100) {
                    navbar.classList.add('navbar-scrolled');
                    navbar.classList.remove('bg-transparent');
                } else {
                    navbar.classList.remove('navbar-scrolled');
                    navbar.classList.add('bg-transparent');
                }
            });

            // Inisialisasi state navbar saat load
            document.addEventListener('DOMContentLoaded', function() {
                const navbar = document.getElementById('main-navbar');
                if (window.scrollY > 100) {
                    navbar.classList.add('navbar-scrolled');
                } else {
                    navbar.classList.add('bg-transparent');
                }
            });
        </script>
    </body>
</html>