<x-layout>
    <section class="mb-5">
        <x-nav></x-nav>
    </section>
    <div class="px-5 min-w-[500px] max-w-[2000px] mx-auto h-[calc(100%-93px)]">

        <section class="mb-4">
            <x-banner></x-banner>
        </section>

        <!-- Modal  -->
        <x-modal name="non-life-insure">
            <livewire:add-non-life-insurance-form :userId="request()->user()->id"/>
        </x-modal>

        <x-modal name="life-insure">
            <x-forms.life-form></x-forms.life-form>
        </x-modal>
        <!------------->
        <div class="h-[calc(100%-240px-28px)] flex">
            <section class="w-[70%] mr-4 bg-white rounded-lg p-5 overflow-hidden max-h-full min-h-[250px]">
                <livewire:recent-events tableTitle="Recent Events" tableLink="/customer/insurance"/>
            </section>  
            
            <section class="w-[30%]  bg-white rounded-lg p-5 overflow-hidden max-h-full min-h-[250px]">
                <x-card-clock></x-card-clock>
            </section>  
        </div>

    </div>


</x-layout>