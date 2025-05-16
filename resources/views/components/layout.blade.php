<!DOCTYPE html>
<html lang="en" x-data="{ open: window.innerWidth >= 768 }" @resize.window="open = window.innerWidth >= 768">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insurance Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="relative">

    <div class="flex font-custom-font font-medium text-gray-600 bg-gray-200">
        @auth
            <!-- Sidebar (only hidden/shown, not floating) -->
            <section 
                class="min-w-[230px] bg-dark h-screen text-white/80 pb-10 text-sm"
                x-show="open"
                x-transition
                style="display: none;"
            >
                <sidebar class="flex flex-col h-full">
                    <div class="py-5 mb-5">
                        <img class="w-[80px] h-[70px] m-auto" src="{{ Vite::asset('resources/images/logo.png') }}" alt="Logo">
                    </div>
                    <div class="text-sm">
                        @if(request()->user()->role == 1)
                            <x-sidebar-admin></x-sidebar-admin>
                        @elseif(request()->user()->role == 2)
                            <x-sidebar-staff></x-sidebar-staff>
                        @elseif(request()->user()->role == 3)
                            <x-sidebar-customer></x-sidebar-customer>
                        @endif
                    </div>
                    <div class="mt-auto">
                        <x-logout-btn>Logout</x-logout-btn>             
                    </div>
                </sidebar>
            </section>
        @endauth

        <!-- Main Content -->
        <section class="w-full h-screen">
            <main class="h-screen overflow-x-auto">
                {{$slot}}
            </main>
        </section>
    </div>

    @livewireScripts
</body>
</html>
