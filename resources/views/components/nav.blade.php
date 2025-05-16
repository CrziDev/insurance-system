<nav class="flex justify-between items-center px-5 py-3 border-b border-black/10 shadow-md bg-white">
    <!-- Sidebar Toggle Button (mobile only) -->
    <button @click="open = !open" class="md:hidden mr-5 text-gray-700">
        <i class="fas fa-bars text-xl"></i>
    </button>

    <!-- Left Section (Greeting & Role) -->
    <div class="flex-1">
        <div class="text-md font-semibold flex space-x-1">
            <span class="font-semibold">
                {{ auth()->user()->greeting }},
            </span>
            <span>{{ auth()->user()->username }}</span>
        </div>

        <div class="text-sm text-gray-500">
            @php
                if (request()->user()->role == 2) {
                    echo 'Staff';
                } elseif (request()->user()->role == 3) {
                    echo 'Customer';
                } else {
                    echo 'Admin';
                }
            @endphp
        </div>
    </div>

    <!-- Right Section (Notifications & Avatar) -->
    <div class="flex items-center space-x-5">
        <livewire:notification-bell />

        <div class="rounded-full w-10 h-10 bg-red-100 overflow-hidden">
            <img class="object-cover w-full h-full rounded-full" src="{{ Vite::asset('resources/images/profile.png') }}" alt="Profile">
        </div>
    </div>
</nav>
