<x-layout>
    <section class="mb-5">
        <x-nav></x-nav>
    </section>

    <div class="px-5 min-w-[500px] max-w-[2000px] mx-auto space-y-5">

        <!-- First Grid Row: Sales Charts -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <section class="bg-white rounded-lg p-5 overflow-hidden">
                <livewire:chart-sales-yearly tableTitle="Yearly Sales" />
            </section>       

            <section class="bg-white rounded-lg p-5 overflow-hidden">
                <livewire:chart-sales tableTitle="Monthly Sales (Per year)" />
            </section>  
        </div>

        <!-- Second Grid Row: Insurance Reports -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <section class="bg-white rounded-lg p-5 overflow-hidden">
                <livewire:customer-reports tableTitle="Approved Insurance" />
            </section>   

            <section class="bg-white rounded-lg p-5 overflow-hidden">
                <livewire:sales-monitoring tableTitle="Insurance Count" />
            </section>  
        </div>

    </div>
</x-layout>
