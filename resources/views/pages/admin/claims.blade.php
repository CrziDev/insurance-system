<x-layout>
    <section class="mb-7">
        <x-nav></x-nav>
    </section>
 
    <div class="px-5 min-w-[500px] max-w-[2000px] mx-auto  h-[calc(100%-93px)] pb-5">
        <section class="h-full bg-white py-5 px-4 rounded overflow-hidden">
            <div class="max-h-full overflow-x-auto pb-14">
                <livewire:claim-list tableTitle="Customer Claims"/>
            </div>
        </section> 
    </div>
    
</x-layout>
