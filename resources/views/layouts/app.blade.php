<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

        <style>
            /* Style scrollbar for body/html */
            body::-webkit-scrollbar {
                width: 10px; /* Width of the scrollbar */
            }

            body::-webkit-scrollbar-thumb {
                background-color: #4b5563; /* Color of the scrollbar thumb */
                border-radius: 6px; /* Radius of the scrollbar thumb */
            }

            body::-webkit-scrollbar-track {
                background-color: #1f2937; /* Color of the scrollbar track */
            }

            .swal2-popup {
                background-color: #1d232a; /* Dark background color */
                color: #a0a7b5; /* Text color */
            }

            .swal2-title,
            .swal2-content {
                color: #a0a7b5; /* Adjust text color */
            }

            /* Example: Button colors */
            .swal2-confirm {
                background-color: #4caf50; /* Change the confirm button background color */
                color: #ffffff; /* Change the confirm button text color */
            }

            .swal2-cancel {
                background-color: #f44336; /* Change the cancel button background color */
                color: #ffffff; /* Change the cancel button text color */
            }
        </style>
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        <footer class="footer footer-center p-4 bg-gray-900">
            <aside>
                <p>Copyright © 2023 - All right reserved by InternetBank</p>
            </aside>
        </footer>
    </body>
</html>
