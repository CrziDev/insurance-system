<x-layout>
    <section class="mb-5">
        <x-nav></x-nav>
    </section>

    <div class="px-5 min-w-[500px] max-w-[2000px] mx-auto h-[calc(100%-93px)] space-y-3">

        <div class="h-[calc(100%-28px)] flex">

            <section class="w-[50%]  mr-4 bg-white rounded-lg p-5 overflow-hidden max-h-full">
                <livewire:chart-sales-yearly tableTitle="Yearly Sales"/>
            </section>       
     
            <section class="w-[50%]  bg-white rounded-lg p-5 overflow-hidden max-h-full">
                <livewire:chart-sales tableTitle="Monthly Sales (Per year)"/>
            </section>  
        </div>

        <div class="h-[calc(100%-28px)] flex">
            <section class="w-[50%] mr-4 bg-white rounded-lg p-5 overflow-hidden max-h-full">
                <livewire:customer-reports tableTitle="Approved Insurance"/>
            </section>   
            <section class="w-[50%]  bg-white rounded-lg p-5 overflow-hidden max-h-full">
                <livewire:sales-monitoring tableTitle="Sales Count"/>
            </section>  
        </div>

    </div>

</x-layout>