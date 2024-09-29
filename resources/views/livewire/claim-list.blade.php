

<div>
    <div class="flex justify-between items-center mb-4 border-b pb-3">
        <x-table-title class="text-lime-600">  {{$tableTitle}} </x-table-title>
        <div class="text-xs pr-2 flex space-x-2">
           <select wire:model="status"  wire:change="filterStatus($event.target.value)" class="px-2 py-1 text-xs  border rounded text-gray-500 border-lime-600" name="" id="">
                <option value="" selected>All</option>
                <option value="1">Approved</option>
                <option value="2">Expired</option>
                <option value="3">Expiring</option>
                <option value="4">Pending</option>
            </select>
           <div class="border-2 border-lime-600 rounded-md flex justify-between items-center pr-2">         
                <input  wire:model.live="search" id="searchBar" type="text" placeholder="Search here.."
                    class="px-2 py-2 rounded-md focus:outline-none">
                <span><i class="fa-solid fa-magnifying-glass text-lime-600"></i></span>
            </div>      
        </div>
    </div>

    <div class="h-full overflow-x-auto">
        <div class="w-full flex justify-between flex-col">
            @foreach($data as $row)
                <div wire:key="$row->id" class="w-full overflow-x-auto flex justify-between flex-col">
                    <div class="flex flex-col border px-3 rounded-md mb-2 pb-3 ">
                        <div class="flex align-center space-x-2 border-b py-3 justify-between">
                            <div class="flex space-x-2">
                                <img class="w-[28px] h-[23px]" src="{{Vite::asset('resources/images/insurance1.png')}}" alt="">
                                <div class="flex flex-col space-y-1">
                                    <p class="text-sm font-bold">Motorcycle Policy</p>
                                </div>   
                            </div>
                            <div class="flex space-x-2 align-center ">
                                <p class="text-xs">Effective:</p>
                                <p class="text-xs font-semibold">July 5, 2024</p>
                            </div>                         
                        </div>
                        <div class="flex align-center text-center space-x-2 justify-evenly py-4">
                            <div class="w-[30%] border-r ">
                                <p class="text-sm mb-1">Customer</p>
                                <p class="text-xl font-semibold">{{$row->user->customer[0]->full_name}}</p>
                            </div>
                            <div class="w-[30%] border-r ">
                                <p class="text-sm mb-1">Premium</p>
                                <p class="text-xl font-semibold">₱250/month</p>
                            </div>
                            <div class="w-[40%] border-r">
                                <p class="text-sm mb-1">Duration</p>
                                <p class="font-semibold">{{$row->duration}}</p>
                            </div>
                            <div class="w-[30%] mt-auto">
                                @if($row->status == 5 || $row->status == 6)
                                    @if(request()->user()->role == 3)
                                        <x-button class="bg-{{lcfirst($row->status_description)}}" wire:click="selectClaim({{$row}})">{{$row->status_description}}</x-button>
                                    @else
                                        @if($row->status == 6)
                                        <x-button class="bg-{{lcfirst($row->status_description)}}" wire:click="selectClaim({{$row}})">{{$row->status_description}}</x-button>
                                        @else
                                        <x-button class="bg-{{lcfirst($row->status_description)}}" wire:click="selectClaim({{$row}})">Check Files</x-button>
                                        @endif
                                    @endif
                                @else
                                    <x-button wire:click="selectClaim({{$row}})">Claim</x-button>
                                @endif
                            </div>
                        </div>
                    </div>  
                </div>   
            @endforeach         
        </div>    
    </div>

    <x-modal name="claim-add">
        @if($transaction)
            <livewire:claim-add :transaction="$transaction"/>
        @endif
    </x-modal> 

    <x-modal name="claim-check-file">
        @if($transaction)
            <livewire:claim-check-file :transaction="$transaction"/>
        @endif
    </x-modal> 
</div>