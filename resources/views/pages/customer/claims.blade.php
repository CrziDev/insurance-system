<x-layout>
    <section class="mb-7">
        <x-nav></x-nav>
    </section>
    <div class="px-5 min-w-[500px] max-w-[2000px] mx-auto  h-[calc(100%-93px)] pb-5n">
        <section class="h-full overflow-hidden bg-white py-5 px-4 rounded">
            <x-table-title>My Status</x-table-title>
            <div class="h-full overflow-x-auto">
                <x-table-claims></x-table-claims>
            </div>
        </section> 
    </div>
</x-layout>
