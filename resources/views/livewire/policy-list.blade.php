<div>
    <div class="flex justify-between items-center mb-4 border-b pb-3">
        <x-table-title class="text-lime-600 "> {{$tableTitle}} </x-table-title>
        <div class="flex gap-4 text-xs">
            <div class="border-2 border-lime-600 rounded-md flex justify-between items-center pr-2">         
                <input  wire:model.live="search" id="searchBar" type="text" placeholder="Search here.."
                    class="px-2 py-2 rounded-md focus:outline-none">
                <span><i class="fa-solid fa-magnifying-glass text-lime-600"></i></span>
            </div>
            <x-button wire:click="addPolicy()" icon="add">
                Add Policy
            </x-button> 
            <x-button wire:click="addQuantity()" icon="add">
                Edit Policy
            </x-button>
        </div>
    </div>
    <div class="h-full overflow-x-auto">
        <div class="w-full flex justify-between space-y-2 flex-col pb-2 px-1">
            @foreach($data as $row)
            <div wire:key="$row->id" class="bg-white text-xs  rounded-md drop-shadow-lg p-5 flex justify-between items-center border-t shadow-md border-gray-200">
                <div class="flex flex-col justify-center items-center ">
                    <p class="text-xs font-medium text-gray-400 normal-case">Date Added</p>
                    <p class=" font-medium text-gray-600 normal-case">{{$row->created_at->format('F j, Y')}}</>
                </div>
                <div class="flex flex-col justify-center items-center ">
                    <p class="text-xs font-medium text-gray-400 normal-case">Name.</p>
                    <div class="w-[200px]">
                        <p class=" font-medium text-gray-600 normal-case text-center">
                            {{$row->name}}
                        </p>
                    </div>
                </div>
                <div class="flex flex-col justify-center items-center ">
                    <p class="text-xs font-medium text-gray-400 normal-case">Type</p>
                    <p class=" font-medium text-gray-600 normal-case">
                        {{$row->type}}
                    </p>
                </div>
                <div class="flex flex-col justify-center items-center ">
                    <p class="text-xs font-medium text-gray-400 normal-case">Quantity</p>
                    <p class=" font-medium text-gray-600 normal-case">
                        {{$row->quantity}}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <x-modal name="policy-add">
        <livewire:policy-add></livewire:policy-add>
    </x-modal>
    <x-modal name="policy-edit">
        <livewire:policy-edit></livewire:policy-edit>
    </x-modal>
</div>