
<div>
    <div class="flex justify-between items-center mb-4 border-b pb-3">
        <x-table-title class="text-lime-600 ">Customers</x-table-title>

        <div class="flex gap-4 text-xs">
        <div class="border-2 border-lime-600 rounded-md flex justify-between items-center pr-2">         
                <input  wire:model.live="search" id="searchBar" type="text" placeholder="Search here.."
                    class="px-2 py-2 rounded-md focus:outline-none">
                <span><i class="fa-solid fa-magnifying-glass text-lime-600"></i></span>
            </div>
            
            <x-button class="text-xs" wire:click="addCustomer()" icon="add">
                Add Customer
            </x-button> 
        </div>
    </div>
    <div class="grid grid-cols-4 text-white gap-4">
        @if($customers->count() == 0)
            <div class="flex justify-center items-center h-48">
                <p class="text-lg font-semibold text-gray-500">No Customers</p>
            </div>
        @else
        @foreach($customers as $customer)
            <div wire:key="$row->id"  class="bg-gray-600 px-4  rounded shadow-md">
                <div class="flex border-b border-gray-200 pt-1 pb-2 items-center">
                    <div class="border border-gray-400 p-2 mr-5">
                       <i class="fa-solid fa-clipboard-user text-[48px]"></i>
                    </div>
                    <div class="pt-5">
                        <div class="border-b mb-4">
                            <p class="text-xs mb-1 text-gray-300">Customer</p>
                            <p class="text-xs">{{$customer->full_name}}</p>
                        </div>
                        
                        <div class="flex">
                            <div class="flex mr-6 items-center text-xs">
                                <i class="fa-solid fa-user-pen mr-2 text-[10px] "></i>
                                <p class="hover:text-green-400 cursor-pointer text-[10px] " wire:click="selectCustomer({{$customer}})" >Edit</p>
                            </div>
                            
                            <p class="hover:text-green-400 text-[10px] cursor-pointer">Change Pass</p>
                        </div>
                    </div>

                </div>
                <!-- <div class="pt-4 space-y-2">
                    <div class="flex items-center space-x-3 ">
                        <x-form-input-label class="w-[80px] text-[14px]">Username: </x-form-input-label>
                        <p>{{$customer->user->username}}</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <x-form-input-label class="w-[80px] text-[14px]">Password:</x-form-input-label>
                        <x-form-input class="w-full" va></x-form-input>
                        <i class="fa-solid fa-eye-slash"></i>
                    </div>
                </div> -->
                <div class="p-2">
                    <p class="text-center text-xs text-orange/90 hover:text-green-400 cursor-pointer text-[10px] " wire:click="showPolicy({{$customer}})">View Policies</p>
                </div>
            </div>
            
        @endforeach
        @endif
    </div>

    
    <x-modal name="customer-add">
        <livewire:customer-add></livewire:customer-add>
    </x-modal>

    <x-modal name="update-customer">
        @if($selectedCustomer)
            <livewire:customer-update :selectedCustomer="$selectedCustomer" key="{{ $selectedCustomer->id }}"/>
        @endif
    </x-modal>

    <x-modal name="show-policy">
        @if($selectedCustomer)
            <livewire:show-policy-status :fullName="$fullName" :selectedCustomer="$selectedCustomer" key="{{ $selectedCustomer->id }}">
        @endif
    </x-modal>
    

    
</div>