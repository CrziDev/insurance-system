<x-layout>
    <section class="mb-5">
        <x-nav></x-nav>
    </section>
    <div class="px-5 min-w-[500px] max-w-[2000px] mx-auto h-[calc(100%-93px)]">

        <section class="mb-4 bg-white rounded-lg p-5 overflow-hidden max-h-full">

<livewire:dashboard-cards/>
        
        </section>

        <!-- <section class="mb-4 bg-white rounded-lg p-5 overflow-hidden max-h-full">
                            
        </section> -->
        <div class="h-[calc(100%-160px-28px)] flex">
            <section class="w-[70%] mr-4 bg-white rounded-lg p-5 overflow-hidden max-h-full">
                <livewire:recent-events tableTitle="Recent Events" tableLink="/admin/request"/>
            </section>  
            
            <section class="w-[30%]  bg-white rounded-lg p-5 overflow-hidden max-h-full">
                <x-card-clock></x-card-clock>
            </section>  
        </div>
    </div>


</x-layout>