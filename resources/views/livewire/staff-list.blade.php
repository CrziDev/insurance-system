
<div>
    <div class="flex justify-between items-center mb-4 border-b pb-3">
        <x-table-title class="text-lime-600 ">Staffs</x-table-title>

        <div class="flex gap-4 text-xs">
        <div class="border-2 border-lime-600 rounded-md flex justify-between items-center pr-2">         
                <input  wire:model.live="search" id="searchBar" type="text" placeholder="Search here.."
                    class="px-2 py-2 rounded-md focus:outline-none">
                <span><i class="fa-solid fa-magnifying-glass text-lime-600"></i></span>
            </div>
            
            <x-button class="text-xs" wire:click="addStaff()" icon="add">
                Add Staff
            </x-button> 
        </div>
    </div>
    <div class="grid grid-cols-4 text-white gap-4">
        @foreach($staff as $row)
            <div wire:key="$row->id"  class="bg-gray-600 px-4  rounded shadow-md">
                <div class="flex border-b border-gray-200 pt-1 pb-2 items-center">
                    <div class="border border-gray-400 p-2 mr-5">
                       <i class="fa-solid fa-clipboard-user text-[48px]"></i>
                    </div>
                    <div class="pt-5">
                        <div class="border-b mb-4">
                            <p class="text-xs mb-1 text-gray-300">Staff</p>
                            <p class="text-xs">{{$row->username}}</p>
                        </div>
                        
                        <div class="flex">
                            <div class="flex mr-6 items-center text-xs">
                                <i class="fa-solid fa-user-pen mr-2 text-[10px] "></i>
                                <p class="hover:text-green-400 cursor-pointer text-[10px] " wire:click="selectStaff({{$row}})" >Edit</p>
                            </div>
                            
                            <p class="hover:text-green-400 text-[10px] cursor-pointer">Change Pass</p>
                        </div>
                    </div>

                </div>
            </div>
            
        @endforeach
    </div>

    

    <x-modal name="staff-add">
        <livewire:staff-add></livewire:staff-add>
    </x-modal>

    <x-modal name="staff-update">
        @if($selectedStaff)
        
            <livewire:staff-update :selectedStaff="$selectedStaff" key="{{ $selectedStaff->id }}"/>
        @endif
    </x-modal>

</div>