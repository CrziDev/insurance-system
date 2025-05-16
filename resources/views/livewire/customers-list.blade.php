<div>
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 border-b pb-3 gap-4">
        <x-table-title class="text-lime-600">Customers: ({{ $customers->count() }})</x-table-title>
        <div class="flex flex-col sm:flex-row gap-2 text-xs w-full md:w-auto">
            <!-- Date Filter -->
            <div class="border-2 border-lime-600 rounded-md flex items-center pr-2 w-full sm:w-auto">
                <input wire:model.live="dateFilter" type="date" 
                    class="px-2 py-2 rounded-md w-full focus:outline-none">
            </div>
            <!-- Search -->
            <div class="border-2 border-lime-600 rounded-md flex items-center pr-2 w-full sm:w-auto">
                <input wire:model.live="search" id="searchBar" type="text" placeholder="Search here.."
                    class="px-2 py-2 rounded-md w-full focus:outline-none">
                <span class="ml-2"><i class="fa-solid fa-magnifying-glass text-lime-600"></i></span>
            </div>
            <!-- Add Button -->
            <x-button class="text-xs w-full sm:w-auto" wire:click="addCustomer()" icon="add">
                Add Customer
            </x-button> 
        </div>
    </div>

    <!-- Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 text-white">
        @if($customers->count() === 0)
            <div class="col-span-full flex justify-center items-center h-48">
                <p class="text-lg font-semibold text-gray-500">No Customers</p>
            </div>
        @else
            @foreach($customers as $customer)
                <div wire:key="{{ $customer->id }}" class="bg-gray-600 px-4 rounded shadow-md">
                    <div class="flex border-b border-gray-200 pt-1 pb-2 items-center">
                        <div class="border border-gray-400 p-2 mr-5">
                            <i class="fa-solid fa-clipboard-user text-[48px]"></i>
                        </div>
                        <div class="pt-5">
                            <div class="border-b mb-4">
                                <p class="text-xs mb-1 text-gray-300">Customer</p>
                                <p class="text-xs">{{ $customer->full_name }}</p>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <div class="flex items-center text-xs">
                                    <i class="fa-solid fa-user-pen mr-2 text-[10px]"></i>
                                    <p class="hover:text-green-400 cursor-pointer text-[10px]" wire:click="selectCustomer({{ $customer }})">Edit</p>
                                </div>
                                <p class="hover:text-green-400 cursor-pointer text-[10px]" wire:click="updatePassword({{ $customer }})">Change Pass</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-2">
                        <p class="text-center text-xs text-orange/90 hover:text-green-400 cursor-pointer text-[10px]" wire:click="showPolicy({{ $customer }})">View Policies</p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Modals -->
    <x-modal name="customer-add">
        <livewire:customer-add />
    </x-modal>

    <x-modal name="update-customer">
        @if($selectedCustomer)
            <livewire:customer-update :selectedCustomer="$selectedCustomer" key="{{ $selectedCustomer->id }}" />
        @endif
    </x-modal>

    <x-modal name="update-password">
        @if($selectedCustomer)
            <livewire:change-password :user="$selectedCustomer->user" key="{{ $selectedCustomer->id }}" />
        @endif
    </x-modal>

    <x-modal name="show-policy">
        @if($selectedCustomer)
            <livewire:show-policy-status :fullName="$fullName" :selectedCustomer="$selectedCustomer" key="{{ $selectedCustomer->id }}" />
        @endif
    </x-modal>
</div>
