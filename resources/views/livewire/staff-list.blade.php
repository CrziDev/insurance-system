<div>
    <!-- Header and Search -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 border-b pb-3 gap-4">
        <x-table-title class="text-lime-600">Staffs</x-table-title>

        <div class="flex flex-col sm:flex-row gap-2 text-xs w-full md:w-auto">
            <div class="border-2 border-lime-600 rounded-md flex items-center pr-2 w-full sm:w-auto">         
                <input wire:model.live="search" id="searchBar" type="text" placeholder="Search here.."
                    class="px-2 py-2 rounded-md w-full sm:w-auto focus:outline-none">
                <span class="ml-2"><i class="fa-solid fa-magnifying-glass text-lime-600"></i></span>
            </div>

            <x-button class="text-xs w-full sm:w-auto" wire:click="addStaff()" icon="add">
                Add Staff
            </x-button> 
        </div>
    </div>

    <!-- Responsive Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 text-white">
        @foreach($staff as $row)
            <div wire:key="{{ $row->id }}" class="bg-gray-600 px-4 rounded shadow-md">
                <div class="flex border-b border-gray-200 pt-1 pb-2 items-center">
                    <div class="border border-gray-400 p-2 mr-5">
                        <i class="fa-solid fa-clipboard-user text-[48px]"></i>
                    </div>
                    <div class="pt-5">
                        <div class="border-b mb-4">
                            <p class="text-xs mb-1 text-gray-300">Staff</p>
                            <p class="text-xs">{{ $row->username }}</p>
                        </div>

                        <div class="flex flex-wrap gap-2">
                            <div class="flex items-center text-xs">
                                <i class="fa-solid fa-user-pen mr-2 text-[10px]"></i>
                                <p class="hover:text-green-400 cursor-pointer text-[10px]" wire:click="selectStaff({{ $row }})">Edit</p>
                            </div>
                            
                            <p class="hover:text-green-400 text-[10px] cursor-pointer" wire:click="updatePassword({{ $row }})">Change Pass</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modals -->
    <x-modal name="staff-add">
        <livewire:staff-add />
    </x-modal>

    <x-modal name="update-password">
        @if($selectedStaff)
            <livewire:change-password :user="$selectedStaff" key="{{ $selectedStaff->id }}" />
        @endif
    </x-modal>

    <x-modal
