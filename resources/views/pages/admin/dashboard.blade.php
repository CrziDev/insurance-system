<x-layout>
    <section class="mb-5">
        <x-nav></x-nav>
    </section>

    <div class="px-5 max-w-screen-2xl mx-auto h-auto">
        <!-- Dashboard Cards Section -->
        <section class="mb-4 bg-white rounded-lg p-5 overflow-hidden">
            <livewire:dashboard-cards />
        </section>

        <!-- Two-column layout for Recent Events and Clock -->
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Recent Events -->
            <section class="w-full md:w-2/3 bg-white rounded-lg p-5 overflow-hidden">
                <livewire:recent-events tableTitle="Recent Events" tableLink="/admin/request" />
            </section>

            <!-- Clock Card -->
            <section class="w-full md:w-1/3 bg-white rounded-lg p-5 overflow-hidden">
                <x-card-clock />
            </section>
        </div>
    </div>
</x-layout>
