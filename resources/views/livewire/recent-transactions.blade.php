<div>
    <div class="flex justify-between items-center mb-4">
        <x-table-title class="text-sm">{{$tableTitle}}</x-table-title>
        
        <div class="flex items-center space-x-2">
            <!-- <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" wire:model.live="search"  id="default-search" class="block w-full px-2 py-1 text-sm ps-10 border border-gray-400 rounded-lg bg-gray-50" placeholder="Search" required />
            </div> -->
        <x-table-link link="/admin/transactions">View Request</x-table-link> 
            
        </div>
    </div>
    <div class="w-full flex justify-between flex-col">
        @foreach($data as $row)
            <div class="flex items-center border px-3 rounded-md mb-2 py-3">
                <div class="w-full">
                    <div class="flex align-center space-x-2">
                        <img class="w-[28px] h-[23px]" src="{{Vite::asset('resources/images/insurance1.png')}}" alt="">
                        <div class="flex flex-col space-y-1">
                            <p class="text-sm font-semibold">Motorcycle Policy</p>
                            <p class="text-xs "> {{$row->user->customer[0]?->full_name}}</p>
                        </div>   
                    </div>
                </div>
                <div class="w-full">
                    <div class="flex flex-col space-y-1">
                        <p class="text-xs  text-green-600 font-sm text-center">Non-life</p>
                    </div>   
                </div>
                <div class="w-full">
                    <div class="flex flex-col space-y-1">
                        <p class="text-xs  text-green-600 font-sm text-center">Request Submitted</p>
                    </div>   
                </div>
                <div class="w-full">
                    <div class="flex flex-col space-y-1">
                        <p class="text-xs font-sm text-center">July 28, 2000</p>
                    </div>   
                </div>
            </div>  
        @endforeach         
</div>    

</div>
